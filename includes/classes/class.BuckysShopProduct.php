<?php

/**
 * Shop Product management
 */
class BuckysShopProduct {

    const SHIPPING_LOCATION_WORLDWIDE = 0;
    const LIST_FEE_PAYMENT_TYPE_CREDIT = 0;
    const LIST_FEE_PAYMENT_TYPE_BTC = 1;
    const STATUS_INACTIVE = 0;  // Product has been inactivated. When user banned, all products (status=new) will be changed to this inactive
    const STATUS_ACTIVE = 1;    // Is available product for sale.
    const STATUS_SOLD = 2;      // Has been sold

    /**
     * Check if the user has credits or BTC to list the product
     *
     * @param mixed $userID
     * @param mixed $paymentType
     * @return boolean
     */
    public function hasMoneyToListProduct($userID, $paymentType = BuckysShopProduct::LIST_FEE_PAYMENT_TYPE_BTC){

        if($paymentType == BuckysShopProduct::LIST_FEE_PAYMENT_TYPE_CREDIT){
            $tradeUserIns = new BuckysTradeUser();
            return $tradeUserIns->hasCredits($userID, SHOP_PRODUCT_LISTING_FEE_IN_CREDIT);
        }else if($paymentType == BuckysShopProduct::LIST_FEE_PAYMENT_TYPE_BTC){
            $balance = BuckysBitcoin::getUserWalletBalance($userID);
            return $balance >= SHOP_PRODUCT_LISTING_FEE_IN_BTC;

        }else{
            return false;
        }

    }

    /**
     * Add Products, use BTC or credit to list them
     *
     * @param mixed $data
     * @param mixed $paymentType
     * @return int|null|string|void
     */
    public function addProduct($data, $paymentType = BuckysShopProduct::LIST_FEE_PAYMENT_TYPE_BTC){

        if(!$this->hasMoneyToListProduct($data['userID'], $paymentType)){
            //You don't have money to list this product
            return;
        }

        global $db;

        if(empty($data['userID']) || empty($data['title']) || empty($data['subtitle']) || empty($data['price']) || empty($data['catID'])
        )
            return;

        $data['price'] = fn_buckys_get_btc_price_formated($data['price']);

        $newID = $db->insertFromArray(TABLE_SHOP_PRODUCTS, $data);

        if($newID){

            $flag = $this->payListingFee($data['userID'], $newID, $paymentType);

            if(!$flag){
                $this->removeProducts($newID);
                return; //failed since we can't charge you.
            }

        }

        return $newID;
    }

    /**
     * Pay to list products
     *
     * @param mixed $userID
     * @param mixed $paymentType
     * @return bool|int|null|string|void
     */
    public function payListingFee($userID, $prodID, $paymentType = BuckysShopProduct::LIST_FEE_PAYMENT_TYPE_BTC){

        $flag = false;

        if($paymentType == BuckysShopProduct::LIST_FEE_PAYMENT_TYPE_CREDIT){
            $transactionIns = new BuckysTransaction();
            $flag = $transactionIns->useCreditsInShop($userID, SHOP_PRODUCT_LISTING_FEE_IN_CREDIT);

        }else if($paymentType == BuckysShopProduct::LIST_FEE_PAYMENT_TYPE_BTC){

            $flag = BuckysBitcoin::sendBitcoin($userID, SHOP_TNB_LISTING_FEE_RECEIVER_BITCOIN_ADDRESS, SHOP_PRODUCT_LISTING_FEE_IN_BTC);
            buckys_get_messages(); // this will flash the messages

            if($flag){
                //Create bitcoin transaction
                BuckysBitcoinTransaction::addTransaction(BuckysBitcoinTransaction::TNB_BITCOIN_RECEIVER_ID, $userID, BuckysBitcoinTransaction::ACTIVITY_TYPE_LISTING_PRODUCT, $prodID, SHOP_PRODUCT_LISTING_FEE_IN_BTC);
            }

        }

        return $flag;
    }

    /**
     * Remove products from user's shop
     *
     * @param integer $prodID
     * @param integer $userID
     * @return bool|void
     */
    public function removeProductByUserID($prodID, $userID){

        global $db;

        if(is_numeric($userID) && is_numeric($prodID)){

            //Check if this product is new (not sold). If it has been sold already, then it couldn't be deleted
            $prodData = $this->getProductById($prodID);

            if($prodData['status'] == BuckysShopProduct::STATUS_ACTIVE && $prodData['userID'] == $userID){
                $this->removeProducts([$prodID]);
                buckys_add_message('An item has been removed successfully.');
                return true;
            }

        }
        buckys_add_message('Something goes wrong. Please contact customer support!');

        return;

    }

    /**
     * Get products by ID
     *
     * @param integer $prodID    : Product ID
     * @param boolean $isExpired : boolean
     * @return stdClass
     */
    public function getProductById($prodID, $isExpired = null){

        if(empty($prodID) || !is_numeric($prodID) || $prodID <= 0)
            return null;

        global $db;

        $availableQueryStr = '';

        $avaiableTime = date('Y-m-d H:i:s');
        if($isExpired === false){
            $availableQueryStr = " AND (sp.expiryDate >='" . $avaiableTime . "' OR sp.listingDuration=-1) AND sp.status=" . BuckysShopProduct::STATUS_ACTIVE;
        }else if($isExpired === true){
            $availableQueryStr = " AND sp.expiryDate <'" . $avaiableTime . "' AND sp.status=" . BuckysShopProduct::STATUS_ACTIVE;
        }

        $query = sprintf("SELECT sp.*, u.totalRating, u.positiveRating , r.reportID
                FROM %s AS sp 
                LEFT JOIN %s AS r ON r.objectID=sp.productID AND r.objectType='shop_item'
                    LEFT JOIN %s AS u ON sp.userID=u.userID", TABLE_SHOP_PRODUCTS, TABLE_REPORTS, TABLE_USERS_RATING);

        $query .= ' WHERE sp.productID=' . $prodID . $availableQueryStr . " GROUP BY sp.productID ";

        $query = $db->prepare($query);

        $data = $db->getRow($query);

        if($data){
            if(strtotime($avaiableTime) < strtotime($data['createdDate']))
                $data['isExpired'] = false;else
                $data['isExpired'] = true;
        }

        return $data;

    }

    /**
     * Remove Products by product ID list
     *
     * @param array $prodIDList
     */
    public function removeProducts($prodIDList){
        global $db;

        if(is_numeric($prodIDList) && $prodIDList > 0){
            $prodIDList = [$prodIDList];
        }

        if(is_array($prodIDList) && count($prodIDList) > 0){
            $idCondStr = implode(',', $prodIDList);

            $query = sprintf('SELECT * FROM %s WHERE productID IN (%s) AND STATUS=%d', TABLE_SHOP_PRODUCTS, $idCondStr, BuckysShopProduct::STATUS_ACTIVE);
            $prodList = $db->getResultsArray($query);

            if(count($prodList) > 0){

                //remove product images first
                foreach($prodList as $prodData){
                    if($prodData['images'] != ''){
                        $imageList = explode('|', $prodData['images']);

                        if(count($imageList) > 0){
                            foreach($imageList as $key => $val){
                                if($val != ''){
                                    $val = ltrim($val, '/');
                                    $thumb = fn_buckys_get_item_first_image_thumb($val, false);

                                    @unlink(DIR_FS_ROOT . $val);
                                    @unlink(DIR_FS_ROOT . $thumb);
                                }
                            }
                        }

                    }
                }

                //Delete products
                $query = sprintf('DELETE FROM %s WHERE productID IN (%s) AND STATUS=%d', TABLE_SHOP_PRODUCTS, $idCondStr, BuckysShopProduct::STATUS_ACTIVE);
                $db->query($query);
                $query = sprintf('DELETE FROM %s WHERE productID IN (%s)', TABLE_SHOP_ORDERS, $idCondStr);
                $db->query($query);
            }

        }

        return;
    }

    /**
     * Update Product
     *
     * @param integer $productID
     * @param array   $data
     */
    public function updateProduct($productID, $data){

        global $db;

        if(isset($data['price']))
            $data['price'] = fn_buckys_get_btc_price_formated($data['price']);

        $res = $db->updateFromArray(TABLE_SHOP_PRODUCTS, $data, ['productID' => $productID]);

        return;

    }

    /**
     * Add shipping price for a product
     *
     * @param integer $productID
     * @param array   $shippingPriceList array (locationID, price)
     */
    public function addShippingPrice($productID, $shippingPriceList){

        global $db;

        if(!is_numeric($productID) || !is_array($shippingPriceList) || count($shippingPriceList) < 1){
            return;
        }

        foreach($shippingPriceList as $shippingPrice){
            $param = ['productID' => $productID, 'locationID' => $shippingPrice['locationID'], 'price' => fn_buckys_get_btc_price_formated($shippingPrice['price']),];

            $db->insertFromArray(TABLE_SHOP_SHIPPING_PRICE, $param);

        }

    }

    /**
     * Get product shipping price list
     *
     * @param integer $productID
     * @return array
     */
    public function getShippingPrice($productID){

        global $db;

        if(!is_numeric($productID)){
            return;
        }
        $query = sprintf('SELECT * FROM %s WHERE productID=%d', TABLE_SHOP_SHIPPING_PRICE, $productID);

        return $db->getResultsArray($query);

    }

    /**
     * Remove shipping Price node
     *
     * @param integer $idList
     * @return bool|SQLite3Result|void
     */
    public function removeShippingPriceByIDs($idList){

        global $db;

        if(!is_array($idList)){
            $idList = [$idList];
        }

        if(!is_array($idList) || count($idList) < 1)
            return;

        $query = sprintf('DELETE FROM %s WHERE id IN (%s)', TABLE_SHOP_SHIPPING_PRICE, implode(',', $idList));

        return $db->query($query);

    }

    /**
     * Update shipping price list
     *
     * @param integer $productID
     * @param array   $newShippingPriceList
     * @return bool
     */
    public function updateShippingPrice($productID, $newShippingPriceList){

        global $db;

        if(!is_numeric($productID)){
            return;
        }

        $newShippingLocationList = [];
        $delShippingPriceIDList = [];
        foreach($newShippingPriceList as $shippingData){
            $newShippingLocationList[$shippingData['locationID']] = $shippingData['price'];
        }

        $oldShippingPriceList = $this->getShippingPrice($productID);

        if(isset($oldShippingPriceList) && is_array($oldShippingPriceList) && count($oldShippingPriceList) > 0){
            foreach($oldShippingPriceList as $shippingData){
                if(array_key_exists($shippingData['locationID'], $newShippingLocationList)){
                    $query = sprintf('UPDATE %s SET price=%s WHERE id=%d', TABLE_SHOP_SHIPPING_PRICE, $newShippingLocationList[$shippingData['locationID']], $shippingData['id']);
                    $db->query($query);
                    unset($newShippingLocationList[$shippingData['locationID']]);

                }else{
                    $delShippingPriceIDList[] = $shippingData['id'];
                }
            }
        }

        $this->removeShippingPriceByIDs($delShippingPriceIDList);

        if(count($newShippingLocationList) > 0){
            foreach($newShippingLocationList as $key => $val){
                $param = ['productID' => $productID, 'locationID' => $key, 'price' => $val,];

                $db->insertFromArray(TABLE_SHOP_SHIPPING_PRICE, $param);
            }
        }

        return true;

    }

    /**
     * Get Product List
     *
     * @param integer $userID
     * @param boolean $isExpired
     * @param integer $status
     * @param integer $catID
     * @param string  $searchStr
     * @param string  $sortField
     * @param string  $sortDir
     * @return Array of products
     */
    public function getProductList($userID = null, $isExpired = null, $status = null, $catID = null, $searchStr = null, $sortField = 'title', $sortDir = 'ASC'){
        global $db;

        $whereCondList = [];
        if(isset($userID)){
            $whereCondList[] = 'p.userID=' . $userID;
        }

        if(isset($catID)){
            $whereCondList[] = 'p.catID=' . $catID;
        }

        if(isset($searchStr) && $searchStr != ''){
            $searchStr = addslashes($searchStr);
            $whereCondList[] = sprintf(" MATCH (p.title, p.subtitle, p.description) AGAINST ('%s' IN BOOLEAN MODE)", $searchStr);
        }

        $avaiableTime = date('Y-m-d H:i:s');
        if($isExpired === false){
            $whereCondList[] = " (p.expiryDate >='" . $avaiableTime . "' OR p.listingDuration=-1) ";
        }else if($isExpired === true){
            //$whereCondList[] = "p.expiryDate <'" . $avaiableTime . "'";
            $whereCondList[] = "(p.expiryDate <'" . $avaiableTime . "' AND p.listingDuration!=-1) ";
        }

        if(isset($status)){
            $whereCondList[] = 'p.status=' . $status;
        }

        if(count($whereCondList) > 0)
            $whereCond = ' WHERE ' . implode(' AND ', $whereCondList);else
            $whereCond = ' WHERE 1 ';

        $whereCond .= ' GROUP BY p.productID ';

        if(isset($sortField)){
            $whereCond .= sprintf(" ORDER BY %s %s", $sortField, $sortDir);
        }

        $query = sprintf("SELECT p.* FROM %s AS p ", TABLE_SHOP_PRODUCTS);

        $query = $db->prepare($query . $whereCond);

        $data = $db->getResultsArray($query);

        return $data;
    }

    /**
     * Get recent products
     *
     * @param mixed $limit
     * @return Indexed
     */
    public function getRecentProducts($limit = 10){

        if(!is_numeric($limit))
            return;

        global $db;

        $avaiableTime = date('Y-m-d H:i:s');

        $query = sprintf("
                        SELECT p.*, user.firstName, user.lastName 
                        FROM %s AS p 
                            LEFT JOIN %s AS USER ON p.userID=USER.userID
                            WHERE p.status=%d AND (p.expiryDate >='%s' OR p.listingDuration=-1) ORDER BY p.createdDate DESC LIMIT %d 
                            
                    ", TABLE_SHOP_PRODUCTS, TABLE_USERS, BuckysShopProduct::STATUS_ACTIVE, $avaiableTime, $limit);

        $result = $db->getResultsArray($query);

        return $result;
    }

    /**
     * Search products
     *
     * @param string $qStr   : Query String
     * @param string $catStr : Category Name/ Category ID
     * @param string $locStr : Location / Location ID
     * @return array
     */
    public function search($qStr, $catStr, $locStr, $userID){

        global $db;

        $catIns = new BuckysShopCategory();
        $locationIns = new BuckysCountry();

        //Get category data
        $catData = null;
        if(is_numeric($catStr))
            $catData = $catIns->getCategoryByID($catStr);else
            $catData = $catIns->getCategoryByName($catStr);

        //Get Location data
        $locationData = null;
        if(is_numeric($locStr))
            $locationData = $locationIns->getCountryById($locStr);else
            $locationData = $locationIns->getCountryByName($locStr);

        //Make Where condition
        $whereCondList = [];

        if(isset($qStr) && $qStr != ''){
            $qStr = addslashes($qStr);
            $whereCondList[] = sprintf(" MATCH (p.title, p.subtitle, p.description) AGAINST ('%s' IN BOOLEAN MODE)", $qStr);
        }

        if(isset($catData)){
            $whereCondList[] = 'p.catID=' . $catData['catID'];
        }else if($catStr != ''){
            return null;
        }

        if(isset($locationData)){
            $whereCondList[] = 'p.locationID=' . $locationData['countryID'];
        }

        if(isset($userID) && is_numeric($userID)){
            $whereCondList[] = 'p.userID=' . $userID;
        }

        //Valid items
        $avaiableTime = date('Y-m-d H:i:s');
        $whereCondList[] = " (p.expiryDate >='" . $avaiableTime . "' OR p.listingDuration=-1) ";

        $whereCondList[] = 'p.status=' . BuckysShopProduct::STATUS_ACTIVE;

        $whereCond = ' WHERE ' . implode(' AND ', $whereCondList);

        $whereCond .= ' GROUP BY p.productID ';

        $query = sprintf("SELECT p.*, u.firstName, u.lastName, tu.totalRating, tu.positiveRating 
                            FROM %s AS p 
                            LEFT JOIN %s AS tu ON p.userID=tu.userID 
                            LEFT JOIN %s AS u ON p.userID=u.userID 
                            ", TABLE_SHOP_PRODUCTS, TABLE_USERS_RATING, TABLE_USERS);

        $query = $db->prepare($query . $whereCond);

        $data = $db->getResultsArray($query);

        return $data;
    }

    /**
     * Sort Products
     *
     * @param array $prodList
     * @return array
     */
    public function sortProducts($prodList, $sortMod){

        if(!is_array($prodList) || count($prodList) == 0){
            return [];
        }

        $nowTimeVal = time();
        foreach($prodList as &$tmpItem){
            $tmpItem['leftSec'] = strtotime($tmpItem['expiryDate']) - $nowTimeVal;
        }

        switch($sortMod){

            case 'endsoon' :
                usort($prodList, [$this, '_compareEndSoonFirst']);
                break;

            case 'newly' :
                usort($prodList, [$this, '_compareEndSoonLast']);
                break;

            case 'best' :
            default:
                //already sorted
                break;

        }

        return $prodList;

    }

    /**
     * @param $a
     * @param $b
     * @return int
     */
    private function _compareEndSoonFirst($a, $b){
        if($a['leftSec'] == $b['leftSec'])
            return 0;

        return ($a['leftSec'] > $b['leftSec']) ? 1 : -1;
    }

    /**
     * @param $a
     * @param $b
     * @return int
     */
    private function _compareEndSoonLast($a, $b){
        if($a['leftSec'] == $b['leftSec'])
            return 0;

        return ($a['leftSec'] < $b['leftSec']) ? 1 : -1;
    }

    /**
     * Count Products according to the category
     *
     * @param array $prodList
     * @return stdClass
     */
    public function countProductInCategory($prodList){

        $catIns = new BuckysShopCategory();
        $categoryList = $catIns->getCategoryList();

        $catProdCountList = [];
        if(count($prodList) > 0){

            foreach($prodList as $itemData){
                if(isset($catProdCountList[$itemData['catID']])){
                    $catProdCountList[$itemData['catID']]++;
                }else{
                    $catProdCountList[$itemData['catID']] = 1;
                }
            }
        }

        if(count($catProdCountList) > 0 && count($categoryList) > 0){
            foreach($categoryList as &$tmpCatData){
                isset($catProdCountList[$tmpCatData['catID']]) ? $tmpCatData['count'] = $catProdCountList[$tmpCatData['catID']] : $tmpCatData['count'] = 0;
            }
        }

        return $categoryList;
    }

    /**
     * Remove expiredProducts

     */
    public function removeExpiredProducts(){

        global $db;

        $limitDate = date('Y-m-d H:i:s');

        $query = sprintf("SELECT productID FROM %s WHERE STATUS=%d AND expiryDate < '%s'", TABLE_SHOP_PRODUCTS, BuckysShopProduct::STATUS_ACTIVE, $limitDate);

        $oldItemList = $db->getResultsArray($query);
        $idList = [];

        if(count($oldItemList) > 0){

            foreach($oldItemList as $data){
                $idList[] = $data['productID'];
            }

        }

        if(count($idList) > 0){

            //Remove items
            //$this->removeProducts($idList);

        }

        return;

    }

    /**
     * Delete whole products

     */
    public function deleteProductsByUserID($userID){

        global $db;

        if(!is_numeric($userID))
            return;

        $query = sprintf("SELECT productID FROM %s WHERE STATUS!=%d AND userID=%d", TABLE_SHOP_PRODUCTS, BuckysShopProduct::STATUS_SOLD, $userID);

        $oldItemList = $db->getResultsArray($query);
        $idList = [];

        if(count($oldItemList) > 0){

            foreach($oldItemList as $data){
                $idList[] = $data['productID'];
            }
        }

        if(count($idList) > 0){

            //Delete products
            $this->removeProducts($idList);

        }

        return;

    }

    /**
     * Change product status 1) to Activate 2) to make inactive
     * It will find all products belonged to this user, and change status as the $status parameter
     * This function will be called when banning the user or unbanning the user
     *
     * @param integer $userID
     * @param integer $status : value will be one of (STATUS_ITEM_INACTIVE, STATUS_ITEM_ACTIVE)
     * @return bool|void
     */
    public function massStatusChange($userID, $status = BuckysShopProduct::STATUS_INACTIVE){

        global $db;

        if(!is_numeric($userID))
            return;

        $query = '';
        if($status == BuckysShopProduct::STATUS_INACTIVE){

            // To make inactive from active
            $query = sprintf('UPDATE %s SET STATUS=%d WHERE STATUS=%d AND userID=%d', TABLE_SHOP_PRODUCTS, BuckysShopProduct::STATUS_INACTIVE, BuckysShopProduct::STATUS_ACTIVE, $userID);
        }else if($status == BuckysShopProduct::STATUS_ACTIVE){

            // To make active from inactive
            $query = sprintf('UPDATE %s SET STATUS=%d WHERE STATUS=%d AND userID=%d', TABLE_SHOP_PRODUCTS, BuckysShopProduct::STATUS_ACTIVE, BuckysShopProduct::STATUS_INACTIVE, $userID);
        }else{
            //Error
            return;
        }

        $db->query($query);

        return true;

    }

    /**
     * @param $userID
     * @param $productID
     * @return one
     */
    public function isPurchased($userID, $productID){
        global $db;

        $query = $db->prepare("SELECT orderID FROM " . TABLE_SHOP_ORDERS . " WHERE buyerID=%d AND productID=%d", $userID, $productID);
        $oId = $db->getVar($query);

        return $oId;
    }
}