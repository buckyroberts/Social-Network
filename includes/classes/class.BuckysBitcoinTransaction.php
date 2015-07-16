<?php

/**
 * Buckys Bitcoin Transaction
 */
class BuckysBitcoinTransaction {

    const ACTIVITY_TYPE_LISTING_PRODUCT = 1;
    const ACTIVITY_TYPE_PRODUCT_PURCHASE = 2;
    const ACTIVITY_TYPE_LISTING_TRADE_ITEM = 3;

    const STATUS_PENDING = 0;
    const STATUS_ACTIVE = 1;

    const TNB_BITCOIN_RECEIVER_ID = 0;

    /**
     * Add transaction of bitcoin
     *
     * @param mixed $receiverID
     * @param mixed $payerID
     * @param mixed $activityType
     * @param mixed $activityID
     * @param mixed $amount
     * @return int|null|string|void
     */
    public static function addTransaction($receiverID, $payerID, $activityType, $activityID, $amount){
        global $db;

        if(!is_numeric($receiverID) || !is_numeric($payerID) || !is_numeric($activityType) || !is_numeric($activityID) || !is_numeric($amount) || $amount < 0
        )
            return; // failed

        $param = ['receiverID' => $receiverID, 'payerID' => $payerID, 'activityType' => $activityType, 'activityID' => $activityID, 'amount' => $amount, 'createdDate' => date('Y-m-d H:i:s'), 'status' => BuckysBitcoinTransaction::STATUS_ACTIVE];

        $newID = $db->insertFromArray(TABLE_BITCOIN_TRANSACTION, $param);

        return $newID;
    }

}