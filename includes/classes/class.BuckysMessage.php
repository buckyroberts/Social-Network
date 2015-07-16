<?php

/***
 * Manage Message Class
 */
class BuckysMessage {

    public static $COUNT_PER_PAGE = 20;

    /**
     * Getting New Messages
     *
     * @param mixed $userID
     * @return one
     */
    public static function getNumOfNewMessages($userID){
        global $db;

        $query = $db->prepare("SELECT count(*) FROM " . TABLE_MESSAGES . " WHERE receiver=%s AND STATUS='unread' AND is_trash=0", $userID);
        $num = $db->getVar($query);
        return $num;
    }

    /**
     * Create New Message
     *
     * @param mixed $data
     * @return bool
     */
    public static function composeMessage($data){
        global $db;

        if(!buckys_check_form_token()){
            buckys_add_message(MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
            return false;
        }

        $receivers = $data['to'];
        if(!buckys_not_null($receivers)){
            buckys_add_message(MSG_SENDER_EMPTY_ERROR, MSG_TYPE_ERROR);
            return false;
        }

        if(trim($data['subject']) == ''){
            buckys_add_message(MSG_MESSAGE_SUBJECT_EMPTY_ERROR, MSG_TYPE_ERROR);
            return false;
        }

        if(trim($data['body']) == ''){
            buckys_add_message(MSG_MESSAGE_BODY_EMPTY_ERROR, MSG_TYPE_ERROR);
            return false;
        }

        $createdDate = date("Y-m-d H:i:s");

        if(!is_array($receivers))
            $receivers = [$receivers];

        //Remove Duplicated Messages
        $receivers = array_unique($receivers);

        $nonFriend = [];
        $sents = [];
        $errors = [];
        $isError = false;

        foreach($receivers as $receiver){

            //Create A message row for Sender
            $sender = $data['userID'];

            $receiverInfo = BuckysUser::getUserBasicInfo($receiver);

            //confirm that current user and receiver is friend
            /*if(!BuckysFriend::isFriend($receiver, $sender))
            {                                
                $nonFriend[] = $receiverInfo['firstName'] . " " . $receiverInfo['lastName'];
                $isError = true;
                continue;
            }*/

            $insertData = ['userID' => $sender, 'sender' => $sender, 'receiver' => $receiver, 'subject' => $data['subject'], 'body' => $data['body'], 'status' => 'read', 'created_date' => $createdDate];
            $newId1 = $db->insertFromArray(TABLE_MESSAGES, $insertData);

            //Create A message row for receiver
            $sender = $data['userID'];
            $insertData = ['userID' => $receiver, 'sender' => $sender, 'receiver' => $receiver, 'subject' => $data['subject'], 'body' => $data['body'], 'status' => 'unread', 'created_date' => $createdDate];
            $newId2 = $db->insertFromArray(TABLE_MESSAGES, $insertData);

            $sents[] = $receiverInfo['firstName'] . ' ' . $receiverInfo['lastName'];

        }

        if(count($sents) > 0)
            buckys_add_message(MSG_NEW_MESSAGE_SENT, MSG_TYPE_SUCCESS);
        if(count($nonFriend) > 0){
            if(count($nonFriend) > 1)
                $msg = sprintf(MSG_COMPOSE_MESSAGE_ERROR_TO_NON_FRIENDS, implode(", ", $nonFriend));else
                $msg = sprintf(MSG_COMPOSE_MESSAGE_ERROR_TO_NON_FRIEND, $nonFriend[0]);
            buckys_add_message($msg, MSG_TYPE_ERROR);
        }

        return !$isError;
    }

    /**
     * @param $data
     * @return bool
     */
    public function sendMessage($data){
        global $db;

        $createdDate = date("Y-m-d H:i:s");

        $nonFriend = [];

        $errors = [];
        $isError = false;

        $sender = $data['userID'];
        $receiver = $data['to'];

        $insertData = ['userID' => $sender, 'sender' => $sender, 'receiver' => $receiver, 'subject' => $data['subject'], 'body' => $data['body'], 'status' => 'read', 'created_date' => $createdDate];

        $newId1 = $db->insertFromArray(TABLE_MESSAGES, $insertData);

        //Create A message row for receiver
        $sender = $data['userID'];
        $insertData = ['userID' => $receiver, 'sender' => $sender, 'receiver' => $receiver, 'subject' => $data['subject'], 'body' => $data['body'], 'status' => 'unread', 'created_date' => $createdDate];
        $newId2 = $db->insertFromArray(TABLE_MESSAGES, $insertData);

        return true;
    }

    /**
     * Get Received Messages
     *
     * @param Int $userID
     * @param Int $page
     * @param     String 'all', 'read', 'unread'
     * @return Array
     */
    public static function getReceivedMessages($userID, $page = 1, $status = 'all'){
        global $db;

        $query = $db->prepare("SELECT m.*, CONCAT(u.firstName, ' ', u.lastName) AS senderName, u.thumbnail FROM " . TABLE_MESSAGES . " AS m LEFT JOIN " . TABLE_USERS . " AS u ON m.sender = u.userID WHERE m.userID=%s AND m.is_trash = 0 AND m.receiver=%s ", $userID, $userID);

        switch($status){
            case 'read':
                $query .= " AND m.status='read'";
                break;
            case 'unread':
                $query .= " AND m.status='unread'";
                break;
        }

        $query .= " ORDER BY created_date desc ";
        //Append Pagination Query
        $query .= " LIMIT " . ($page - 1) * BuckysMessage::$COUNT_PER_PAGE . ", " . BuckysMessage::$COUNT_PER_PAGE;

        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * Get Sent Messages
     *
     * @param Int $userID
     * @return Array
     */
    public static function getSentMessages($userID, $page = 1){
        global $db;

        $query = $db->prepare("SELECT m.*, CONCAT(u.firstName, ' ', u.lastName) AS receiverName FROM " . TABLE_MESSAGES . " AS m LEFT JOIN " . TABLE_USERS . " AS u ON m.receiver = u.userID WHERE m.userID=%s AND m.is_trash=0 AND m.sender=%s ORDER BY created_date DESC", $userID, $userID);

        //Append Pagination Query
        $query .= " LIMIT " . ($page - 1) * BuckysMessage::$COUNT_PER_PAGE . ", " . BuckysMessage::$COUNT_PER_PAGE;
        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * Getting Total Messages
     *
     * @param Int    $userID
     * @param String $boxType : inbox, sent, trash
     * @return one
     */
    public static function getTotalNumOfMessages($userID, $boxType = 'inbox'){
        global $db;

        $query = $db->prepare("SELECT count(messageID) FROM " . TABLE_MESSAGES . " WHERE userID=%d ", $userID);
        if($boxType == 'inbox')
            $query .= $db->prepare(" AND is_trash=0 AND receiver=%d", $userID);else if($boxType == 'sent')
            $query .= $db->prepare(" AND is_trash=0 AND sender=%d", $userID);else if($boxType == 'trash')
            $query .= " AND is_trash=1";

        $count = $db->getVar($query);

        return $count;
    }

    /**
     * Get Trash Messages
     *
     * @param Int $userID
     * @return Array
     */
    public static function getDeletedMessages($userID, $page = 1){
        global $db;

        $query = $db->prepare("SELECT m.*, CONCAT(u.firstName, ' ', u.lastName) AS userName FROM " . TABLE_MESSAGES . " AS m LEFT JOIN " . TABLE_USERS . " AS u ON ((m.receiver = u.userID AND m.receiver != %d) OR (m.sender = u.userID AND m.sender != %d)) WHERE m.userID=%d AND m.is_trash=1 GROUP BY m.messageID ORDER BY created_date DESC", $userID, $userID, $userID);

        //Append Pagination Query
        $query .= " LIMIT " . ($page - 1) * BuckysMessage::$COUNT_PER_PAGE . ", " . BuckysMessage::$COUNT_PER_PAGE;

        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * Remove Messages
     * Sent the removed flag to be 1
     *
     * @param messageId
     * @return bool
     */
    public function deleteMessage($id){
        global $db;

        $query = $db->prepare("UPDATE " . TABLE_MESSAGES . " set is_trash=1 WHERE messageID=%s", $id);

        $db->query($query);

        return true;
    }

    /**
     * Remove Messages
     * Sent the removed flag to be 1
     *
     * @param mixed $ids
     * @return bool
     */
    public static function deleteMessages($ids){
        global $db, $userID;

        if(!is_array($ids))
            $ids = [$ids];

        $ids = $db->escapeInput($ids);

        $query = $db->prepare("UPDATE " . TABLE_MESSAGES . " set is_trash=1 WHERE userID=%d AND messageID in (" . implode(', ', $ids) . ")", $userID);

        $db->query($query);

        return true;
    }

    /**
     * Remove Messages
     * Sent the removed flag to be 1
     *
     * @param mixed $ids
     * @return bool
     */
    public static function deleteMessagesForever($ids){
        global $db, $userID;

        if(!is_array($ids))
            $ids = [$ids];

        $ids = $db->escapeInput($ids);

        $query = $db->prepare("DELETE FROM " . TABLE_MESSAGES . " WHERE userID=%d AND is_trash=1 AND messageID IN (" . implode(', ', $ids) . ")", $userID);

        $db->query($query);

        return true;
    }

    /**
     * Get Message Detail of current user
     *
     * @param Int $messageID
     * @return array
     */
    public static function getMessage($messageID){
        global $db, $userID;

        $query = $db->prepare("SELECT m.*, CONCAT(u.firstName, ' ', u.lastName) AS senderName, CONCAT(u1.firstName, ' ', u1.lastName) AS receiverName, r.reportID FROM " . TABLE_MESSAGES . " AS m " . "LEFT JOIN " . TABLE_USERS . " AS u ON m.sender = u.userID " . "LEFT JOIN " . TABLE_USERS . " AS u1 ON m.receiver = u1.userID " . "LEFT JOIN " . TABLE_REPORTS . " AS r ON r.objectType='message' AND r.objectID = m.messageID AND r.reporterID=%d " . "WHERE m.userID=%d AND m.messageID=%d ORDER BY created_date DESC", $userID, $userID, $messageID);

        $row = $db->getRow($query);

        return $row;
    }

    /**
     * Get Message Detail By Id
     *
     * @param mixed $messageID
     * @return stdClass
     */
    public static function getMessageById($messageID){
        global $db, $userID;

        $query = $db->prepare("SELECT m.*, CONCAT(u.firstName, ' ', u.lastName) AS senderName, CONCAT(u1.firstName, ' ', u1.lastName) AS receiverName, r.reportID FROM " . TABLE_MESSAGES . " AS m " . "LEFT JOIN " . TABLE_USERS . " AS u ON m.sender = u.userID " . "LEFT JOIN " . TABLE_USERS . " AS u1 ON m.receiver = u1.userID " . "LEFT JOIN " . TABLE_REPORTS . " AS r ON r.objectType='message' AND r.objectID = m.messageID " . "WHERE m.messageID=%d ORDER BY created_date DESC", $messageID);

        $row = $db->getRow($query);

        return $row;
    }

    /**
     * Change Message Status : read or unread
     */
    public function changeMessageStatus($messageID, $status = 'read'){
        global $db, $userID;

        $query = $db->prepare('UPDATE ' . TABLE_MESSAGES . ' SET status=%s WHERE messageID=%s', $status, $messageID);
        $db->query($query);

        return $row;
    }

    /**
     * Getting Next Record
     *
     * @param Int    $userID
     * @param Int    $messageID
     * @param String $type
     * @return Int
     */
    public function getNextID($userID, $messageID, $type){
        global $db;

        if($type == 'inbox'){
            $query = $db->prepare("SELECT m.messageID FROM " . TABLE_MESSAGES . " AS m WHERE m.messageID < %s AND m.userID=%s AND m.is_trash = 0 AND m.receiver=%s ORDER BY created_date DESC LIMIT 1", $messageID, $userID, $userID);
        }else if($type == 'sent'){
            $query = $db->prepare("SELECT m.messageID FROM " . TABLE_MESSAGES . " AS m WHERE m.messageID < %s AND m.userID=%s AND m.is_trash=0 AND m.sender=%s ORDER BY created_date DESC LIMIT 1", $messageID, $userID, $userID);
        }else if($type == 'trash'){
            $query = $db->prepare("SELECT m.messageID FROM " . TABLE_MESSAGES . " AS m WHERE m.messageID < %s AND m.userID=%s AND m.is_trash=1 GROUP BY m.messageID ORDER BY created_date DESC LIMIT 1", $messageID, $userID, $userID);
        }
        $id = $db->getVar($query);

        return $id;
    }

    /**
     * Getting Prev Record
     *
     * @param Int    $userID
     * @param Int    $messageID
     * @param String $type
     * @return Int
     */
    public function getPrevID($userID, $messageID, $type){
        global $db;

        if($type == 'inbox'){
            $query = $db->prepare("SELECT m.messageID FROM " . TABLE_MESSAGES . " AS m WHERE m.messageID > %s AND m.userID=%s AND m.is_trash = 0 AND m.receiver=%s ORDER BY created_date ASC LIMIT 1", $messageID, $userID, $userID);
        }else if($type == 'sent'){
            $query = $db->prepare("SELECT m.messageID FROM " . TABLE_MESSAGES . " AS m WHERE m.messageID > %s AND m.userID=%s AND m.is_trash=0 AND m.sender=%s ORDER BY created_date ASC LIMIT 1", $messageID, $userID, $userID);
        }else if($type == 'trash'){
            $query = $db->prepare("SELECT m.messageID FROM " . TABLE_MESSAGES . " AS m WHERE m.messageID > %s AND m.userID=%s AND m.is_trash=1 GROUP BY m.messageID ORDER BY created_date ASC LIMIT 1", $messageID, $userID, $userID);
        }

        $id = $db->getVar($query);

        return $id;
    }
}

