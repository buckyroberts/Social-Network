<?php
/**
 * Shop ajax action handler
 */

require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(isset($_REQUEST['action'])){

    if(function_exists($_REQUEST['action'])){

        $userID = buckys_is_logged_in();
        if(!$userID){
            if(isset($_REQUEST['actionType']) && $_REQUEST['actionType'] == 'POST'){
                buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
            }else{
                echo json_encode(['success' => 0, 'msg' => "Please login and try again."]);
            }
        }else{
            call_user_func($_REQUEST['action']);
        }
    }else{
        echo json_encode(['success' => 0, 'msg' => "You don't have permission."]);
    }
    exit;
}else{
    buckys_redirect('/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

/**
 * Delete Shop Product images

 */
function deleteShopProductImage(){

    $userID = buckys_is_logged_in();

    if(!$userID)
        return;

    $imgFile = @$_REQUEST['file'];
    $productID = get_secure_integer($_REQUEST['productID']);
    $rootPath = rtrim(DIR_FS_ROOT, '/');
    //remove image files
    if($imgFile != ''){
        @unlink($rootPath . $imgFile);

        //update DB if it is edit action.
        if(isset($productID) && is_numeric($productID)){
            $tmpStrPath = str_replace(DIR_FS_SHOP_IMG, '/', DIR_FS_SHOP_IMG_TMP);
            if(strpos($imgFile, $tmpStrPath) === false){
                $thumbPathInfo = pathinfo($imgFile);
                $thumbFileName = $thumbPathInfo['dirname'] . "/" . $thumbPathInfo['filename'] . SHOP_PRODUCT_IMAGE_THUMB_SUFFIX . "." . $thumbPathInfo['extension'];

                @unlink($rootPath . $thumbFileName);

                $shopProductIns = new BuckysShopProduct();
                $productData = $shopProductIns->getProductById($productID);
                if(isset($productData)){
                    $imageList = explode('|', $productData['images']);

                    if(count($imageList) > 0){
                        $newImageList = [];
                        foreach($imageList as $imgUrl){
                            if($imgUrl == $imgFile)
                                continue;
                            $newImageList[] = $imgUrl;
                        }

                        $newImageStr = implode("|", $newImageList);

                    }

                    $shopProductIns->updateProduct($productID, ['images' => $newImageStr]);

                }

            }
        }

    }
}

/**
 * Add shop product action by Ajax

 */
function addShopProduct(){

    $userID = buckys_is_logged_in();
    if(!$userID)
        return;

    $inputValidFlag = true;
    $requiredFields = ['title', 'subtitle', 'description', 'category', 'return_policy', 'shipping_price', 'price'];

    if($_REQUEST['return_policy'] == ''){
        $_REQUEST['return_policy'] = 'None';
    }

    foreach($requiredFields as $requiredField){
        if($_REQUEST[$requiredField] == ''){
            $inputValidFlag = false;
        }
    }

    $categoryClass = new BuckysShopCategory();
    $category = $categoryClass->getCategoryByID($_REQUEST['category']);

    if(!$category['isDownloadable'] && $_REQUEST['location'] == ''){
        $inputValidFlag = false;
    }else if($category['isDownloadable'] == 1){
        $_REQUEST['location'] = 0;
    }

    if(isset($_REQUEST['price']) && (!is_numeric($_REQUEST['price']) || $_REQUEST['price'] <= 0)){
        $inputValidFlag = false;
    }

    $shippingPriceList = [];
    if(isset($_REQUEST['shipping_price'])){

        $shippingPriceList = json_decode($_REQUEST['shipping_price'], true);
        if(!is_array($shippingPriceList) || count($shippingPriceList) < 1){
            $inputValidFlag = false;
        }
    }

    $listingFeeType = get_secure_integer($_REQUEST['listing_fee_type']);

    if($listingFeeType === null){
        $inputValidFlag = false;
    }

    if($inputValidFlag && $userID !== false){
        $shopProductIns = new BuckysShopProduct();

        $data['userID'] = $userID;
        $data['title'] = get_secure_string($_REQUEST['title']);
        $data['subtitle'] = get_secure_string($_REQUEST['subtitle']);
        $data['description'] = get_secure_string($_REQUEST['description']);
        $data['catID'] = get_secure_string($_REQUEST['category']);
        $data['images'] = get_secure_string($_REQUEST['images']);
        $data['locationID'] = buckys_escape_query_integer($_REQUEST['location']);
        $data['returnPolicy'] = get_secure_string($_REQUEST['return_policy']);
        $data['price'] = get_secure_string($_REQUEST['price']);
        $data['listingDuration'] = get_secure_string($_REQUEST['listing_duration']);
        $data['expiryDate'] = $data['listingDuration'] == -1 ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', time() + 3600 * 24 * $data['listingDuration']);

        $data['createdDate'] = date('Y-m-d H:i:s');

        $data['images'] = moveShopTmpImages($data['images']);

        if($category['isDownloadable'] == 1){
            if(!$_REQUEST['filename'] || file_exists(DIR_FS_SHOP_IMG_TMP . $_REQUEST['filename'])){
                echo json_encode(['success' => 0, 'msg' => 'Please select a zip file.']);
                exit;
            }
            $data['isDownloadable'] = 1;
            $filename = moveShopTmpProduct($_REQUEST['filename']);
            $data['fileName'] = $filename;
        }

        if($data['images'] === false){
            echo json_encode(['success' => 0, 'msg' => 'Something goes wrong, please contact administrator.']);
            exit;
        }

        if($newProductID = $shopProductIns->addProduct($data, $listingFeeType)){

            $shopProductIns->addShippingPrice($newProductID, $shippingPriceList);

            echo json_encode(['success' => 1, 'msg' => 'Your item has been added successfully.']);
        }else{
            echo json_encode(['success' => 0, 'msg' => 'You do not have enough credits for that.']);
        }

    }else{
        //error
        echo json_encode(['success' => 0, 'msg' => 'Please input required field(s).']);
    }

}

/**
 * Archive order ID

 */
function archiveOrder(){

    $paramOrderID = get_secure_integer($_REQUEST['id']);

    $userID = buckys_is_logged_in();

    $orderIns = new BuckysShopOrder();
    $flag = $orderIns->archiveOrder($userID, $paramOrderID);

    if($flag){
        buckys_add_message('An item has been archived successfully', MSG_TYPE_SUCCESS);
    }else{
        buckys_add_message(MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
    }

    buckys_redirect('/shop/purchase.php');

}

/**
 * Edit Shop Product action by ajax

 */
function editProduct(){

    $userID = buckys_is_logged_in();
    if(!$userID)
        return;

    $shopProductIns = new BuckysShopProduct();
    $inputValidFlag = true;

    $requiredFields = ['title', 'subtitle', 'description', 'category', 'return_policy', 'shipping_price', 'price'];

    foreach($requiredFields as $requiredField){
        if($_REQUEST[$requiredField] == ''){
            $inputValidFlag = false;
        }
    }

    $categoryClass = new BuckysShopCategory();
    $category = $categoryClass->getCategoryByID($_REQUEST['category']);

    if(!$category['isDownloadable'] && $_REQUEST['location'] == ''){
        $inputValidFlag = false;
    }else if($category['isDownloadable'] == 1){
        $_REQUEST['location'] = 0;
    }

    if(isset($_REQUEST['price']) && (!is_numeric($_REQUEST['price']) || $_REQUEST['price'] <= 0)){
        $inputValidFlag = false;
    }

    $shippingPriceList = [];
    if(isset($_REQUEST['shipping_price'])){

        $shippingPriceList = json_decode($_REQUEST['shipping_price'], true);
        if(!is_array($shippingPriceList) || count($shippingPriceList) < 1){
            $inputValidFlag = false;
        }
    }

    $actionType = get_secure_string($_REQUEST['type']);
    $paramProdID = get_secure_integer($_REQUEST['productID']);
    $listingFeeType = null;
    $data = [];

    $editableFlag = false;

    if($actionType == 'relist'){

        $shopItemData = $shopProductIns->getProductById($paramProdID, true);

        if(!$shopItemData){
            echo json_encode(['success' => 0, 'msg' => 'You could not relist this item.']);
            exit;
        }

        $listingFeeType = get_secure_integer($_REQUEST['listing_fee_type']);

        if($listingFeeType === null){
            $inputValidFlag = false;
        }else{
            //check if you can relist them

            if($shopProductIns->hasMoneyToListProduct($userID, $listingFeeType)){
                //Ok you can relist the product
            }else{
                echo json_encode(['success' => 0, 'msg' => 'You could not relist this item. You have no credits or bitcoin.']);
                exit;
            }

        }

        //you can relist this item
        $data['createdDate'] = date('Y-m-d H:i:s');

        if($shopItemData['userID'] == $userID){
            $editableFlag = true;
        }else{
            $editableFlag = false;
        }

    }else{
        $shopItemData = $shopProductIns->getProductById($paramProdID, false);
        if($shopItemData && $shopItemData['userID'] == $userID){
            $editableFlag = true;
        }
    }

    if($inputValidFlag){

        if($editableFlag){

            $data['title'] = get_secure_string($_REQUEST['title']);
            $data['subtitle'] = get_secure_string($_REQUEST['subtitle']);
            $data['description'] = get_secure_string($_REQUEST['description']);
            $data['catID'] = get_secure_string($_REQUEST['category']);
            $data['images'] = get_secure_string($_REQUEST['images']);
            $data['locationID'] = get_secure_string($_REQUEST['location']);
            $data['returnPolicy'] = get_secure_string($_REQUEST['return_policy']);
            $data['price'] = get_secure_string($_REQUEST['price']);
            $data['listingDuration'] = get_secure_string($_REQUEST['listing_duration']);
            $data['expiryDate'] = $data['listingDuration'] == -1 ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', time() + 3600 * 24 * $data['listingDuration']);

            $data['images'] = moveShopTmpImages($data['images']);
            if($data['images'] === false){
                echo json_encode(['success' => 0, 'msg' => 'Something goes wrong, please contact administrator.']);
                exit;
            }

            if($actionType == 'relist'){
                $flag = $shopProductIns->payListingFee($userID, $paramProdID, $listingFeeType);
                if(!$flag){
                    echo json_encode(['success' => 0, 'msg' => 'You could not relist this item. You have no credits or bitcoin.']);
                    exit;
                }
            }

            if($category['isDownloadable'] == 1 && !empty($_REQUEST['filename'])){
                if(!$_REQUEST['filename'] || file_exists(DIR_FS_SHOP_IMG_TMP . $_REQUEST['filename'])){
                    echo json_encode(['success' => 0, 'msg' => 'Please select a zip file.']);
                    exit;
                }
                $data['isDownloadable'] = 1;
                $filename = moveShopTmpProduct($_REQUEST['filename']);
                //Remove Old File
                @unlink(DIR_FS_SHOP_PRODUCTS . $shopItemData['fileName']);
                $data['fileName'] = $filename;
            }

            $shopProductIns->updateProduct($paramProdID, $data);
            $shopProductIns->updateShippingPrice($paramProdID, $shippingPriceList);
            echo json_encode(['success' => 1, 'msg' => 'An item has been updated successfully.']);

        }else{
            echo json_encode(['success' => 0, 'msg' => "You don't have permission."]);
        }

    }else{
        //error
        echo json_encode(['success' => 0, 'msg' => 'Please input required field(s).']);
    }
}

/**
 * Delete Shop products by ajax

 */
function deleteShopProduct(){

    $userID = buckys_is_logged_in();
    $paramProductID = get_secure_integer($_REQUEST['productID']);

    if(is_numeric($paramProductID) && $userID){

        buckys_get_messages();
        $shopProdIns = new BuckysShopProduct();
        $shopProdIns->removeProductByUserID($paramProductID, $userID);
    }

}

/**
 * Move temp images from temp directory.
 *
 * @param mixed $image
 */
function moveShopTmpImages($images){

    $imageList = explode('|', $images);

    $tmpStrPath = str_replace(DIR_FS_SHOP_IMG, '/', DIR_FS_SHOP_IMG_TMP);
    $userID = buckys_is_logged_in();

    if(count($imageList) > 0 && $userID){

        $rootPath = rtrim(DIR_FS_ROOT, '/');

        if(!is_dir(DIR_FS_SHOP_IMG . $userID)){
            $createSuccessFlag = mkdir(DIR_FS_SHOP_IMG . $userID, 0777);
            //Create Index.html to prevent directory listing issue
            $fp = fopen(DIR_FS_SHOP_IMG . $userID . "/index.html", "w");
            fclose($fp);

            if($createSuccessFlag === false)
                return false;
        }

        foreach($imageList as $imgFile){

            if(strpos($imgFile, $tmpStrPath) !== false){
                $newFilePath = str_replace($tmpStrPath, '/' . $userID . '/', $imgFile);
                @copy($rootPath . $imgFile, $rootPath . $newFilePath);
                @unlink($rootPath . $imgFile);

                $thumbPathInfo = pathinfo($rootPath . $newFilePath);
                $thumbFileName = $thumbPathInfo['dirname'] . "/" . $thumbPathInfo['filename'] . SHOP_PRODUCT_IMAGE_THUMB_SUFFIX . "." . $thumbPathInfo['extension'];
                unset($resizeImageIns);
                $resizeImageIns = new SimpleImage($rootPath . $newFilePath);
                $resizeImageIns->square_crop(150);
                $resizeImageIns->save($thumbFileName);
            }

        }

        $images = str_replace($tmpStrPath, '/' . $userID . '/', $images);

        return $images;

    }else{
        return '';
    }

}

function moveShopTmpProduct($filename){

    if(!is_dir(DIR_FS_SHOP_PRODUCTS)){
        $createSuccessFlag = mkdir(DIR_FS_SHOP_PRODUCTS . $userID, 0777);
        //Create Index.html to prevent directory listing issue
        $fp = fopen(DIR_FS_SHOP_PRODUCTS . "/index.html", "w");
        fclose($fp);

        //Create htaccess file
        $fp = fopen(DIR_FS_SHOP_PRODUCTS . "/.htaccess", "w");
        fputs($fp, 'order deny,allow' . PHP_EOL);
        fputs($fp, 'deny from all' . PHP_EOL);
        fclose($fp);
    }

    $newname = md5(uniqid()) . ".zip";
    @copy(DIR_FS_TMP . $filename, DIR_FS_SHOP_PRODUCTS . $newname);
    @unlink(DIR_FS_TMP . $filename);

    return $newname;
}

/**
 * Purchase product function
 * this function is POST

 */
function purchaseProduct(){

    $productIns = new BuckysShopProduct();
    $orderIns = new BuckysShopOrder();

    $buyerID = get_secure_integer($_REQUEST['buyerID']);
    $productID = get_secure_integer($_REQUEST['productID']);

    $userID = buckys_is_logged_in();

    //Can  you purchase this item?
    if($buyerID != $userID){
        buckys_redirect('/shop/view.php?id=' . $productID, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
    }

    //Product is active?
    $prodData = $productIns->getProductById($productID, false);

    if(!$prodData || $prodData['status'] == BuckysShopProduct::STATUS_INACTIVE){
        echo "here";
        exit;
        buckys_redirect('/shop/index.php' . $productID, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }

    //Is this your product?
    if($prodData['userID'] == $buyerID){
        buckys_redirect('/shop/view.php?id=' . $productID, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
    }

    //Shipping price is set?
    if(!$prodData['isDownloadable']){
        $shippingPrice = fn_buckys_get_available_shipping_price($buyerID, $productID);
        if($shippingPrice === null){
            buckys_redirect('/shop/view.php?id=' . $productID, 'This item can not be shipped to your address. Check your shipping address or contact the owner.', MSG_TYPE_ERROR);
        }
    }else{
        $shippingPrice = 0;
    }

    //Do you have money?
    $balance = BuckysBitcoin::getUserWalletBalance($buyerID);
    $balance = 100;
    $total = $prodData['price'] + $shippingPrice;

    if($total > $balance){
        buckys_redirect('/shop/view.php?id=' . $productID, 'You do not have bitcoin enough to purchase this item.', MSG_TYPE_ERROR);
    }

    //Purchase product

    $flag = $orderIns->makePayment($buyerID, $prodData['userID'], $total);

    if($flag){
        if(!$prodData['isDownloadable']){
            $buyerShippingInfoID = $orderIns->createShippingInfo($buyerID);
        }else{
            $buyerShippingInfoID = 0;
        }

        $param = ['sellerID' => $prodData['userID'], 'buyerID' => $buyerID, 'productID' => $productID, 'unitPrice' => $prodData['price'], 'shippingPrice' => $shippingPrice, 'totalPrice' => $total, 'buyerShippingID' => $buyerShippingInfoID, 'trackingNo' => '', 'createdDate' => date('Y-m-d H:i:s'), 'status' => BuckysShopOrder::STATUS_SOLD];

        if($orderIns->createOrder($param)){
            buckys_redirect('/shop/purchase.php', 'You have purchased an item successfully!', MSG_TYPE_SUCCESS);
        }else{
            buckys_redirect('/shop/view.php?id=' . $productID, 'Something goes wrong with your purchase. Please contact customer support!', MSG_TYPE_ERROR);
        }

    }else{
        buckys_redirect('/shop/view.php?id=' . $productID, 'Payment problem. Please contact customer support!', MSG_TYPE_ERROR);
    }

}

/**
 * Save Tracking number

 */
function saveTrackingNumber(){

    $userID = buckys_is_logged_in();

    if(!$userID){
        //You should be logged in
        return;
    }else{

        $orderIns = new BuckysShopOrder();

        $orderID = get_secure_integer($_REQUEST['orderID']);
        $trackingNo = get_secure_string($_REQUEST['trackingNo']);

        $orderData = $orderIns->getOrderByID($orderID);
        if(empty($orderData) || ($orderData['sellerID'] != $userID)){
            //error, no permission
            echo json_encode(['success' => 0, 'msg' => "You do not have permission."]);
        }else{
            $orderIns->updateOrder($orderID, ['trackingNo' => $trackingNo]);
            echo json_encode(['success' => 1, 'msg' => "You have saved tracking number successfully.", 'trackingNo' => $trackingNo]);
        }

    }
}

/**
 * Save feedback;

 */
function saveFeedback(){

    $userID = buckys_is_logged_in();

    if(!$userID){
        //You should be logged in
        return;
    }else{

        $feedbackIns = new BuckysFeedback();
        $orderIns = new BuckysShopOrder();

        $orderID = get_secure_integer($_REQUEST['orderID']);
        $score = get_secure_string($_REQUEST['score']);
        $feedback = get_secure_string($_REQUEST['feedback']);

        $orderData = $orderIns->getOrderByID($orderID);

        $feedbackID = null;
        if($orderData['buyerID'] == $userID){
            $feedbackID = $feedbackIns->addFeedback($userID, $score, $feedback, $orderID, BuckysFeedback::ACTIVITY_TYPE_SHOP);
        }

        if(!$feedbackID)
            echo json_encode(['success' => 0, 'msg' => "You do not have permission."]);else
            echo json_encode(['success' => 1, 'msg' => "You have left feedback successfully."]);
    }

}

exit;