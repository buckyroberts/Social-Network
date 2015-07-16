<?php

/**
 * Buckys Feedback management
 * It will have buckys feedbacks for trade section and shop section
 */
class BuckysFeedback {

    const ACTIVITY_TYPE_TRADE = 1;
    const ACTIVITY_TYPE_SHOP = 2;

    /**
     * Add feedback
     *
     * @param mixed $writerID
     * @param mixed $score
     * @param mixed $feedback
     * @param mixed $activityID
     * @param mixed $activityType
     * @return int|null|string|void
     */
    public function addFeedback($writerID, $score, $feedback, $activityID, $activityType = BuckysFeedback::ACTIVITY_TYPE_TRADE){
        global $db;

        if(!is_numeric($activityID) || !is_numeric($writerID) || !is_numeric($score) || $feedback == ''
        )
            return; // failed

        //If you left feedback already, then return    
        if($this->hasFeedback($writerID, $activityID, $activityType))
            return; //exists

        $param = ['activityID' => $activityID, 'activityType' => $activityType, 'writerID' => $writerID, 'score' => $score, 'comment' => $feedback, 'createdDate' => date('Y-m-d H:i:s')];

        $otherUserID = null;

        switch($activityType){
            case BuckysFeedback::ACTIVITY_TYPE_TRADE:

                $tradeIns = new BuckysTrade();
                $tradeData = $tradeIns->getTradeByID($activityID);
                if(!$tradeData)
                    return; //no such trade

                if($tradeData['sellerID'] == $writerID){

                    $otherUserID = $param['receiverID'] = $tradeData['buyerID'];
                    $param['itemID'] = $tradeData['buyerItemID'];
                }else if($tradeData['buyerID'] == $writerID){
                    $otherUserID = $param['receiverID'] = $tradeData['sellerID'];
                    $param['itemID'] = $tradeData['sellerItemID'];
                }else{
                    return; //no rights
                }

                break;

            case BuckysFeedback::ACTIVITY_TYPE_SHOP:

                $shopOrderIns = new BuckysShopOrder();
                $orderData = $shopOrderIns->getOrderByID($activityID);

                if(!$orderData || $orderData['buyerID'] != $writerID)
                    return; //no such trade

                $otherUserID = $param['receiverID'] = $orderData['sellerID'];
                $param['itemID'] = $orderData['productID'];

                break;

            default:
                return; //no such cases
                break;
        }

        $newID = $db->insertFromArray(TABLE_FEEDBACK, $param);

        if($newID && $otherUserID){
            //Update TradeUser Table for rating calculation
            $this->_updateRanking($otherUserID);
        }

        //Create notification
        $tradeNotificationIns = new BuckysTradeNotification();
        $tradeNotificationIns->createNotification($otherUserID, $writerID, BuckysTradeNotification::ACTION_TYPE_FEEDBACK, $newID);

        return $newID;
    }

    /**
     * Get Feedback By ID
     *
     * @param $feedbackID
     * @return array|void
     */
    public function getFeedbackByID($feedbackID){

        global $db;

        if(!is_numeric($feedbackID))
            return;

        $query = sprintf('SELECT * FROM %s WHERE feedbackID=%d', TABLE_FEEDBACK, $feedbackID);

        $data = $db->getRow($query);

        return $data;

    }

    /**
     * Get Feedback By Activity type and id
     *
     * @param mixed $activityID
     * @param mixed $activityType
     * @return stdClass
     */
    public function getFeedbackByActivityID($activityID, $activityType = BuckysFeedback::ACTIVITY_TYPE_TRADE){

        global $db;

        if(!is_numeric($activityID))
            return;

        $query = sprintf('SELECT * FROM %s WHERE activityID=%d AND activityType=%d', TABLE_FEEDBACK, $tradeID, $activityType);

        $data = $db->getRow($query);

        return $data;

    }

    /**
     * Get feedback data by userID
     *
     * @param integer $userID
     * @param string  $type
     * @return Indexed|void
     */
    public function getFeedbackByUserID($userID, $type){

        global $db;

        if(!is_numeric($userID))
            return;

        $query = sprintf('
                SELECT tFeedback.*, tItem.title AS tradeItemTitle, tShopProd.title AS productTitle, rUser.totalRating AS receiverRating, rUser.positiveRating AS receiverPositiveRating, wUser.totalRating AS writerRating, wUser.positiveRating AS writerPositiveRating 
                FROM %s AS tFeedback 
                    LEFT JOIN %s AS tItem ON tItem.itemID=tFeedback.itemID AND tFeedback.activityType=%d 
                    LEFT JOIN %s AS tShopProd ON tShopProd.productID=tFeedback.itemID AND tFeedback.activityType=%d 
                    LEFT JOIN %s AS rUser ON rUser.userID=tFeedback.receiverID 
                    LEFT JOIN %s AS wUser ON wUser.userID=tFeedback.writerID 
            ', TABLE_FEEDBACK, TABLE_TRADE_ITEMS, BuckysFeedback::ACTIVITY_TYPE_TRADE, TABLE_SHOP_PRODUCTS, BuckysFeedback::ACTIVITY_TYPE_SHOP, TABLE_USERS_RATING, TABLE_USERS_RATING, $userID);

        switch($type){
            case 'received':
                $whereCond = sprintf('WHERE tFeedback.receiverID=%d ORDER BY tFeedback.feedbackID DESC', $userID);
                break;
            case 'given':
                $whereCond = sprintf('WHERE tFeedback.writerID=%d ORDER BY tFeedback.feedbackID DESC', $userID);
                break;
            default:
                return; //something goes wrong.

        }

        $query .= $whereCond;

        $feedbackList = $db->getResultsArray($query);

        return $feedbackList;

    }

    /**
     * get Received Feedback Count
     *
     * @param integer $userID
     * @param boolean $isPositiveOnly
     * @return int
     */
    public function getReceivedFeedbackCount($userID, $isPositiveOnly){

        if(!is_numeric($userID)){
            return 0;
        }

        global $db;

        if($isPositiveOnly){
            $query = sprintf('SELECT count(*) AS ratingCount FROM %s WHERE receiverID=%d AND score > 0', TABLE_FEEDBACK, $userID);
            $result = $db->getRow($query);
        }else{
            $query = sprintf('SELECT count(*) AS ratingCount FROM %s WHERE receiverID=%d', TABLE_FEEDBACK, $userID);
            $result = $db->getRow($query);
        }

        if($result)
            return $result['ratingCount'];else
            return 0;

    }

    /**
     * It will update user feedback ranking when you leave feedback;
     */
    public function _updateRanking($userID){

        global $db;

        if(!is_numeric($userID))
            return;

        $totalFeedback = $this->getReceivedFeedbackCount($userID, false);
        $positiveFeedback = $this->getReceivedFeedbackCount($userID, true);

        $param = ['totalRating' => $totalFeedback, 'positiveRating' => $positiveFeedback];

        //if this is first feedback
        $ratingVal = $this->getUserRating($userID);
        if($ratingVal){
            //update
            $db->updateFromArray(TABLE_USERS_RATING, $param, ['userID' => $userID]);
        }else{
            $param['userID'] = $userID;
            $db->insertFromArray(TABLE_USERS_RATING, $param);
        }

        return true;

    }

    /**
     * Get user Rating
     *
     * @param mixed $userID
     * @return stdClass
     */
    public function getUserRating($userID){

        global $db;

        if(!is_numeric($userID))
            return;

        $query = sprintf('SELECT * FROM %s WHERE userID=%d', TABLE_USERS_RATING, $userID);

        $data = $db->getRow($query);

        return $data;
    }

    /**
     * Check if the writer writes already.
     *
     * @param mixed $writerID
     * @param mixed $activityID
     * @param mixed $activityType
     * @return bool
     */
    function hasFeedback($writerID, $activityID, $activityType){

        global $db;

        if(!is_numeric($writerID))
            return false;

        $query = sprintf('SELECT * FROM %s WHERE writerID=%d AND activityID=%d AND activityType=%d', TABLE_FEEDBACK, $userID, $activityID, $activityType);

        $data = $db->getRow($query);

        if(!$data){
            return false;
        }else{
            return true;
        }

    }

    /**
     * Get Trade Feedbacks
     *
     * @param mixed $tradeIDs
     * @return array|Indexed
     */
    public function getTradeFeedbackList($tradeIDs){

        global $db;

        $feedbackList = [];

        if(!is_array($tradeIDs) && $tradeIDs){
            $tradeIDs = explode(',', $tradeIDs);
        }

        if(is_array($tradeIDs) && count($tradeIDs) > 0){
            $query = sprintf('SELECT * FROM %s WHERE activityType=%d AND activityID IN (%s)', TABLE_FEEDBACK, BuckysFeedback::ACTIVITY_TYPE_TRADE, implode(',', $tradeIDs));
            $feedbackList = $db->getResultsArray($query);
        }

        return $feedbackList;

    }

    /**
     * Get feedback;
     *
     * @param $tradeID
     * @return Indexed
     */
    public function getTradeFeedback($tradeID){

        global $db;

        $result = null;
        if(is_numeric($tradeID)){
            $query = sprintf('SELECT * FROM %s WHERE activityType=%d AND activityID=%d', TABLE_FEEDBACK, BuckysFeedback::ACTIVITY_TYPE_TRADE, $tradeID);
            $result = $db->getResultsArray($query);
        }
        return $result;

    }

}