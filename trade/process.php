<?php
/**
 * Trade ajax action handler
 */
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(isset($_REQUEST['action'])){

    if(function_exists($_REQUEST['action'])){

        $userID = buckys_is_logged_in();
        if(!$userID){
            echo json_encode(['success' => 0, 'msg' => "Please login and try again."]);
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
 * Delete trade item images

 */
function deleteTradeItemImage(){

    $userID = buckys_is_logged_in();

    if(!$userID)
        return;

    $imgFile = @$_REQUEST['file'];
    $paramItemID = get_secure_integer($_REQUEST['itemID']);
    $rootPath = rtrim(DIR_FS_ROOT, '/');
    //remove image files
    if($imgFile != ''){
        @unlink($rootPath . $imgFile);

        //update DB if it is edit action.
        if(isset($paramItemID) && is_numeric($paramItemID)){
            $tmpStrPath = str_replace(DIR_FS_TRADE_IMG, '/', DIR_FS_TRADE_IMG_TMP);
            if(strpos($imgFile, $tmpStrPath) === false){
                $thumbPathInfo = pathinfo($imgFile);
                $thumbFileName = $thumbPathInfo['dirname'] . "/" . $thumbPathInfo['filename'] . TRADE_ITEM_IMAGE_THUMB_SUFFIX . "." . $thumbPathInfo['extension'];

                @unlink($rootPath . $thumbFileName);

                $tradeItemIns = new BuckysTradeItem();
                $itemData = $tradeItemIns->getItemById($paramItemID);
                if(isset($itemData)){
                    $imageList = explode('|', $itemData['images']);

                    if(count($imageList) > 0){
                        $newImageList = [];
                        foreach($imageList as $imgUrl){
                            if($imgUrl == $imgFile)
                                continue;
                            $newImageList[] = $imgUrl;
                        }

                        $newImageStr = implode("|", $newImageList);

                    }

                    $tradeItemIns->updateItem($paramItemID, ['images' => $newImageStr]);

                }

            }
        }

    }
}

/**
 * Add trade Item action by Ajax

 */
function addTradeItem(){

    $inputValidFlag = true;
    $requiredFields = ['title', 'subtitle', 'description', 'category'];

    foreach($requiredFields as $requiredField){
        if($_REQUEST[$requiredField] == ''){
            $inputValidFlag = false;
        }
    }

    // $listingFeeType = get_secure_integer($_REQUEST['listing_fee_type']);
    $listingFeeType = 0; // FreeTradeListings - delete this and uncomment above to enable listing fees

    if($listingFeeType === null){
        $inputValidFlag = false;
    }

    $userID = buckys_is_logged_in();
    if(!$userID)
        return;

    if($inputValidFlag){
        $tradeItemIns = new BuckysTradeItem();

        $data['userID'] = $userID;
        $data['title'] = get_secure_string($_REQUEST['title']);
        $data['subtitle'] = get_secure_string($_REQUEST['subtitle']);
        $data['description'] = get_secure_string($_REQUEST['description']);
        $data['itemWanted'] = get_secure_string($_REQUEST['items_wanted']);
        $data['images'] = get_secure_string($_REQUEST['images']);
        $data['catID'] = get_secure_string($_REQUEST['category']);
        $data['locationID'] = get_secure_string($_REQUEST['location']);
        $data['listingDuration'] = get_secure_string($_REQUEST['listing_duration']);
        $data['expiryDate'] = $data['listingDuration'] == -1 ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', time() + 3600 * 24 * $data['listingDuration']);
        $data['createdDate'] = date('Y-m-d H:i:s');

        $data['images'] = moveTradeTmpImages($data['images']);
        if($data['images'] === false){
            echo json_encode(['success' => 0, 'msg' => 'Something goes wrong, please contact administrator.']);
            exit;
        }

        if($newItemID = $tradeItemIns->addItem($data, $listingFeeType)){
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
 * Edit trade item action by ajax

 */
function editTradeItem(){

    $userID = buckys_is_logged_in();
    if(!$userID)
        return;

    $tradeItemIns = new BuckysTradeItem();
    $inputValidFlag = true;
    $requiredFields = ['title', 'subtitle', 'description', 'category'];

    foreach($requiredFields as $requiredField){
        if($_REQUEST[$requiredField] == ''){
            $inputValidFlag = false;
        }
    }

    $actionType = get_secure_string($_REQUEST['type']);
    $paramItemID = get_secure_integer($_REQUEST['itemID']);
    $data = [];

    $editableFlag = false;

    if($actionType == 'relist'){

        $tradeItemData = $tradeItemIns->getItemById($paramItemID, true);

        if(!$tradeItemData){
            echo json_encode(['success' => 0, 'msg' => 'You could not relist this item.']);
            exit;
        }

        //you can relist this item
        $data['createdDate'] = date('Y-m-d H:i:s');

        $tradeUserIns = new BuckysTradeUser();
        if(!$tradeUserIns->hasCredits($userID)){
            echo json_encode(['success' => 0, 'msg' => 'You could not relist this item. You have no credits.']);
            exit;
        }

        if($tradeItemData['userID'] == $userID){
            $editableFlag = true;
        }else{
            $editableFlag = false;
        }

    }else{
        $tradeItemData = $tradeItemIns->getItemById($paramItemID, false);
        if($tradeItemData && $tradeItemData['userID'] == $userID){
            $editableFlag = true;
        }
    }

    if($inputValidFlag){

        if($editableFlag){

            $data['title'] = get_secure_string($_REQUEST['title']);
            $data['subtitle'] = get_secure_string($_REQUEST['subtitle']);
            $data['description'] = get_secure_string($_REQUEST['description']);
            $data['itemWanted'] = get_secure_string($_REQUEST['items_wanted']);
            $data['images'] = get_secure_string($_REQUEST['images']);
            $data['catID'] = get_secure_string($_REQUEST['category']);
            $data['locationID'] = get_secure_string($_REQUEST['location']);
            $data['listingDuration'] = get_secure_string($_REQUEST['listing_duration']);
            $data['expiryDate'] = $data['listingDuration'] == -1 ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', time() + 3600 * 24 * $data['listingDuration']);

            $data['images'] = moveTradeTmpImages($data['images']);
            if($data['images'] === false){
                echo json_encode(['success' => 0, 'msg' => 'Something goes wrong, please contact administrator.']);
                exit;
            }

            if($actionType == 'relist'){
                $tradeUserIns->useCredit($userID);
            }
            $tradeItemIns->updateItem($paramItemID, $data);
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
 * Delete trade items by ajax

 */
function deleteTradeItem(){

    $userID = buckys_is_logged_in();
    if(!$userID)
        return;

    $paramItemID = get_secure_integer($_REQUEST['itemID']);

    if(is_numeric($paramItemID)){

        buckys_get_messages();
        $tradeItemIns = new BuckysTradeItem();
        $tradeItemIns->removeItemByUserID($paramItemID, $userID);

    }

}

/**
 * Move temp images from temp directory.
 *
 * @param mixed $image
 */
function moveTradeTmpImages($images){

    $imageList = explode('|', $images);

    $tmpStrPath = str_replace(DIR_FS_TRADE_IMG, '/', DIR_FS_TRADE_IMG_TMP);
    $userID = buckys_is_logged_in();

    if(count($imageList) > 0 && $userID){

        $rootPath = rtrim(DIR_FS_ROOT, '/');

        if(!is_dir(DIR_FS_TRADE_IMG . $userID)){
            $createSuccessFlag = mkdir(DIR_FS_TRADE_IMG . $userID, 0777);
            //Create Index.html to prevent directory listing issue
            $fp = fopen(DIR_FS_TRADE_IMG . $userID . "/index.html", "w");
            fclose($fp);

            if($createSuccessFlag === false)
                return $createSuccessFlag;
        }

        foreach($imageList as $imgFile){

            if(strpos($imgFile, $tmpStrPath) !== false){
                $newFilePath = str_replace($tmpStrPath, '/' . $userID . '/', $imgFile);
                @copy($rootPath . $imgFile, $rootPath . $newFilePath);
                @unlink($rootPath . $imgFile);

                $thumbPathInfo = pathinfo($rootPath . $newFilePath);
                $thumbFileName = $thumbPathInfo['dirname'] . "/" . $thumbPathInfo['filename'] . TRADE_ITEM_IMAGE_THUMB_SUFFIX . "." . $thumbPathInfo['extension'];
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

/**
 * Make an offer

 */
function makeAnOffer(){

    $successFlag = true;
    $userID = buckys_is_logged_in();

    if(!$userID){
        return;
    }else{

        //Read Param
        $targetItemID = buckys_escape_query_integer($_REQUEST['targetItemID']);
        $offerItemID = buckys_escape_query_integer($_REQUEST['offerItemID']);

        $tradeItemIns = new BuckysTradeItem();
        $itemData = $tradeItemIns->getItemById($offerItemID, false);
        $targetItemData = $tradeItemIns->getItemById($targetItemID, false);

        if(isset($itemData) && $itemData['status'] == BuckysTradeItem::STATUS_ITEM_ACTIVE && $itemData['userID'] == $userID && isset($targetItemData) && $targetItemData['status'] == BuckysTradeItem::STATUS_ITEM_ACTIVE){
            //Add offer
            $tradeOfferIns = new BuckysTradeOffer();
            $result = $tradeOfferIns->addOffer($targetItemID, $offerItemID);

            if($result){
                echo json_encode(['success' => 1, 'msg' => "You've made an offer successfully."]);
            }else{
                echo json_encode(['success' => 0, 'msg' => "You could not make an offer."]);
            }
        }else{
            echo json_encode(['success' => 0, 'msg' => "You could not make an offer."]);
        }

    }
}

/**
 * Accept offer

 */
function acceptOffer(){

    $userID = buckys_is_logged_in();

    if(!$userID){
        //You should be logged in
        return;
    }else{

        $tradeOfferIns = new BuckysTradeOffer();
        //Read Param
        $offerID = get_secure_integer($_REQUEST['offerID']);

        if($tradeOfferIns->isAcceptableOffer($userID, $offerID)){
            $newTradeID = $tradeOfferIns->acceptOffer($offerID);

            if($newTradeID === false){
                echo json_encode(['success' => 0, 'msg' => "Something goes wrong."]);
            }else if(empty($newTradeID)){
                echo json_encode(['success' => 0, 'msg' => "Something goes wrong."]);
            }else{
                echo json_encode(['success' => 1, 'msg' => "You have accepted an offer successfully."]);
            }
        }else{
            echo json_encode(['success' => 0, 'msg' => "You can't accept this offer."]);
        }

    }

}

/**
 * Decline Offer

 */
function declineOffer(){

    $userID = buckys_is_logged_in();

    if(!$userID){
        //You should be logged in
        return;
    }else{

        $tradeOfferIns = new BuckysTradeOffer();
        //Read Param
        $offerID = get_secure_integer($_REQUEST['offerID']);

        if($tradeOfferIns->isAcceptableOffer($userID, $offerID)){
            $tradeOfferIns->declineOffer($offerID);

            echo json_encode(['success' => 1, 'msg' => "You have declined an offer successfully."]);
        }else{
            echo json_encode(['success' => 0, 'msg' => "You can't decline this offer."]);
        }

    }
}

/**
 * Remove declined offers

 */
function removeDeclinedOffers(){
    $userID = buckys_is_logged_in();

    if(!$userID){
        //You should be logged in
        return;
    }else{

        $tradeOfferIns = new BuckysTradeOffer();
        //Read Param
        $offerIDs = get_secure_string($_REQUEST['offerIDs']);
        $type = get_secure_string($_REQUEST['type']);
        $offerIDList = explode(',', $offerIDs);

        if(count($offerIDList) > 0){
            $tradeOfferIns->removeDeclinedOffers($offerIDList, $userID, $type);

            echo json_encode(['success' => 1, 'msg' => "You have removed selected offer(s) successfully."]);
        }else{
            echo json_encode(['success' => 0, 'msg' => "Please select one of declined offers."]);
        }

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

        $tradeIns = new BuckysTrade();

        $tradeID = buckys_escape_query_integer($_REQUEST['tradeID']);
        $trackingNo = buckys_escape_query_string($_REQUEST['trackingNo']);

        $tradeData = $tradeIns->getTradeByID($tradeID);
        if(empty($tradeData) || ($tradeData['sellerID'] != $userID && $tradeData['buyerID'] != $userID)){
            //error, no permission
            echo json_encode(['success' => 0, 'msg' => "You do not have permission."]);
        }else{
            if($tradeData['sellerID'] == $userID){
                $tradeIns->updateTrade($tradeID, ['sellerTrackingNo' => $trackingNo]);
            }else{
                $tradeIns->updateTrade($tradeID, ['buyerTrackingNo' => $trackingNo]);
            }
            echo json_encode(['success' => 1, 'msg' => "You have saved tracking number successfully."]);
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

        $tradeID = get_secure_integer($_REQUEST['tradeID']);
        $score = get_secure_string($_REQUEST['score']);
        $feedback = get_secure_string($_REQUEST['feedback']);

        $feedbackID = $feedbackIns->addFeedback($userID, $score, $feedback, $tradeID, BuckysFeedback::ACTIVITY_TYPE_TRADE);

        if(!$feedbackID)
            echo json_encode(['success' => 0, 'msg' => "You do not have permission."]);else
            echo json_encode(['success' => 1, 'msg' => "You have left feedback successfully."]);

    }

}

/**
 * Delete offer

 */
function deleteOffer(){
    $userID = buckys_is_logged_in();

    if(!$userID){
        //You should be logged in
        return;
    }else{

        $tradeOfferIns = new BuckysTradeOffer();
        $offerID = get_secure_integer($_REQUEST['offerID']);

        $result = $tradeOfferIns->deleteOfferMade($offerID, $userID);

        if($result){
            echo json_encode(['success' => 1, 'msg' => "You have deleted an offer successfully."]);
        }else{
            echo json_encode(['success' => 0, 'msg' => "You do not have permission."]);
        }

    }
}

exit;