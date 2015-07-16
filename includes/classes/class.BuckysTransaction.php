<?php

class BuckysTransaction {

    public static $COUNT_PER_PAGE = 20;

    const ACTIVITY_TYPE_DEPOSIT_BY_PAYPAL = 0;  // When you buy credits through paypal
    const ACTIVITY_TYPE_PAYMENT_TO_OTHER = 1;   // When you send credits to others
    const ACTIVITY_TYPE_TRADE_ITEM_ADD = 2;     // When you add an item on trade section, you should use 1 credit
    const ACTIVITY_TYPE_SHOP_PRODUCT_ADD = 3;   // When you add A product to shop, you should use credit(s)
    const ACTIVITY_TYPE_OTHER = 9;              // Other type; Not sure if we use this type, but you may add more numbers to add there to show the types

    const TNB_ACCOUNT_ID = 0;            // It will be used for receiverID when user do paypal payment or other payments to site.
    const NO_TRANSACTION_ID = 0;                // no paypal payment has been made
    const PAYPAL_PAYER_ID = 0;                  // it will be used for paypal payment when user purchase credits

    /**
     * Add Transaction
     *
     * @param array $data
     * @return int|null|string|void
     */
    public function addPaypalTransaction($data){
        global $db;

        if(!is_numeric($data['userID']) || empty($data['payer_email']) || empty($data['amount'])
        )
            return;

        $data['createdDate'] = date('Y-m-d H:i:s');
        $newID = $db->insertFromArray(TABLE_TRANSACTIONS, $data);

        //Add credits activity records
        if($newID){
            $credits = 0;
            if($data['amount'] == 3.5){
                //10 Credits
                $credits = 10;
            }else if($data['amount'] == 15){
                //50 Credits
                $credits = 50;
            }else if($data['amount'] == 25){
                //100 Credits
                $credits = 100;
            }else{
                //1 credits for 0.35
                $credits = $data['amount'] / 0.35;
            }

            //Updates user's credits field
            $userIns = new BuckysUser();
            $userInfo = $userIns->getUserBasicInfo($data['userID']);

            if(!$userInfo)
                return;

            $userInfo['credits'] = $userInfo['credits'] + $credits;
            $userIns->updateUserFields($data['userID'], ['credits' => $userInfo['credits']]);

            //Update credits activity
            $data = ['receiverID' => $data['userID'], 'payerID' => BuckysTransaction::PAYPAL_PAYER_ID, 'activityType' => BuckysTransaction::ACTIVITY_TYPE_DEPOSIT_BY_PAYPAL, 'amount' => $credits, 'transactionID' => $newID, 'receiverBalance' => $userInfo['credits'], 'payerBalance' => 0, 'createdDate' => date('Y-m-d H:i:s')];

            $db->insertFromArray(TABLE_CREDIT_ACTIVITY, $data);

        }

        return $newID;
    }

    /**
     * Get Transactions
     *
     * @param Int $userID
     * @param Int $page
     * @return Indexed
     */
    public static function getCreditActivities($userID, $page = 1){
        global $db;

        $query = $db->prepare("SELECT ca.*, CONCAT(ru.firstName, ' ', ru.lastName) AS receiverName,
                                      CONCAT(pu.firstName, ' ', pu.lastName) AS payerName FROM " . TABLE_CREDIT_ACTIVITY . " AS ca " . "LEFT JOIN " . TABLE_USERS . " AS ru ON ca.receiverID=ru.userID " . "LEFT JOIN " . TABLE_USERS . " AS pu ON ca.payerID=pu.userID " . "WHERE ca.receiverID=%d OR ca.payerID=%d ORDER BY createdDate DESC ", $userID, $userID);

        $query .= " LIMIT " . ($page - 1) * BuckysTransaction::$COUNT_PER_PAGE . ", " . BuckysTransaction::$COUNT_PER_PAGE;

        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * Get User Transaction Count
     *
     * @param Int $userID
     * @return one
     */
    public static function getNumOfCreditActivities($userID){
        global $db;

        $query = $db->prepare("SELECT count(1) FROM " . TABLE_CREDIT_ACTIVITY . " WHERE receiverID=%d OR payerID=%d", $userID, $userID);
        $count = $db->getVar($query);

        return $count;
    }

    /**
     * Send Credits
     */
    public static function sendCredits($receiverID, $amount){
        global $db, $TNB_GLOBALS;

        //Getting Receiver Info
        $receiverInfo = BuckysUser::getUserBasicInfo($receiverID);
        if(!$receiverInfo)
            return MSG_INVALID_REQUEST;

        //Getting Current User Credits Balance
        $balance = $TNB_GLOBALS['user']['credits'];

        $amount = floatval($amount);

        if($amount <= 0){
            return MSG_INVALID_AMOUNT_ERROR;
        }

        if($amount > $balance){
            return MSG_BALANCE_NOT_ENOUGH_TO_SEND_ERROR;
        }

        $data = ['receiverID' => $receiverID, 'payerID' => $TNB_GLOBALS['user']['userID'], 'activityType' => BuckysTransaction::ACTIVITY_TYPE_PAYMENT_TO_OTHER, 'amount' => $amount, 'transactionID' => BuckysTransaction::NO_TRANSACTION_ID, 'receiverBalance' => $receiverInfo['credits'] + $amount, 'payerBalance' => $TNB_GLOBALS['user']['credits'] - $amount, 'createdDate' => date('Y-m-d H:i:s')];
        $nId = $db->insertFromArray(TABLE_CREDIT_ACTIVITY, $data);
        if(!$nId)
            return $db->getLastError();

        BuckysUser::updateUserFields($TNB_GLOBALS['user']['userID'], ['credits' => $balance - $amount]);
        BuckysUser::updateUserFields($receiverInfo['userID'], ['credits' => $receiverInfo['credits'] + $amount]);

        return true;
    }

    /**
     * Use credits to list an item on trade section
     *
     * @param mixed $userID
     * @param mixed $amount
     * @return int|null|string|void
     */
    public function useCreditsInTrade($userID, $amount){

        global $db;

        $userIns = new BuckysUser();
        $userInfo = $userIns->getUserBasicInfo($userID);

        if(!$userInfo)
            return;

        $userInfo['credits'] = $userInfo['credits'] - $amount;

        if($userInfo['credits'] < 0)
            return; //you can't use this amount

        $userIns->updateUserFields($userID, ['credits' => $userInfo['credits']]);

        $data = ['receiverID' => BuckysTransaction::TNB_ACCOUNT_ID, 'payerID' => $userID, 'activityType' => BuckysTransaction::ACTIVITY_TYPE_TRADE_ITEM_ADD, 'amount' => $amount, 'transactionID' => BuckysTransaction::NO_TRANSACTION_ID, 'receiverBalance' => 0, 'payerBalance' => $userInfo['credits'], 'createdDate' => date('Y-m-d H:i:s')];

        $nId = $db->insertFromArray(TABLE_CREDIT_ACTIVITY, $data);

        return $nId;

    }

    /**
     * Use credits to list products in shop
     *
     * @param mixed $userID
     * @param {mixed|mixed} $amount
     * @return int|null|string|void {mixed|mixed}
     */
    public function useCreditsInShop($userID, $amount){

        global $db;

        $userIns = new BuckysUser();
        $userInfo = $userIns->getUserBasicInfo($userID);

        if(!$userInfo)
            return;

        $userInfo['credits'] = $userInfo['credits'] - $amount;
        if($userInfo['credits'] < 0)
            return; //you can't use this amount

        $userIns->updateUserFields($userID, ['credits' => $userInfo['credits']]);

        $data = ['receiverID' => BuckysTransaction::TNB_ACCOUNT_ID, 'payerID' => $userID, 'activityType' => BuckysTransaction::ACTIVITY_TYPE_SHOP_PRODUCT_ADD, 'amount' => $amount, 'transactionID' => BuckysTransaction::NO_TRANSACTION_ID, 'receiverBalance' => 0, 'payerBalance' => $userInfo['credits'], 'createdDate' => date('Y-m-d H:i:s')];

        $nId = $db->insertFromArray(TABLE_CREDIT_ACTIVITY, $data);

        return $nId;

    }
}
