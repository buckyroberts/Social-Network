<?php

/**
 * Trade Feedback management
 */
class BuckysTradeFeedback {

    /**
     * Add feedback
     *
     * @param integer $tradeID
     * @param integer $userID
     * @param integer $score : one of this two value, 1 & -1
     * @param string  $feedback
     * @return int
     */
    public function addFeedback($tradeID, $userID, $score, $feedback){
        global $db;

        if(!is_numeric($tradeID) || !is_numeric($userID) || !is_numeric($score) || $feedback == ''
        )
            return; // failed

        if($this->getFeedbackByTradeID($tradeID))
            return; //exists

        //Add
        $tradeIns = new BuckysTrade();
        $tradeData = $tradeIns->getTradeByID($tradeID);
        $otherUserID = null;

        if(!$tradeData)
            return; //no such trade

        if($tradeData['sellerID'] == $userID){
            $param = ['tradeID' => $tradeID, 'sellerID' => $tradeData['sellerID'], 'buyerID' => $tradeData['buyerID'], 'sellerToBuyerScore' => $score, 'sellerToBuyerFeedback' => $feedback, 'sellerToBuyerFeedbackCreatedAt' => date('Y-m-d H:i:s')];
            $otherUserID = $tradeData['buyerID'];
        }else if($tradeData['buyerID'] == $userID){
            $param = ['tradeID' => $tradeID, 'sellerID' => $tradeData['sellerID'], 'buyerID' => $tradeData['buyerID'], 'buyerToSellerScore' => $score, 'buyerToSellerFeedback' => $feedback, 'buyerToSellerFeedbackCreatedAt' => date('Y-m-d H:i:s')];
            $otherUserID = $tradeData['sellerID'];
        }else{
            return; //no rights
        }

        $newID = $db->insertFromArray(TABLE_TRADE_FEEDBACK, $param);

        if($newID && $otherUserID){
            //Update TradeUser Table for rating calculation
            $this->_updateRanking($otherUserID);
        }

        //Create notification
        $tradeNotificationIns = new BuckysTradeNotification();
        $tradeNotificationIns->createNotification($otherUserID, $userID, BuckysTradeNotification::ACTION_TYPE_FEEDBACK, $newID);

        return $newID;
    }

    /**
     * Update feedback;
     *
     * @param integer $feedbackID
     * @param integer $userID
     * @param integer $score
     * @param string  $feedback
     * @return int|void
     */
    public function updateFeedback($feedbackID, $userID, $score, $feedback){

        global $db;

        if(!is_numeric($feedbackID) || !is_numeric($userID) || !is_numeric($score) || $feedback == ''
        )
            return;

        $feedbackData = $this->getFeedbackByID($feedbackID);
        $otherUserID = null;

        if(!$feedbackData)
            return;

        if($feedbackData['sellerID'] == $userID && $feedbackData['sellerToBuyerScore'] == 0){
            $param = ['sellerToBuyerScore' => $score, 'sellerToBuyerFeedback' => $feedback, 'sellerToBuyerFeedbackCreatedAt' => date('Y-m-d H:i:s')];
            $otherUserID = $feedbackData['buyerID'];
        }else if($feedbackData['buyerID'] == $userID && $feedbackData['buyerToSellerScore'] == 0){
            $param = ['buyerToSellerScore' => $score, 'buyerToSellerFeedback' => $feedback, 'buyerToSellerFeedbackCreatedAt' => date('Y-m-d H:i:s')];
            $otherUserID = $feedbackData['sellerID'];
        }else{
            return; //no rights
        }

        $res = $db->updateFromArray(TABLE_TRADE_FEEDBACK, $param, ['feedbackID' => $feedbackID]);

        if($otherUserID){
            //Update TradeUser Table for rating calculation
            $this->_updateRanking($otherUserID);

            //Create notification
            $tradeNotificationIns = new BuckysTradeNotification();
            $tradeNotificationIns->createNotification($otherUserID, $userID, BuckysTradeNotification::ACTION_TYPE_FEEDBACK, $feedbackID);
        }

        return $feedbackID;

    }

    /**
     * Get Feedback By ID
     *
     * @param mixed $tradeID
     * @return array|void
     */
    public function getFeedbackByID($feedbackID){

        global $db;

        if(!is_numeric($feedbackID))
            return;

        $query = sprintf('SELECT * FROM %s WHERE feedbackID=%d', TABLE_TRADE_FEEDBACK, $feedbackID);

        $data = $db->getRow($query);

        return $data;

    }

    /**
     * Get Feedback By ID
     *
     * @param mixed $tradeID
     * @return array|void
     */
    public function getFeedbackByTradeID($tradeID){

        global $db;

        if(!is_numeric($tradeID))
            return;

        $query = sprintf('SELECT * FROM %s WHERE tradeID=%d', TABLE_TRADE_FEEDBACK, $tradeID);

        $data = $db->getRow($query);

        return $data;

    }

    /**
     * Get feedback data by userID
     *
     * @param integer $userID
     * @param string  $type
     * @return array|Indexed
     */
    public function getFeedbackByUserID($userID, $type){

        global $db;

        if(!is_numeric($userID))
            return;

        $query = sprintf('
                    SELECT tFeedback.*, sItem.title AS sellerItemTitle, bItem.title AS buyerItemTitle, sUser.totalRating AS sellerTotalRating, sUser.positiveRating AS sellerPositiveRating, bUser.totalRating AS buyerTotalRating, bUser.positiveRating AS buyerPositiveRating 
                    FROM %s AS tFeedback 
                        LEFT JOIN %s AS trade ON trade.tradeID = tFeedback.tradeID 
                        LEFT JOIN %s AS sItem ON sItem.itemID=trade.sellerItemID 
                        LEFT JOIN %s AS bItem ON bItem.itemID=trade.buyerItemID 
                        LEFT JOIN %s AS sUser ON sUser.userID=trade.sellerID 
                        LEFT JOIN %s AS bUser ON bUser.userID=trade.buyerID 
                    WHERE tFeedback.sellerID=%d OR tFeedback.buyerID=%d ORDER BY tFeedback.feedbackID DESC
                ', TABLE_TRADE_FEEDBACK, TABLE_TRADE, TABLE_TRADE_ITEMS, TABLE_TRADE_ITEMS, TABLE_TRADE_USERS, TABLE_TRADE_USERS, $userID, $userID);

        $feedbackList = $db->getResultsArray($query);
        $newFeedbackList = [];

        if(count($feedbackList) > 0){

            switch($type){
                case 'received':

                    foreach($feedbackList as $feedbackData){
                        if($feedbackData['sellerID'] == $userID && $feedbackData['buyerToSellerScore'] != 0){
                            $newFeedbackList[] = $feedbackData;
                        }else if($feedbackData['buyerID'] == $userID && $feedbackData['sellerToBuyerScore'] != 0){
                            $newFeedbackList[] = $feedbackData;
                        }
                    }

                    break;
                case 'given':

                    foreach($feedbackList as $feedbackData){
                        if($feedbackData['sellerID'] == $userID && $feedbackData['sellerToBuyerScore'] != 0){
                            $newFeedbackList[] = $feedbackData;
                        }else if($feedbackData['buyerID'] == $userID && $feedbackData['buyerToSellerScore'] != 0){
                            $newFeedbackList[] = $feedbackData;
                        }
                    }

                    break;
                default:
                    $newFeedbackList = $feedbackList;
            }

        }

        return $newFeedbackList;

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
            $result = $query = sprintf('SELECT SUM(CASE WHEN sellerID=%d AND buyerToSellerScore > 0 THEN 1 WHEN buyerID=%d AND sellerToBuyerScore > 0 THEN 1 END) AS ratingCount FROM %s', $userID, $userID, TABLE_TRADE_FEEDBACK);
            $result = $db->getRow($query);
        }else{
            $query = sprintf('SELECT SUM(CASE WHEN sellerID=%d AND buyerToSellerScore!=0 THEN 1 WHEN buyerID=%d AND sellerToBuyerScore !=0 THEN 1 END) AS ratingCount FROM %s', $userID, $userID, TABLE_TRADE_FEEDBACK);
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

        if(!is_numeric($userID))
            return;

        $tradeUserIns = new BuckysTradeUser();
        $totalFeedback = $this->getReceivedFeedbackCount($userID, false);
        $positiveFeedback = $this->getReceivedFeedbackCount($userID, true);

        $tradeUserIns->updateTradeUser($userID, ['totalRating' => $totalFeedback, 'positiveRating' => $positiveFeedback]);
    }

}