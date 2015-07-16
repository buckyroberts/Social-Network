<?php

/**
 * Shop Order management
 */
class BuckysShopOrder {

    const STATUS_SOLD = 1;

    const ORDER_READ = 1;
    const ORDER_NEW = 0;

    const ORDER_NOT_ARCHIVED = 0;
    const ORDER_ARCHIVED = 1;

    const NOTIFICATION_OBJECT_TYPE = 'shop';
    const NOTIFICATION_ACTIVITY_TYPE_SOLD = 'sold';

    /**
     * Get Order by ID
     *
     * @param mixed $orderID
     * @param mixed $status
     * @return stdClass
     */
    public function getOrderByID($orderID, $status = BuckysShopOrder::STATUS_SOLD){

        global $db;

        if(!is_numeric($orderID))
            return;

        $query = sprintf('SELECT * FROM %s WHERE orderID=%d AND STATUS=%d', TABLE_SHOP_ORDERS, $orderID, $status);

        $data = $db->getRow($query);

        return $data;

    }

    /**
     * @param $orderID
     * @param $data
     */
    public function updateOrder($orderID, $data){

        global $db;

        if(isset($data['price']))
            $data['price'] = fn_buckys_get_btc_price_formated($data['price']);

        $res = $db->updateFromArray(TABLE_SHOP_ORDERS, $data, ['orderID' => $orderID]);

        return;

    }

    /**
     * Create Order by array
     *
     * @param mixed $data
     * @return bool|int|null|string
     */
    public function createOrder($data){

        global $db;

        $newID = $db->insertFromArray(TABLE_SHOP_ORDERS, $data);

        if($newID){

            //Create bitcoin transaction
            BuckysBitcoinTransaction::addTransaction($data['sellerID'], $data['buyerID'], BuckysBitcoinTransaction::ACTIVITY_TYPE_PRODUCT_PURCHASE, $newID, $data['totalPrice']);

            $shopProdIns = new BuckysShopProduct();

            $product = $shopProdIns->getProductById($data['productID']);

            if(!$product['isDownloadable'])
                $shopProdIns->updateProduct($data['productID'], ['status' => BuckysShopProduct::STATUS_SOLD]);

            //Send notification if the seller wants to get notification

            $notificationIns = new BuckysShopNotification();
            $notificationIns->createNotification($data['sellerID'], $data['buyerID'], BuckysShopNotification::ACTION_TYPE_PRODUCT_SOLD, $newID);

            return $newID;
        }

        return false;

    }

    /**
     * make payment
     *
     * @param mixed $buyerID
     * @param mixed $sellerID
     * @param mixed $amount
     */
    public function makePayment($buyerID, $sellerID, $amount){

        $sellerBitcoinInfo = BuckysUser::getUserBitcoinInfo($sellerID);

        if($amount <= 0 || !$sellerBitcoinInfo){
            return false; //no payment
        }

        $flag = BuckysBitcoin::sendBitcoin($buyerID, $sellerBitcoinInfo['bitcoin_address'], $amount);
        buckys_get_messages(); // this will flash the messages

        return $flag;

    }

    /**
     * Get sold product count, not read, new one
     *
     * @param mixed $userID
     */
    public function getNewSoldItemCount($userID){

        global $db;

        $query = sprintf('SELECT COUNT(*) AS count FROM %s WHERE sellerID=%d AND isRead=%d', TABLE_SHOP_ORDERS, $userID, BuckysShopOrder::ORDER_NEW);

        $result = $db->getRow($query);

        return $result['count'];

    }

    /**
     * Get purchased order history
     *
     * @param integer $userID
     * @return Array
     */
    public function getPurchased($userID, $isArchived = BuckysShopOrder::ORDER_NOT_ARCHIVED){

        global $db;

        if(!is_numeric($userID)){
            return null;
        }

        $archivedStr = '';

        if($isArchived !== null){
            $archivedStr = ' AND o.isArchived=' . $isArchived . ' ';
        }

        $query = sprintf('SELECT o.*, p.title, p.price, p.subtitle, p.images, f.score, p.isDownloadable
            FROM %s AS o 
             LEFT JOIN %s AS p ON p.productID=o.productID 
             LEFT JOIN %s AS f ON f.activityID=o.orderID AND f.activityType=%d 
             WHERE o.buyerID=%d AND o.status=%d %s ORDER BY o.createdDate DESC', TABLE_SHOP_ORDERS, TABLE_SHOP_PRODUCTS, TABLE_FEEDBACK, BuckysFeedback::ACTIVITY_TYPE_SHOP, $userID, BuckysShopOrder::STATUS_SOLD, $archivedStr);

        return $db->getResultsArray($query);

    }

    /**
     * Get sold history
     *
     * @param integer $userID
     * @return Array
     */
    public function getSold($userID){

        global $db;

        if(!is_numeric($userID)){
            return null;
        }

        $query = sprintf('SELECT o.*, p.title, p.price, p.subtitle, p.images, f.score, p.isDownloadable,
                            CONCAT(u.firstName, " ", u.lastName) AS fullName,
                            tu.shippingAddress AS address,
                            tu.shippingAddress2 AS address2,
                            tu.shippingCity AS city,
                            tu.shippingState AS state,
                            tu.shippingZip AS zip,
                            tu.shippingCountryID AS countryID
            FROM %s AS o 
            LEFT JOIN %s AS tu ON tu.userID=o.buyerID
            LEFT JOIN %s AS u ON u.userID=o.buyerID
            LEFT JOIN %s AS p ON p.productID=o.productID 
            LEFT JOIN %s AS f ON f.activityID=o.orderID AND f.activityType=%d 
            WHERE o.sellerID=%d AND o.status=%d ORDER BY o.createdDate DESC', TABLE_SHOP_ORDERS, TABLE_TRADE_USERS, TABLE_USERS, TABLE_SHOP_PRODUCTS, TABLE_FEEDBACK, BuckysFeedback::ACTIVITY_TYPE_SHOP, $userID, BuckysShopOrder::STATUS_SOLD);

        return $db->getResultsArray($query);

    }

    /**
     * Archive order with order ID
     *
     * @param mixed $userID
     * @param mixed $orderID
     */
    public function archiveOrder($userID, $orderID){

        $orderData = $this->getOrderByID($orderID);

        if($orderData){
            if($orderData['buyerID'] == $userID){

                $data = ['isArchived' => BuckysShopOrder::ORDER_ARCHIVED];
                $this->updateOrder($orderID, $data);

                return true;
            }
        }

        return false;

    }

    /**
     * Update the sold item info as read
     *
     * @param mixed $userID
     */
    public function updateSoldAsRead($userID){
        global $db;

        $query = sprintf('UPDATE %s SET isRead=%d WHERE sellerID=%d', TABLE_SHOP_ORDERS, BuckysShopOrder::ORDER_READ, $userID);

        $db->query($query);

    }

    /**
     * Create shipping info
     *
     * @param mixed $userID
     */
    public function createShippingInfo($userID){

        global $db;

        $newID = null;

        $shippingInfoIns = new BuckysTradeUser();
        $myShippingData = $shippingInfoIns->getUserByID($userID);

        if(!$myShippingData){
            return;
        }

        $param = [//            'fullName' => $myShippingData['shippingFullName'],
            'address' => $myShippingData['shippingAddress'], 'address2' => $myShippingData['shippingAddress2'], 'city' => $myShippingData['shippingCity'], 'state' => $myShippingData['shippingState'], 'zip' => $myShippingData['shippingZip'], 'countryID' => $myShippingData['shippingCountryID']];

        $newID = $db->insertFromArray(TABLE_SHOP_ORDERS_SHIPPING, $param);

        return $newID;

    }

}