<?php

/**
 * Trade management
 */
class BuckysTrade {

    const TRADE_TRADED = 1;

    /**
     * Add trade
     *
     * @param integer $sellerID
     * @param integer $buyerID
     * @param integer $sellerItemID
     * @param integer $buyerItemID
     * @return int
     */
    public function addTrade($sellerID, $buyerID, $sellerItemID, $buyerItemID){
        global $db;

        if(!is_numeric($sellerID) || !is_numeric($buyerID) || !is_numeric($sellerItemID) || !is_numeric($buyerItemID)
        )
            return; // failed

        //Check if this trade has been made before.
        $query = sprintf('SELECT * FROM %s WHERE sellerID=%d AND buyerID=%d AND sellerItemID=%d AND buyerItemID=%d', TABLE_TRADE, $sellerID, $buyerID, $sellerItemID, $buyerItemID);
        $query = $db->prepare($query);
        $data = $db->getRow($query);

        if(!empty($data)){
            return $data['tradeID']; // already exists
        }

        //Add new trade record
        // 1. create shipping address
        $tradeShippingInfo = new BuckysTradeShippingInfo();
        $shippingInfo['seller'] = $tradeShippingInfo->addTradeShippingInfo($sellerID);
        $shippingInfo['buyer'] = $tradeShippingInfo->addTradeShippingInfo($buyerID);

        // 2. create trade record

        $dateTimeStamp = date('Y-m-d H:i:s');

        $param = ['sellerID' => $sellerID, 'buyerID' => $buyerID, 'sellerItemID' => $sellerItemID, 'buyerItemID' => $buyerItemID, 'sellerShippingID' => $shippingInfo['seller'], 'buyerShippingID' => $shippingInfo['buyer'], 'createdDate' => $dateTimeStamp];

        $newID = $db->insertFromArray(TABLE_TRADE, $param);

        return $newID;
    }

    /**
     * It will return shipping Info Required Trade records.
     *
     * @param integer $userID
     * @param string  $type : seller / buyer
     * @return Indexed|void
     */
    public function getShippingInfoRequiredTrade($userID, $type = 'seller'){

        if(!is_numeric($userID)){
            return;
        }

        global $db;

        switch($type){
            case 'seller' :

                $query = sprintf('SELECT * FROM %s WHERE sellerID=%d AND sellerShippingID=%d', TABLE_TRADE, $userID, 0);
                $result = $db->getResultsArray($query);
                return $result;

                break;
            case 'buyer' :

                $query = sprintf('SELECT * FROM %s WHERE buyerID=%d AND buyerShippingID=%d', TABLE_TRADE, $userID, 0);
                $result = $db->getResultsArray($query);
                return $result;

                break;
        }

        return;
    }

    /**
     * Update Trade Info
     *
     * @param integer $tradeID
     * @param array   $data
     * @return bool|void
     */
    public function updateTrade($tradeID, $data){

        global $db;

        if(!is_numeric($tradeID))
            return false;

        $res = $db->updateFromArray(TABLE_TRADE, $data, ['tradeID' => $tradeID]);

        return;

    }

    /**
     * Get trades completed by this user
     *
     * @param integer $userID
     * @param string  $type : one of the following 'history', 'completed'
     * @return Indexed
     */
    public function getTradesByUserID($userID, $type = 'completed'){

        global $db;

        if(!is_numeric($userID))
            return;

        $query = sprintf('
                    SELECT t.tradeID, t.sellerID, t.buyerID, t.sellerItemID, t.buyerItemID, t.sellerTrackingNo, t.buyerTrackingNo, t.createdDate AS tradeCreatedDate, 
                        sItem.title AS sellerItemTitle, sItem.subtitle AS sellerItemSubtitle, sItem.images AS sellerItemImages, 
                        bItem.title AS buyerItemTitle, bItem.subtitle AS buyerItemSubtitle, bItem.images AS buyerItemImages, 
                        CONCAT(sUserDetail.firstname, " ", sUserDetail.lastName) AS sellerShFullName, sShipInfo.address AS sellerShAddress, sShipInfo.address2 AS sellerShAddress2, sShipInfo.city AS sellerShCity, sShipInfo.state AS sellerShState, sShipInfo.zip AS sellerShZip, sShipInfo.countryID AS sellerShCountryID,
                        CONCAT(bUserDetail.firstname, " ", bUserDetail.lastName) AS buyerShFullName, bShipInfo.address AS buyerShAddress, bShipInfo.address2 AS buyerShAddress2, bShipInfo.city AS buyerShCity, bShipInfo.state AS buyerShState, bShipInfo.zip AS buyerShZip, bShipInfo.countryID AS buyerShCountryID,
                        sUser.totalRating AS sellerTotalRating, sUser.positiveRating AS sellerPositiveRating,
                        bUser.totalRating AS buyerTotalRating, bUser.positiveRating AS buyerPositiveRating
                    FROM %s AS t 
                        LEFT JOIN %s AS sItem ON sItem.itemID = t.sellerItemID 
                        LEFT JOIN %s AS bItem ON bItem.itemID = t.buyerItemID 
                        LEFT JOIN %s AS sShipInfo ON sShipInfo.shippingID = t.sellerShippingID 
                        LEFT JOIN %s AS bShipInfo ON bShipInfo.shippingID = t.buyerShippingID 
                        LEFT JOIN %s AS sUser ON sUser.userID = t.sellerID 
                        LEFT JOIN %s AS bUser ON bUser.userID = t.buyerID                         
                        LEFT JOIN %s AS sUserDetail ON sUserDetail.userID = t.sellerID 
                        LEFT JOIN %s AS bUserDetail ON bUserDetail.userID = t.buyerID                         
            ', TABLE_TRADE, TABLE_TRADE_ITEMS, TABLE_TRADE_ITEMS, TABLE_TRADE_SHIPPING_INFO, TABLE_TRADE_SHIPPING_INFO, TABLE_USERS_RATING, TABLE_USERS_RATING, TABLE_USERS, TABLE_USERS);

        switch($type){
            case 'history':
                $query = $db->prepare($query . ' WHERE (t.sellerID=%d OR t.buyerID=%d) AND t.status=%d', $userID, $userID, BuckysTrade::TRADE_TRADED);
                break;
            default:

                $query = sprintf($query . ' WHERE (t.sellerID=%d OR t.buyerID=%d) AND t.status=%d AND t.tradeID NOT IN (SELECT tFeedback.activityID FROM %s AS tFeedback WHERE tFeedback.activityType=%d AND tFeedback.writerID=%d)', $userID, $userID, BuckysTrade::TRADE_TRADED, TABLE_FEEDBACK, BuckysFeedback::ACTIVITY_TYPE_TRADE, $userID, $userID);

                $query = $db->prepare($query);
                break;
        }

        //Order by Trade ID
        $query .= " ORDER BY t.createdDate DESC";

        $tradeList = $db->getResultsArray($query);

        if($tradeList){
            //We have to add feedback info to display them

            $tradeIDList = [];
            foreach($tradeList as $data){
                $tradeIDList[] = $data['tradeID'];
            }

            $feedbackIns = new BuckysFeedback();

            foreach($tradeList as &$tradeData){

                $feedbackData = $feedbackIns->getTradeFeedback($tradeData['tradeID']);
                if($feedbackData){
                    foreach($feedbackData as $fData){
                        if($fData['writerID'] == $tradeData['sellerID']){
                            $tradeData['buyerFeedbackScore'] = $fData['score'];
                        }else{
                            $tradeData['sellerFeedbackScore'] = $fData['score'];
                        }
                    }
                }

            }

        }

        return $tradeList;

    }

    /**
     * Get Trade Info
     *
     * @param mixed $tradeID
     * @return array|void
     */
    public function getTradeByID($tradeID){

        global $db;

        if(!is_numeric($tradeID))
            return;

        $query = sprintf('SELECT * FROM %s WHERE tradeID=%d', TABLE_TRADE, $tradeID);

        $data = $db->getRow($query);

        return $data;

    }

}