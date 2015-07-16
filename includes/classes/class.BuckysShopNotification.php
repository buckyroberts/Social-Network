<?php

/**
 * Shop Notification
 */
class BuckysShopNotification {

    const ACTION_TYPE_PRODUCT_SOLD = 'sold';

    var $objectType = 'shop';
    var $objectID = 0;

    /**
     * It will create Notification on Activities table
     *
     * @param integer $userID
     * @param integer $senderID   (the man who creates this alert)
     * @param string  $actionType : one of action types (const defined for this class)
     * @param integer $actionID   : related shop order ID
     */
    function createNotification($userID, $senderID, $actionType, $actionID){

        //Check if this user will get this notification. (it will be set by Notification setting page)
        $userIns = new BuckysTradeUser();
        $userData = $userIns->getUserByID($userID);

        $flagEnabled = 0; // user checked that he didn't want to have this notification

        switch($actionType){
            case BuckysActivity::ACTION_TYPE_PRODUCT_SOLD:
                $flagEnabled = $userData['optProductSoldOnShop'];
                break;
        }

        if($flagEnabled == 1){
            //Create Notification.
            $activityIns = new BuckysActivity();
            $activityId = $activityIns->addActivity($userID, $senderID, $this->objectType, $actionType, $actionID);

            $activityIns->addNotification($userID, $activityId, BuckysActivity::NOTIFICATION_TYPE_PRODUCT_SOLD);
        }

    }

    /**
     * get Number of new notification
     *
     * @param mixed $userID
     * @param       string type
     * @return one
     */
    function getNumOfNewMessages($userID, $type = null, $isNew = 1){

        global $db;

        if($type == null)
            $query = $db->prepare("SELECT count(*) FROM " . TABLE_MAIN_ACTIVITIES . " WHERE userID=%d AND isNew=%d AND objectType=%s", $userID, $isNew, $this->objectType);else
            $query = $db->prepare("SELECT count(*) FROM " . TABLE_MAIN_ACTIVITIES . " WHERE userID=%d AND isNew=%d AND activityType=%s AND objectType=%s", $userID, $isNew, $type, $this->objectType);

        $num = $db->getVar($query);

        return $num;
    }

    /**
     * get all notification which this user has received.
     *
     * @param mixed $userID
     * @param mixed $limit
     * @return array
     */
    function getReceivedMessages($userID, $type = null, $isNew = 1, $limit = 5){

        global $db;

        $whereCond = '';
        if($type == null)
            $whereCond = sprintf(" WHERE act.userID=%d AND act.isNew=%d AND act.objectType='%s' ORDER BY act.createdDate DESC ", $userID, $isNew, $this->objectType);else
            $whereCond = sprintf(" WHERE act.userID=%d AND act.isNew=%d AND act.activityType='%s' AND act.objectType='%s' ORDER BY act.createdDate DESC ", $userID, $isNew, $type, $this->objectType);

        if(is_numeric($limit) && $limit > 0){
            $whereCond .= ' LIMIT ' . $limit;
        }

        $query = sprintf("
                SELECT act.objectID AS senderID, act.activityType, act.createdDate, act.actionID, user.firstName, user.lastName   
                    FROM %s AS act 
                    LEFT JOIN %s AS USER ON USER.userID = act.objectID
                %s 
            ", TABLE_MAIN_ACTIVITIES, TABLE_USERS, $whereCond);

        $messageList = $db->getResultsArray($query);
        $newMessageList = [];

        if(count($messageList) > 0){
            foreach($messageList as $msgData){
                $data = [];
                $data['senderID'] = $msgData['senderID'];
                $data['senderName'] = trim($msgData['firstName'] . " " . $msgData['lastName']);
                $data['activityType'] = $msgData['activityType'];
                $data['createdDate'] = $msgData['createdDate'];
                $data['actionID'] = $msgData['actionID'];

                $newMessageList[] = $data;
            }
        }

        return $newMessageList;

    }

    /**
     * Mark message as read
     *
     * @param integer $userID
     * @param string  $actionType one of value of this action type (offer_received, offer_accepted,offer_declined,feedback)
     */
    function markAsRead($userID, $actionType = null){

        global $db;

        if(!is_numeric($userID))
            return;

        if($actionType != null){
            $query = sprintf("UPDATE %s SET isNew=0 WHERE userID=%d AND objectType='%s' AND activityType='%s'", TABLE_MAIN_ACTIVITIES, $userID, $this->objectType, $actionType);
        }else{
            $query = sprintf("UPDATE %s SET isNew=0 WHERE userID=%d AND objectType='%s'", TABLE_MAIN_ACTIVITIES, $userID, $this->objectType);
        }

        $db->query($query);

        return;

    }

}
