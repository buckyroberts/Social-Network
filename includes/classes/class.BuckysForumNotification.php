<?php

/**
 * Manage Forum Notifications
 */
class BuckysForumNotification {

    const ACTION_TYPE_REPLIED_TO_TOPIC = 'replied_to_topic';
    const ACTION_TYPE_REPLIED_TO_REPLY = 'replied_to_reply';
    const ACTION_TYPE_TOPIC_APPROVED = 'topic_approved';
    const ACTION_TYPE_REPLY_APPROVED = 'reply_approved';

    /**
     * Add notification for the repliers whose 'Someone reply to a topic that I replied' set 1
     *
     * @param     $replierID
     * @param Int $topicID
     * @param Int $replyID
     * @return bool
     */
    public function addNotificationsForReplies($replierID, $topicID, $replyID){
        global $db, $TNB_GLOBALS;

        $query = $db->prepare("SELECT DISTINCT(fr.creatorID), fr.replyID, fs.* FROM " . TABLE_FORUM_REPLIES . " AS fr LEFT JOIN " . TABLE_USERS_NOTIFY_SETTINGS . " AS fs ON fs.userID=fr.creatorID WHERE fr.topicID=%d", $topicID);
        $rows = $db->getResultsArray($query);

        $activity = new BuckysActivity();

        foreach($rows as $row){
            $tForumSettings = ['notifyRepliedToMyTopic' => $row['notifyRepliedToMyTopic'] === null ? $TNB_GLOBALS['notify_settings']['notifyRepliedToMyTopic'] : $row['notifyRepliedToMyTopic'], 'notifyRepliedToMyReply' => $row['notifyRepliedToMyReply'] === null ? $TNB_GLOBALS['notify_settings']['notifyRepliedToMyReply'] : $row['notifyRepliedToMyReply'], 'notifyMyPostApproved' => $row['notifyMyPostApproved'] === null ? $TNB_GLOBALS['notify_settings']['notifyMyPostApproved'] : $row['notifyMyPostApproved']];
            if($row['replyID'] != $replyID && $row['creatorID'] != $replierID && $tForumSettings['notifyRepliedToMyReply']){
                $activity->addForumActivity($row['creatorID'], $topicID, 'forum', BuckysForumNotification::ACTION_TYPE_REPLIED_TO_REPLY, $replyID);
            }
        }

        return true;
    }

    /**
     * Add notification for the repliers whose 'Someone reply to my topic' set 1
     *
     * @param Int $ownerID
     * @param Int $topicID
     * @param Int $replyID
     * @return bool
     */
    public function addNotificationsForTopic($ownerID, $topicID, $replyID){
        global $db, $TNB_GLOBALS;

        $forumSettings = BuckysUser::getUserNotificationSettings($ownerID);

        $activity = new BuckysActivity();
        if($forumSettings['notifyRepliedToMyTopic']){
            $activity->addForumActivity($ownerID, $topicID, 'forum', BuckysForumNotification::ACTION_TYPE_REPLIED_TO_TOPIC, $replyID);
        }

        return true;
    }

    /**
     * Add notification for the users whose 'My post approved' set 1.
     *
     * @param Int $ownerID
     * @param Int $topicID
     * @param Int $replyID
     * @return bool
     */
    public function addNotificationsForPendingPost($ownerID, $topicID, $replyID = null){
        global $db, $TNB_GLOBALS;

        $forumSettings = BuckysUser::getUserNotificationSettings($ownerID);

        $activity = new BuckysActivity();
        if($forumSettings['notifyMyPostApproved']){
            if($replyID == null)
                $activity->addForumActivity($ownerID, $topicID, 'forum', BuckysForumNotification::ACTION_TYPE_TOPIC_APPROVED, 0);else
                $activity->addForumActivity($ownerID, $topicID, 'forum', BuckysForumNotification::ACTION_TYPE_REPLY_APPROVED, $replyID);
        }

        return true;
    }

    /**
     * Make Notofications to Read
     *
     * @param Int $userID
     */
    public static function makeNotificationsToRead($userID, $categoryID = null, $topicID = null){
        global $db;

        if($categoryID != null){
            $query = $db->prepare("UPDATE " . TABLE_FORUM_ACTIVITIES . " SET isNew=0 WHERE objectType='forum' AND isNew='1' AND userID=%d AND objectID IN " . "(SELECT topicID FROM " . TABLE_FORUM_TOPICS . " WHERE categoryID=%d)", $userID, $categoryID);
            $db->query($query);
        }else if($topicID != null){
            $query = $db->prepare("UPDATE " . TABLE_FORUM_ACTIVITIES . " SET isNew=0 WHERE objectType='forum' AND isNew='1' AND userID=%d AND actionID IN " . "(SELECT replyID FROM " . TABLE_FORUM_REPLIES . " WHERE topicID=%d)", $userID, $topicID);
            $db->query($query);
            $query = $db->prepare("UPDATE " . TABLE_FORUM_ACTIVITIES . " SET isNew=0 WHERE objectType='forum' AND isNew='1' AND userID=%d AND objectID=%d", $userID, $topicID);
            $db->query($query);

        }else{
            $query = $db->prepare("UPDATE " . TABLE_FORUM_ACTIVITIES . " SET isNew=0 WHERE objectType='forum' AND isNew='1' AND userID=%d", $userID);
            $db->query($query);
        }

    }

    /**
     * Get the number of new notifications
     *
     * @param Int $userID
     * @return Int
     */
    public function getNumOfNewNotifications($userID, $isNew = 1){
        global $db;

        $query = $db->prepare("SELECT count(activityID) FROM " . TABLE_FORUM_ACTIVITIES . " WHERE objectType='forum' AND isNew=%d AND activityStatus=1 AND userID=%d", $isNew, $userID);
        $count = $db->getVar($query);

        return $count;
    }

    /**
     * Get Notifications
     *
     * @param Int $userID
     * @param Int $limit = 10
     * @return Indexed
     */
    public static function getNewNotifications($userID, $isNew = 1, $limit = 5){
        global $db;

        $query = $db->prepare("SELECT a.*, t.topicTitle, t.creatorID AS topicCreatorID, r.creatorID AS replierID, CONCAT(u.firstName, ' ', u.lastName) AS rName, u.thumbnail AS rThumbnail  FROM " . TABLE_FORUM_ACTIVITIES . " AS a " . "LEFT JOIN " . TABLE_FORUM_TOPICS . " AS t ON a.objectID=t.topicID " . "LEFT JOIN " . TABLE_FORUM_REPLIES . " AS r ON a.actionID=r.replyID " . "LEFT JOIN " . TABLE_USERS . " AS u ON r.creatorID=u.userID " . "WHERE a.objectType='forum' AND a.isNew=%d AND a.userID=%d AND a.activityStatus=1 ORDER BY a.createdDate DESC LIMIT %d", $isNew, $userID, $limit);
        $rows = $db->getResultsArray($query);

        return $rows;
    }
}