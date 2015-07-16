<?php
/**
 * Private Messenger Buddy List Class
 */
if(!defined('TNB_APP'))
    exit(MSG_INVALID_REQUEST);

class BuckysPrivateMessenger {

    private static $settings = null;

    /**
     * Getting Buddies List
     *
     * @param Int $userID
     * @return Array
     */
    public static function getUserList($userID){
        global $db;

        $userID = intval($userID);
        $settings = BuckysUser::getUserBasicInfo($userID);
        $expiry = time() + SESSION_LIFETIME - 6;
        if($settings['messenger_privacy'] == 'all'){
            $query = $db->prepare("SELECT blockedID FROM " . TABLE_MESSENGER_BLOCKLIST . " WHERE userID=%d", $userID);
            $blocks = $db->getResultsArray($query, 'blockedID');
            if(buckys_not_null($blocks))
                $blocks = array_keys($blocks);else
                $blocks = [];

            $query = $db->prepare("SELECT userID FROM " . TABLE_MESSENGER_BLOCKLIST . " WHERE blockedID=%d", $userID);
            $blocks1 = $db->getResultsArray($query, 'userID');
            if(buckys_not_null($blocks1))
                $blocks1 = array_keys($blocks1);else
                $blocks1 = [];

            $blocks = array_unique(array_merge($blocks, $blocks1, [$userID]));

            //Buddys
            $query = $db->prepare("SELECT userID FROM " . TABLE_MESSENGER_BUDDYLIST . " WHERE buddyID=%d", $userID);
            $buddys = $db->getResultsArray($query, 'userID');
            if(buckys_not_null($buddys))
                $buddys = array_keys($buddys);else
                $buddys = [];
            $buddys[] = 0;

            //Get All users except the people on the blocklist
            $query = $db->prepare("SELECT CONCAT(u.firstName, ' ', u.lastName) AS name, u.userID, s.sessionID, u.thumbnail, 1 AS online, 1 AS buddyStatus FROM " . TABLE_SESSIONS . " AS s " . " LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=s.userID " . " WHERE s.expiry > %s AND u.status = 1 AND u.userID NOT IN (" . implode(', ', $blocks) . ") AND (u.messenger_privacy = 'all' OR u.userID IN (" . implode(', ', $buddys) . "))" . " ORDER BY NAME ", $expiry);

            $rows = $db->getResultsArray($query);

        }else{ //Only users from the buddy list
            $query = $db->prepare("SELECT CONCAT(u.firstName, ' ', u.lastName) AS name, u.userID, s.sessionID, u.thumbnail,IF(s.sessionID IS NULL, 0, 1) AS online, b.status AS buddyStatus, u.messenger_privacy FROM " . TABLE_MESSENGER_BUDDYLIST . " AS b " . " LEFT JOIN " . TABLE_SESSIONS . " AS s ON s.expiry > %s AND s.userID=b.buddyID " . " LEFT JOIN " . TABLE_USERS . " AS u ON b.buddyID=u.userID " . " WHERE b.userID=%d AND u.status = 1 ORDER BY online DESC, NAME ", $expiry, $userID, $userID);
            $rows = $db->getResultsArray($query);
        }

        return $rows;
    }

    /**
     * Get Userlist HTML
     *
     * @param Int $userID
     * @return String
     */
    public static function getUserListHTML($userID, &$uIDs = []){
        $users = BuckysPrivateMessenger::getUserList($userID);

        $html = '';

        foreach($users as $row){
            $newMsg = BuckysPrivateMessenger::getNewMessageCount($userID, $row['userID']);
            $html .= '<a href="#" class="single_chat_user ' . (!$row['online'] || !$row['buddyStatus'] ? "single_chat_user_offline" : '') . '" data-id="' . $row['userID'] . '" data-hash="' . buckys_encrypt_id($row['userID']) . '"> <img src="' . BuckysUser::getProfileIcon($row) . '" /><span> ' . $row['name'] . '</span></a>';
            $uIDs[] = $row['userID'];
        }

        return $html;
    }

    /**
     * Update User Messenger Settings
     *
     * @param int $userID
     * @param     $data
     * @internal param array $new
     */
    public static function updateMessenerSettings($userID, $data){
        global $db;

        BuckysUser::updateUserFields($userID, ['messenger_privacy' => $_POST['messenger_privacy'] == 'all' ? 'all' : 'buddy']);

        //Update Buddylist Status
        if($data['messenger_privacy'] == 'all'){
            //Change buddy list relationship to 1(Online)
            $query = $db->prepare("UPDATE " . TABLE_MESSENGER_BUDDYLIST . " SET `status` = 1 WHERE buddyID=%d", $userID);
            $db->query($query);
        }else if($data['messenger_privacy'] == 'buddy'){
            //Reset buddylist relationship
            $query = $db->prepare("UPDATE " . TABLE_MESSENGER_BUDDYLIST . " SET `status` = 0 WHERE buddyID=%d", $userID);
            $db->query($query);
            //only set the status=1 for them on the user buddylist
            $buddys = $db->getResultsArray($db->prepare("SELECT messengerBuddylistID FROM " . TABLE_MESSENGER_BUDDYLIST . " WHERE userID=%d", $userID));
            $buddys = array_chunk($buddys, 100); //Process 100 ids at a once
            foreach($buddys as $ids){
                if(buckys_not_null($ids))
                    $db->query("UPDATE " . TABLE_MESSENGER_BUDDYLIST . " SET `status` = 1 WHERE messengerBuddylistID in (" . implode(", ", $ids) . ")");
            }
        }

    }

    /**
     * Get New Message Count
     *
     * @param Int  $userID
     * @param null $buddyID
     * @return Int
     */
    public static function getNewMessageCount($userID, $buddyID = null){
        global $db;

        $query = $db->prepare("SELECT count(1) FROM " . TABLE_MESSENGER_MESSAGES . " WHERE userID=%d AND isNew = 1 ", $userID);
        if($buddyID == null){
            $buddyID = [];
            $users = BuckysPrivateMessenger::getUserList($userID);
            foreach($users as $row){
                $buddyID[] = $row['userID'];
            }
            $buddyID[] = 0;
        }

        if($buddyID != null){
            if(is_array($buddyID))
                $query .= " AND buddyID IN (" . implode(",", $buddyID) . ")";else
                $query .= $db->prepare(" AND buddyID=%d", $buddyID);
        }

        $count = $db->getVar($query);

        return $count;
    }

    /**
     * Get Block List
     *
     * @param Int $userID
     * @return Array
     */
    public static function getBlockLists($userID){
        global $db;

        $query = $db->prepare("SELECT CONCAT(u.firstName, ' ', u.lastName) AS `name`, u.userID, u.thumbnail FROM " . TABLE_MESSENGER_BLOCKLIST . " AS b " . " LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=b.blockedID WHERE b.userID=%d ORDER BY `name`", $userID);
        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * Search Users for blocking
     *
     * @param Int $userID
     * @param Int $term
     * @return Array
     */
    public static function searchNonBlockedUsers($userID, $term){
        global $db;

        $query = "SELECT distinct(u.userID), CONCAT(u.firstName, ' ', u.lastName) as fullName FROM " . TABLE_USERS . " as u LEFT JOIN " . TABLE_MESSENGER_BLOCKLIST . " as b ON b.blockedID = u.userID AND b.userID=$userID WHERE u.userID != $userID AND b.messengerBlocklistID IS NULL AND u.status = 1 AND (CONCAT(u.firstName, ' ', u.lastName) LIKE '%" . $db->escapeInput($term) . "%') ORDER BY fullName";

        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * Add the user to block list
     *
     * @param Int $userID = Blocker ID
     * @param Int $blockedID
     * @return String or Array
     */
    public static function blockUser($userID, $blockedID){
        global $db;

        $query = $db->prepare("SELECT messengerBlocklistID FROM " . TABLE_MESSENGER_BLOCKLIST . " WHERE userID=%d AND blockedID=%d", $userID, $blockedID);
        $mbID = $db->getVar($query);
        if(buckys_not_null($mbID)){
            return MSG_USER_ALREADY_BLOCKED;
        }

        //Check blockedID
        $query = $db->prepare("SELECT userID, firstName, lastName, thumbnail FROM " . TABLE_USERS . " WHERE userID=%d", $blockedID);
        $bUserInfo = $db->getRow($query);
        if(!buckys_not_null($bUserInfo)){
            return MSG_INVALID_REQUEST;
        }

        //Block User
        if(!$db->insertFromArray(TABLE_MESSENGER_BLOCKLIST, ['userID' => $userID, 'blockedID' => $blockedID, 'blockedDate' => date('Y-m-d H:i:s')])){
            return $db->getLastError();
        }else{
            //Remove From the buddy list if it was on.
            $db->query($db->prepare("DELETE FROM " . TABLE_MESSENGER_BUDDYLIST . " WHERE userID=%d AND buddyID=%d", $userID, $blockedID));
            //Update Buddylist status
            $db->query($db->prepare("UPDATE " . TABLE_MESSENGER_BUDDYLIST . " SET `status`=0 WHERE userID=%d AND buddyID=%d", $blockedID, $userID));
            //Remove From the Conversation List
            BuckysPrivateMessenger::closeConversationBox($blockedID);
            return $bUserInfo;
        }
    }

    /**
     * Remove the user from buddylist
     *
     * @param Int $userID = Blocker ID
     * @param     $buddyID
     * @return String or Array
     * @internal param Int $blockedID
     */
    public static function removeUserFromBuddylist($userID, $buddyID){
        global $db;

        $query = $db->prepare("SELECT messengerBuddylistID FROM " . TABLE_MESSENGER_BUDDYLIST . " WHERE userID=%d AND buddyID=%d", $userID, $buddyID);
        $mbID = $db->getVar($query);
        if(!buckys_not_null($mbID)){
            return MSG_INVALID_REQUEST;
        }

        //Check buddyID
        if(!BuckysUser::checkUserID($buddyID)){
            return MSG_INVALID_REQUEST;
        }

        //Remove User from the buddylist

        if(!$db->query($db->prepare("DELETE FROM " . TABLE_MESSENGER_BUDDYLIST . " WHERE userID=%d AND buddyID=%d", $userID, $buddyID))){
            return $db->getLastError();
        }else{
            //Update Buddylist status
            $db->query($db->prepare("UPDATE " . TABLE_MESSENGER_BUDDYLIST . " SET `status`=0 WHERE userID=%d AND buddyID=%d", $buddyID, $userID));

            //Remove From the Conversation List
            BuckysPrivateMessenger::closeConversationBox($buddyID);
            return true;
        }
    }

    /**
     * Unblock User
     *
     * @param Int $userID
     * @param int $blockedID
     * @return bool
     */
    public static function unblockUser($userID, $blockedID){
        global $db;

        if(!is_array($blockedID))
            $blockedID = [$blockedID];

        foreach($blockedID as $bid){
            $query = $db->prepare("DELETE FROM " . TABLE_MESSENGER_BLOCKLIST . " WHERE userID=%d AND blockedID=%d", $userID, $bid);
            $db->query($query);
        }

        return true;
    }

    /**
     * Open new conversation box and add the user id to the conversation list
     *
     * @param Int $userID
     * @param Int $cUserID
     * @return Array
     */
    public static function openConversationBox($userID, $cUserID){
        global $db;

        $convList = isset($_SESSION['converation_list']) ? $_SESSION['converation_list'] : [];

        $userInfo = BuckysUser::getUserBasicInfo($userID);
        $userInfo1 = BuckysUser::getUserBasicInfo($cUserID);

        //Check $cUserID is online or not
        $query = $db->prepare("SELECT u.messenger_privacy, s.sessionID FROM " . TABLE_USERS . " AS u LEFT JOIN " . TABLE_SESSIONS . " AS s ON u.userID=s.userID WHERE u.userID=%d AND s.expiry > %s AND u.status=1", $cUserID, time());

        $row = $db->getRow($query);
        if(!$row)
            return "offline";

        if(BuckysPrivateMessenger::isOnBlocklist($userID, $cUserID) || BuckysPrivateMessenger::isOnBlocklist($cUserID, $userID))
            return "blocked";

        if($userInfo['messenger_privacy'] == 'buddy' && !BuckysPrivateMessenger::isOnBuddylist($userID, $cUserID))
            return "not_improved";

        if($userInfo1['messenger_privacy'] == 'buddy' && !BuckysPrivateMessenger::isOnBuddylist($cUserID, $userID))
            return "not_improved";

        //Valid cUserID
        $query = $db->prepare("SELECT userID, firstName, lastName, thumbnail FROM " . TABLE_USERS . " WHERE userID=%d AND STATUS=1", $cUserID);
        $cUserInfo = $db->getRow($query);

        if(!buckys_not_null($cUserInfo)){
            return MSG_INVALID_REQUEST;
        }

        //Check whether the conversation has already opened or not
        if(in_array($cUserID, $convList)){
            return true;
        }else{
            $convList[] = $cUserID;
            $_SESSION['converation_list'] = $convList;
            return $cUserInfo;
        }
    }

    /**
     * Close Conversation Box
     *
     * @param Int $userID , if $userID == null, close all conversation
     * @return bool
     */
    public static function closeConversationBox($userID = null){
        if(buckys_not_null($userID)){
            //Remove the current user id from the session        
            $convList = isset($_SESSION['converation_list']) ? $_SESSION['converation_list'] : [];

            if(in_array($userID, $convList)){
                $newList = [];
                foreach($convList as $id){
                    if($userID != $id)
                        $newList[] = $id;
                }
                $convList = $newList;
                $_SESSION['converation_list'] = $convList;
            }
        }else{
            $_SESSION['converation_list'] = [];
        }
        return true;
    }

    /**
     * Save Message
     *
     * @param Int    $userID
     * @param Int    $receiverID
     * @param String $message
     * @return bool|null|string
     */
    public static function saveMessage($userID, $receiverID, $message){
        global $db;

        $now = date('Y-m-d H:i:s');

        //Check if the user can send message or not
        $userInfo = BuckysUser::getUserBasicInfo($userID);
        $receiverInfo = BuckysUser::getUserBasicInfo($receiverID);

        //Check $cUserID is online or not
        $query = $db->prepare("SELECT u.messenger_privacy, s.sessionID FROM " . TABLE_USERS . " AS u LEFT JOIN " . TABLE_SESSIONS . " AS s ON u.userID=s.userID WHERE u.userID=%d AND s.expiry > %s AND u.status=1", $receiverID, time());

        $row = $db->getRow($query);
        if(!$row)
            return "offline";

        if(BuckysPrivateMessenger::isOnBlocklist($userID, $receiverID) || BuckysPrivateMessenger::isOnBlocklist($receiverID, $userID))
            return "blocked";

        if($userInfo['messenger_privacy'] == 'buddy' && !BuckysPrivateMessenger::isOnBuddylist($userID, $receiverID))
            return "not_improved";

        if($receiverInfo['messenger_privacy'] == 'buddy' && !BuckysPrivateMessenger::isOnBuddylist($receiverID, $userID))
            return "not_improved";

        //Create New Message
        $newID = $db->insertFromArray(TABLE_MESSENGER_MESSAGES, ['userID' => $userID, 'buddyID' => $receiverID, 'isNew' => 1, 'messageType' => 0, 'message' => $message, 'createdDate' => $now]);
        if(!$newID)
            return $db->getLastError();

        //Create New Message
        $newID1 = $db->insertFromArray(TABLE_MESSENGER_MESSAGES, ['userID' => $receiverID, 'buddyID' => $userID, 'isNew' => 1, 'messageType' => 1, 'message' => $message, 'createdDate' => $now]);
        if(!$newID1)
            return $db->getLastError();

        return true;
    }

    /**
     * Read Messages
     *
     * @param Int    $userID
     * @param        Int   or Array $buddyID
     * @param String $type : 'new', 'old', 'all'
     * @return Int or HTML
     */
    public static function getMessages($userID, $buddyID, $type = 'new'){
        global $db;

        $userID = $db->escapeInput($userID);
        $buddyID = $db->escapeInput($buddyID);

        $query = "SELECT m.*, CONCAT(u.firstName, ' ', u.lastName) AS fullName, u.userID, u.thumbnail FROM " . TABLE_MESSENGER_MESSAGES . " AS m " . " LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=m.buddyID " . " WHERE m.userID=" . $userID;
        if(!$buddyID)
            return [];

        if(is_array($buddyID))
            $query .= " AND m.buddyID IN (" . implode(",", $buddyID) . ") ";else
            $query .= " AND m.buddyID=" . $buddyID;

        switch($type){
            case 'new':
                $query .= " AND m.isNew=1 ";
                break;
            case 'old':
                $query .= " AND m.isNew=0 ";
                break;
        }

        $query .= " ORDER BY m.buddyID, m.messageID ASC ";

        $rows = $db->getResultsArray($query);

        if($type != 'old' && buckys_not_null($rows)){
            //Make the new messages as read
            $query = "UPDATE " . TABLE_MESSENGER_MESSAGES . " SET isNew=0 WHERE isNew=1 AND userID=" . $userID;
            if(is_array($buddyID))
                $query .= " AND buddyID IN (" . implode(",", $buddyID) . ") ";else
                $query .= " AND buddyID=" . $buddyID;
            $db->query($query);
        }

        return $rows;
    }

    /**
     * Get Messenger Messages HTMl
     *
     * @param Int    $userID
     * @param Int    $buddyID
     * @param String $type : 'new', 'old', 'all'
     * @return string
     */
    public static function getMessagesHTML($userID, $buddyID, $type = 'new'){
        global $db;

        $rows = BuckysPrivateMessenger::getMessages($userID, $buddyID, $type);

        $html = '';
        $userData = BuckysUser::getUserBasicInfo($userID);

        foreach($rows as $row){
            $html .= '<div class="single_private_message">
                        <img src="' . BuckysUser::getProfileIcon($row['messageType'] == 1 ? $row : $userData) . '" />
                        <div class="private_message_text"><span class="username">' . ($row['messageType'] == 1 ? $row['fullName'] : $userData['firstName'] . ' ' . $userData['lastName']) . '</span>' . $row['message'] . ' <span class="date">' . buckys_format_date($row['createdDate'], 'F j, Y h:i A') . '</span></div>
                      </div>';
        }

        return $html;
    }

    /**
     * Format Date by User Timezone
     *
     * @param Int $time
     * @param Int $userID : logged user id
     * @return bool|string
     */
    public function formatDate($time, $userID = null){
        global $TNB_GLOBALS;

        if($userID == null)
            $userID = buckys_is_logged_in();

        $userData = BuckysUser::getUserBasicInfo($userID);
        $timezone = $TNB_GLOBALS['timezone'][$userData['timezone']];

        $offset = $timezone * 60 * 60;

        $time = $time + $offset;

        $today = strtotime(date("Y-m-d")) + $offset;
        $yesterday = strtotime(date("Y-m-d")) - 60 * 60 * 24 + $offset;

        if($time >= $today){
            return date("h:i A", $time);
        }

        if($time >= $yesterday){
            return "Yesterday " . date("h:i A", $time);
        }

        return date('F j, Y h:i A', $time);
    }

    /**
     * Check if $userID blocked $blockedUserID
     *
     * @param Int $userID
     * @param Int $blockedUserID
     * @return Boolean
     */
    public function isOnBlocklist($userID, $blockedUserID){
        global $db;

        $query = $db->prepare("SELECT messengerBlocklistID FROM " . TABLE_MESSENGER_BLOCKLIST . " WHERE userID=%d AND blockedID=%d", $userID, $blockedUserID);
        $id = $db->getVar($query);

        return !$id ? false : $id;

    }

    /**
     * If the $buddyID is on the $userID buddies list, return true. otherwise return false.
     *
     * @param Int $userID
     * @param Int $buddyID
     * @return Boolean
     */
    public function isOnBuddylist($userID, $buddyID){
        global $db;

        $query = $db->prepare("SELECT messengerBuddylistID FROM " . TABLE_MESSENGER_BUDDYLIST . " WHERE userID=%d AND buddyID=%d", $userID, $buddyID);
        $id = $db->getVar($query);

        return !$id ? false : $id;
    }

    /**
     * Add user to buddylist
     *
     * @param Int $userID
     * @param Int $addedUserID
     * @return bool|null|string
     */
    public static function addUserToBuddylist($userID, $addedUserID){
        global $db;

        //If the user is on the blocklist of current user
        if(BuckysPrivateMessenger::isOnBlocklist($userID, $addedUserID)){
            return MSG_ADD_BLOCKED_USER_TO_BUDDYLIST_ERROR;
        }

        //If already added
        if(BuckysPrivateMessenger::isOnBuddylist($userID, $addedUserID)){
            return true;
        }

        $status = 0;
        //Getting Status
        $addedUserMsgrSettings = BuckysUser::getUserBasicInfo($addedUserID);
        if($addedUserMsgrSettings['messenger_privacy'] == 'all' && !BuckysPrivateMessenger::isOnBlocklist($addedUserID, $userID)){
            $status = 1;
        }else if($addedUserMsgrSettings['messenger_privacy'] == 'buddy' && !BuckysPrivateMessenger::isOnBuddylist($addedUserID, $userID)){
            $status = 1;
        }
        //Add user to the buddylist
        $query = $db->prepare("INSERT INTO " . TABLE_MESSENGER_BUDDYLIST . "(`userID`, `buddyID`, `status`)VALUES(%d, %d, 0)", $userID, $addedUserID);
        $nID = $db->insert($query);
        if(!$nID)
            return $db->getLastError();

        $bID = BuckysPrivateMessenger::isOnBuddylist($addedUserID, $userID);
        if($bID){
            //If $userID is already in the $addedUserID's buddylist,  update state
            $query = $db->prepare("UPDATE " . TABLE_MESSENGER_BUDDYLIST . " SET `status` = 1 WHERE messengerBuddylistID=%d", $nID);
            $db->update($query);
            $query = $db->prepare("UPDATE " . TABLE_MESSENGER_BUDDYLIST . " SET `status` = 1 WHERE messengerBuddylistID=%d", $bID);
            $db->update($query);
        }

        return true;
    }

    /**
     * Clear chat history
     *
     * @param Int $userID
     * @param Int $sID
     * @return bool
     */
    public static function clearHistory($userID, $sID){
        global $db;

        $query = $db->prepare("DELETE FROM " . TABLE_MESSENGER_MESSAGES . " WHERE userID=%d AND isNew=0 AND buddyID=%d", $userID, $sID);
        $db->query($query);

        return true;
    }

    /**
     * @param $userID
     * @param $buddyID
     */
    public static function updateConversationList($userID, $buddyID){
        global $db;

        //Getting Conversation List
        $convList = isset($_SESSION['converation_list']) ? $_SESSION['converation_list'] : [];

        //Getting the users that sent new messages not in the conversation list
        $newMessages = BuckysPrivateMessenger::getMessages($userID, $buddyID, 'new');
        foreach($newMessages as $row){
            if(!in_array($row['userID'], $convList)){
                $convList[] = $row['userID'];
            }
        }

        $_SESSION['converation_list'] = $convList;

    }
}
