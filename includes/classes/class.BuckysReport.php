<?php

/**
 * Manage reported
 */
class BuckysReport {

    public static $COUNT_PER_PAGE = 20;

    /**
     * Report post, comment and message
     *
     * @param Int    $userID
     * @param Int    $objectID
     * @param String $objectType
     * @return Boolean or String
     */
    public static function reportObject($userID, $objectID, $objectType){
        global $db;

        //Check that the object has already been reported by the user
        $query = $db->prepare("SELECT reportID FROM " . TABLE_REPORTS . " WHERE reporterID=%d AND objectID=%d AND objectType=%s", $userID, $objectID, $objectType);
        $rID = $db->getVar($query);

        if($rID){
            return MSG_ALREADY_REPORTED;
        }

        //Check that the object id is correct
        switch($objectType){
            case 'post':
                $query = $db->prepare("SELECT postID AS objectID, poster AS reportedID FROM " . TABLE_POSTS . " WHERE postID=%d AND `post_status`=1", $objectID);
                break;
            case 'comment':
                $query = $db->prepare("SELECT commentID AS objectID, commenter AS reportedID FROM " . TABLE_POSTS_COMMENTS . " WHERE commentID=%d AND commentStatus=1", $objectID);
                break;
            case 'video_comment':
                $query = $db->prepare("SELECT commentID AS objectID, userID AS reportedID FROM " . TABLE_VIDEO_COMMENTS . " WHERE commentID=%d", $objectID);
                break;
            case 'message':
                $query = $db->prepare("SELECT messageID AS objectID, sender AS reportedID  FROM " . TABLE_MESSAGES . " WHERE userID=%d AND messageID=%d AND messageStatus=1", $userID, $objectID);
                break;
            case 'topic':
                $query = $db->prepare("SELECT topicID AS objectID, creatorID AS reportedID FROM " . TABLE_FORUM_TOPICS . " WHERE topicID=%d AND `status`='publish'", $objectID);
                break;
            case 'reply':
                $query = $db->prepare("SELECT replyID AS objectID, creatorID AS reportedID FROM " . TABLE_FORUM_REPLIES . " WHERE replyID=%d AND `status`='publish'", $objectID);
                break;
            case 'trade_item':
                $query = $db->prepare("SELECT itemID AS objectID, userID AS reportedID FROM " . TABLE_TRADE_ITEMS . " WHERE itemID=%d", $objectID);
                break;
            case 'shop_item':
                $query = $db->prepare("SELECT productID AS objectID, userID AS reportedID FROM " . TABLE_SHOP_PRODUCTS . " WHERE productID=%d", $objectID);
                break;

        }
        $oRow = $db->getRow($query);

        if(!$oRow){
            return MSG_INVALID_REQUEST;
        }

        //Report Object
        $nId = $db->insertFromArray(TABLE_REPORTS, ['reporterID' => $userID, 'objectID' => $oRow['objectID'], 'objectType' => $objectType, 'reportedID' => $oRow['reportedID'], 'reportStatus' => 1, 'reportedDate' => date('Y-m-d H:i:s')]);
        if(!$nId)
            return $db->getLastError();else
            return true;
    }

    /**
     * Get Reported Object Count
     *
     * @return Int
     */
    public static function getReportedObjectCount(){
        global $db;

        $query = "SELECT count(objectID) FROM " . TABLE_REPORTS . " WHERE reportStatus=1";
        $count = $db->getVar($query);

        return $count;
    }

    /**
     * Get Reported Object Count
     *
     * @param Int $page
     * @param int $limit
     * @return Array
     */
    public static function getReportedObject($page = 1, $limit = null){
        global $db;

        $query = "SELECT DISTINCT(r.reportID), 
                          r.objectID,
                          r.objectType,
                          r.reportedDate,                          
                          CONCAT(ru.firstName, ' ', ru.lastName) AS reporterName,
                          ru.userID AS reporterID,
                          ru.thumbnail AS reporterThumb,
                          CONCAT(ou.firstName, ' ', ou.lastName) AS ownerName,
                          ou.user_acl_id,
                          ou.userID AS ownerID,
                          ou.thumbnail AS ownerThumb
                  FROM " . TABLE_REPORTS . " AS r " . "LEFT JOIN " . TABLE_USERS . " AS ru ON ru.userID=r.reporterID " . "LEFT JOIN " . TABLE_USERS . " AS ou ON ou.userID=r.reportedID " . "WHERE reportStatus=1 ORDER BY reportedDate ";

        if($limit == null)
            $limit = BuckysReport::$COUNT_PER_PAGE;

        $query .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;

        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * Delete Objects
     *
     * @param Array $ids
     */
    public static function deleteObjects($ids){
        global $db;

        if(!is_array($ids))
            $ids = [$ids];

        $ids = $db->escapeInput($ids);

        $query = $db->prepare("SELECT * FROM " . TABLE_REPORTS . " WHERE reportID IN (" . implode(", ", $ids) . ")");
        $rows = $db->getResultsArray($query);

        foreach($rows as $row){
            if($row['objectType'] == 'post'){
                $post = $db->getRow("SELECT * FROM " . TABLE_POSTS . " WHERE postID=" . $row['objectID']);
                BuckysPost::deletePost($post['poster'], $post['postID']);
            }else if($row['objectType'] == 'comment'){
                //Getting Data
                $comment = $db->getRow("SELECT * FROM " . TABLE_POSTS_COMMENTS . " WHERE commentID=" . $row['objectID']);
                BuckysComment::deleteComment($comment['commenter'], $comment['commentID']);
            }else if($row['objectType'] == 'video_comment'){
                //Getting Data
                $comment = $db->getRow("SELECT * FROM " . TABLE_VIDEO_COMMENTS . " WHERE commentID=" . $row['objectID']);
                BuckysVideo::deleteVideoComment($comment['commentID']);
            }else if($row['objectType'] == 'message'){
                //Delete Message
                $db->query("DELETE FROM " . TABLE_MESSAGES . " WHERE messageID=" . $row['objectID']);
            }else if($row['objectType'] == 'topic'){
                //Delete Topic
                BuckysForumTopic::deleteTopic($row['objectID']);
            }else if($row['objectType'] == 'reply'){
                //Delete Topic
                BuckysForumReply::deleteReply($row['objectID']);
            }else if($row['objectType'] == 'shop_item'){
                //Delete Shop Product
                $shopProdIns = new BuckysShopProduct();
                $shopProdIns->removeProductByUserID($row['objectID'], $row['reportedID']);
            }else if($row['objectType'] == 'trade_item'){
                //Delete Trade Item
                $tradeItemIns = new BuckysTradeItem();
                $tradeItemIns->removeItemByUserID($row['objectID'], $row['reportedID']);
            }

            //Delete the row on the report table
            $db->query("DELETE FROM " . TABLE_REPORTS . " WHERE reportID=" . $row['reportID']);
        }

        return;
    }

    /**
     * Approve Reported Objects
     *
     * @param Array $ids
     */
    public static function approveObjects($ids){
        global $db;

        if(!is_array($ids))
            $ids = [$ids];

        $ids = $db->escapeInput($ids);

        $query = "SELECT * FROM " . TABLE_REPORTS . " WHERE reportID IN (" . implode(", ", $ids) . ")";
        $rows = $db->getResultsArray($query);

        foreach($rows as $row){
            //Delete the row on the report table
            $db->query("DELETE FROM " . TABLE_REPORTS . " WHERE reportID=" . $row['reportID']);
        }

        return;
    }

    /**
     * Ban users
     *
     * @param Array $ids
     * @return int
     */
    public static function banUsers($ids){
        global $db;

        if(!is_array($ids))
            $ids = [$ids];

        $query = "SELECT * FROM " . TABLE_REPORTS . " WHERE reportID IN (" . implode(", ", $ids) . ")";
        $rows = $db->getResultsArray($query);

        $bannedUsers = 0;
        $adminUsers = 0;
        foreach($rows as $row){
            //Getting User ID
            if($row['objectType'] == 'post'){
                $query = "SELECT poster FROM " . TABLE_POSTS . " WHERE postID=" . $row['objectID'];
            }else if($row['objectType'] == 'comment'){
                $query = "SELECT commenter FROM " . TABLE_POSTS_COMMENTS . " WHERE commentID=" . $row['objectID'];
            }else if($row['objectType'] == 'video_comment'){
                $query = "SELECT userID FROM " . TABLE_VIDEO_COMMENTS . " WHERE commentID=" . $row['objectID'];
            }else if($row['objectType'] == 'message'){
                $query = "SELECT sender FROM " . TABLE_MESSAGES . " WHERE messageID=" . $row['objectID'];
            }else if($row['objectType'] == 'topic'){
                $query = "SELECT creatorID FROM " . TABLE_FORUM_TOPICS . " WHERE topicID=" . $row['objectID'];
            }else if($row['objectType'] == 'reply'){
                $query = "SELECT creatorID FROM " . TABLE_FORUM_REPLIES . " WHERE replyID=" . $row['objectID'];
            }
            $userID = $db->getVar($query);

            if($userID){
                if(!buckys_check_user_acl(USER_ACL_MODERATOR, $userID)){
                    BuckysBanUser::banUser($userID);
                    $bannedUsers++;
                }else{
                    $adminUsers++;
                }
            }

        }
        if($adminUsers > 0)
            buckys_add_message(MSG_CAN_NOT_BAN_ADMIN, MSG_TYPE_NOTIFY);

        return $bannedUsers;
    }

    /**
     * Check the object is reported and return the report id if it is reported
     *
     * @param mixed $objectID
     * @param mixed $objectType
     * @return one
     */
    public static function isReported($objectID, $objectType){
        global $db;

        $query = $db->prepare("SELECT reportID FROM " . TABLE_REPORTS . " WHERE objectID=%d AND objectType=%s", $objectID, $objectType);

        $reportID = $db->getVar($query);

        return $reportID;
    }

}
