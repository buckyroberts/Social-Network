<?php

/**
 * Trade User Info Management
 */
class BuckysTradeUser {

    /**
     * Get Trade User Info
     *
     * @param integer $userID
     * @return array|void
     */
    public function getUserByID($userID){

        global $db;

        if(!is_numeric($userID))
            return;

        $query = $db->prepare('SELECT * FROM ' . TABLE_TRADE_USERS . ' WHERE userID=%d', $userID);
        $data = $db->getRow($query);

        if(!$data){
            $this->addUser($userID);
            $query = $db->prepare('SELECT * FROM ' . TABLE_TRADE_USERS . ' WHERE userID=%d', $userID);
            $data = $db->getRow($query);
        }

        return $data;
    }

    /**
     * Check duplication
     *
     * @param mixed $userID
     * @return bool|void
     */
    public function checkDuplication($userID){
        global $db;

        if(!is_numeric($userID))
            return;

        $query = $db->prepare('SELECT * FROM ' . TABLE_TRADE_USERS . ' WHERE userID=%d', $userID);
        $data = $db->getRow($query);

        if($data)
            return true;else
            return false;
    }

    /**
     * Add Trade user
     *
     * @param integer $userID
     * @param array   $data
     * @return int|null|string|void
     */
    public function addUser($userID, $data = []){

        global $db;

        $userIns = new BuckysUser();
        if(!is_numeric($userID) || !$userIns->checkUserID($userID, false))
            return;

        if($this->checkDuplication($userID))
            return;

        $user_base_info = buckysuser::getUserBasicInfo($userID);

        if(!$user_base_info){
            return;
        }

        $data['userID'] = $userID;
        $data['shippingFullName'] = trim($user_base_info['firstName'] . ' ' . $user_base_info['lastName']); //When adding address, put your full name to this record

        $newID = $db->insertFromArray(TABLE_TRADE_USERS, $data);

        return $newID;

    }

    /**
     * Update shipping Info
     * It has 2 logic in it. Update your own shipping info, and update already created trade records which has no shipping info.
     *
     * @param integer $userID
     * @param array   $data
     * @return bool
     */
    public function updateShippingInfo($userID, $data){

        if(!is_numeric($userID) || //            $data['shippingFullName'] == '' ||
            $data['shippingAddress'] == '' || $data['shippingCity'] == '' || $data['shippingState'] == '' || $data['shippingZip'] == '' || $data['shippingCountryID'] == '' || !is_numeric($data['shippingCountryID'])
        )
            return false;

        //Update my shipping info
        global $db;

        $db->updateFromArray(TABLE_TRADE_USERS, $data, ['userID' => $userID]);

        //Update trade table which has no shipping info with this info.
        //It will check trade table, and create records in trade_shipping_info
        $tradeIns = new BuckysTrade();
        $tradeShippingInfoIns = new BuckysTradeShippingInfo();

        //---------------- Update for seller ----------------------//
        $requiredList = $tradeIns->getShippingInfoRequiredTrade($userID, 'seller');
        if(!empty($requiredList) && count($requiredList) > 0){
            foreach($requiredList as $tradeData){
                //Add shipping info
                $shippingRecID = $tradeShippingInfoIns->addTradeShippingInfo($userID);
                if(!empty($shippingRecID) && is_numeric($shippingRecID)){
                    //update trade table
                    $tradeIns->updateTrade($tradeData['tradeID'], ['sellerShippingID' => $shippingRecID]);
                }

            }
        }

        //---------------- Update for buyer ----------------------//
        $requiredList = $tradeIns->getShippingInfoRequiredTrade($userID, 'buyer');
        if(!empty($requiredList) && count($requiredList) > 0){
            foreach($requiredList as $tradeData){
                //Add shipping info
                $shippingRecID = $tradeShippingInfoIns->addTradeShippingInfo($userID);
                if(!empty($shippingRecID) && is_numeric($shippingRecID)){
                    //update trade table
                    $tradeIns->updateTrade($tradeData['tradeID'], ['buyerShippingID' => $shippingRecID]);
                }

            }
        }

        //-------------------- Update Buyer Shipping Info -----------------------//
        $tradeShippingInfoIns->updateTradeShippingInfo($userID, $data);

        return true;

    }

    /**
     * Update Trade User
     *
     * @param integer $userID
     * @param array   $data
     * @return bool|void
     */
    public function updateTradeUser($userID, $data){

        global $db;

        if(!is_numeric($userID))
            return false;

        $res = $db->updateFromArray(TABLE_TRADE_USERS, $data, ['userID' => $userID]);

        return;

    }

    /**
     * Get users who are at top, by having items
     *
     * @param integer $limit
     * @return Indexed|void
     */
    public function getUsersTopByItems($limit = 10){

        if(!is_numeric($limit))
            return;

        global $db;

        $avaiableTime = date('Y-m-d H:i:s');

        $query = sprintf("
                        SELECT tUser.*, user.firstName, user.lastName, (SELECT COUNT(*) FROM %s AS tItem WHERE tUser.userID=tItem.userID AND tItem.expiryDate >= '%s' AND tItem.status=%d) AS itemCount 
                        FROM %s AS tUser 
                            LEFT JOIN %s AS USER ON tUser.userID=USER.userID
                            WHERE USER.status=%d ORDER BY itemCount DESC LIMIT %d
                            
                    ", TABLE_TRADE_ITEMS, $avaiableTime, BuckysTradeItem::STATUS_ITEM_ACTIVE, TABLE_TRADE_USERS, TABLE_USERS, BuckysUser::STATUS_USER_ACTIVE, $limit);

        $result = $db->getResultsArray($query);

        return $result;

    }

    /**
     * Check if you have credits
     *
     * @param integer $userID
     * @return bool
     */
    public function hasCredits($userID, $minAmount = 1){

        $userIns = new BuckysUser();
        $userInfo = $userIns->getUserBasicInfo($userID);

        if(!$userInfo)
            return false;

        return $userInfo['credits'] >= $minAmount;

    }

    /**
     * Get all users

     */
    public function getAllUsers(){

        global $db;

        $query = sprintf('SELECT * FROM %s', TABLE_TRADE_USERS);

        $result = $db->getResultsArray($query);

        return $result;

    }

    /**
     * Use one credits
     *
     * @param integer   $userID
     * @param float|int $credits
     * @return float|int
     */
    public function useCredit($userID, $credits = 1){

        //Update credit activity table (credit has been used)
        $transactionIns = new BuckysTransaction();
        $transactionIns->useCreditsInTrade($userID, $credits);

        return $credits;

    }

}
