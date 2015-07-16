<?php

/**
 * Manage Post Comments
 */
class BuckysComment {

    public static $COMMENT_LIMIT = 5;

    /**
     * Getting Post Comments
     *
     * @param      $postID
     * @param null $last_date
     * @return Indexed
     */
    public static function getPostComments($postID, $last_date = null){
        global $db;

        $userID = buckys_is_logged_in();

        if(!$last_date)
            $last_date = date('Y-m-d H:i:s');
        $query = $db->prepare("SELECT c.*, CONCAT(u.firstName, ' ', u.lastName) AS fullName, p.poster, r.reportID FROM " . TABLE_POSTS_COMMENTS . " AS c " . "LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=c.commenter " . "LEFT JOIN " . TABLE_POSTS . " AS p ON p.postID=c.postID " . "LEFT JOIN " . TABLE_REPORTS . " AS r ON r.objectID=c.commentID AND r.objectType='comment' AND r.reporterID=%d " . "WHERE c.commentStatus=1 AND c.postID=%s AND c.posted_date < %s ORDER BY c.posted_date DESC LIMIT 5 ", !$userID ? 0 : $userID, $postID, $last_date);

        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * Getting All Post Comments
     *
     * @param $postID
     * @return Indexed
     */
    public function getPostAllComments($postID){
        global $db;

        $userID = buckys_is_logged_in();

        $query = $db->prepare("SELECT c.*, CONCAT(u.firstName, ' ', u.lastName) AS fullName, u.thumbnail AS commenterThumbnail, p.poster, r.reportID FROM " . TABLE_POSTS_COMMENTS . " AS c " . "LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=c.commenter " . "LEFT JOIN " . TABLE_POSTS . " AS p ON p.postID=c.postID " . "LEFT JOIN " . TABLE_REPORTS . " AS r ON r.objectID=c.commentID AND r.objectType='comment' AND r.reporterID=%d " . "WHERE c.commentStatus=1 AND c.postID=%s ORDER BY c.posted_date DESC ", !$userID ? 0 : $userID, $postID);

        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * Get Post Comments Count
     *
     * @param mixed $postID
     * @return Int
     */
    public static function getPostCommentsCount($postID){
        global $db;

        $query = $db->prepare("SELECT comments FROM " . TABLE_POSTS . " WHERE postID=%d", $postID);
        $c = $db->getVar($query);

        return $c;
    }

    /**
     * Save Comment
     *
     * @param Int    $userID
     * @param Int    $postID
     * @param String $comment
     * @return int|null|string
     */
    public static function saveComments($userID, $postID, $comment, $image = null){
        global $db;

        $now = date("Y-m-d H:i:s");

        if($image != null){

            if(file_exists(DIR_FS_PHOTO_TMP . $image)){
                list($width, $height, $type, $attr) = getimagesize(DIR_FS_PHOTO_TMP . $image);

                if($width > MAX_COMMENT_IMAGE_WIDTH){
                    $height = $height * (MAX_COMMENT_IMAGE_WIDTH / $width);
                    $width = MAX_COMMENT_IMAGE_WIDTH;
                }
                if($height > MAX_COMMENT_IMAGE_HEIGHT){
                    $width = $width * (MAX_COMMENT_IMAGE_HEIGHT / $height);
                    $height = MAX_COMMENT_IMAGE_HEIGHT;
                }

                BuckysPost::moveFileFromTmpToUserFolder($userID, $image, $width, $height, 0, 0);
            }else{
                $image = null;
            }
        }

        $newId = $db->insertFromArray(TABLE_COMMENTS, ['postID' => $postID, 'commenter' => $userID, 'content' => $comment, 'image' => $image, 'posted_date' => $now]);

        if(buckys_not_null($newId)){
            $postData = BuckysPost::getPostById($postID);
            BuckysUsersDailyActivity::addComment($userID);
            //Update comments on the posts table
            $query = $db->prepare('UPDATE ' . TABLE_POSTS . ' SET `comments`=`comments` + 1 WHERE postID=%d', $postID);
            $db->query($query);
            
            //Add Activity
            $activityID = BuckysActivity::addActivity($userID, $postID, 'post', 'comment', $newId);
            
            //Add Notification
            if($postData['poster'] != $userID)
                BuckysActivity::addNotification($postData['poster'], $activityID, BuckysActivity::NOTIFICATION_TYPE_COMMENT_TO_POST);
            
            //Get Already Commented users which commentToComment is 1
            $query = $db->prepare("SELECT DISTINCT(pc.commenter), IFNULL(un.notifyCommentToMyComment, 1) AS notifyCommentToMyComment FROM " . TABLE_POSTS_COMMENTS . " AS pc LEFT JOIN " . TABLE_USERS_NOTIFY_SETTINGS . " AS un ON pc.commenter = un.userID WHERE pc.postID=%d AND pc.commenter != %d AND IFNULL(un.notifyCommentToMyComment, 1) > 0", $postID, $userID);
            $rows = $db->getResultsArray($query);
            
            foreach($rows as $row){
                BuckysActivity::addNotification($row['commenter'], $activityID, BuckysActivity::NOTIFICATION_TYPE_COMMENT_TO_COMMENT);
            }
            
            //Increase Hits
            BuckysHit::addHit($postID, $userID);

            //Update User Stats
            BuckysUser::updateStats($postData['poster'], 'comments', 1);

        }
        return $newId;
    }

    /**
     * Get Comment By ID
     *
     * @param $commentID
     * @return array
     */
    public static function getComment($commentID){
        global $db;

        $userID = buckys_is_logged_in();

        $query = $db->prepare("SELECT c.*, CONCAT(u.firstName, ' ', u.lastName) AS fullName, p.poster, r.reportID FROM " . TABLE_POSTS_COMMENTS . " AS c
                                    LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=c.commenter
                                    LEFT JOIN " . TABLE_POSTS . " AS p ON p.postID=c.postID
                                    LEFT JOIN " . TABLE_REPORTS . " AS r ON r.objectID=c.commentID AND r.objectType='comment' AND r.reporterID=%d
                                    WHERE c.commentID=%s
                                    ", $userID, $commentID);
        $row = $db->getRow($query);

        return $row;
    }

    /**
     * @param      $postID
     * @param null $last_date
     * @return one
     */
    public static function hasMoreComments($postID, $last_date = null){
        global $db;

        if(!$last_date)
            $last_date = date('Y-m-d H:i:s');
        $query = $db->prepare("SELECT count(1) FROM " . TABLE_POSTS_COMMENTS . " WHERE postID=%s AND posted_date < %s ", $postID, $last_date);

        $c = $db->getVar($query);

        return $c;
    }

    /**
     * @param $userID
     * @param $commentID
     * @return bool
     */
    public static function deleteComment($userID, $commentID){
        global $db;

        $query = $db->prepare("SELECT c.commentID, c.postID FROM " . TABLE_COMMENTS . " AS c LEFT JOIN " . TABLE_POSTS . " AS p ON p.postID=c.postID WHERE c.commentID=%s AND (c.commenter=%s OR p.poster=%s)", $commentID, $userID, $userID);
        $row = $db->getRow($query);

        if(!$row){
            return false;
        }else{
            $cID = $row['commentID'];
            $postID = $row['postID'];

            $db->query('DELETE FROM ' . TABLE_COMMENTS . " WHERE commentID=" . $cID);
            //Remove Activity
            $db->query( 'DELETE FROM ' . TABLE_MAIN_ACTIVITIES . " WHERE actionID=" . $cID );
            //Remove From Report
            $db->query('DELETE FROM ' . TABLE_REPORTS . " WHERE objectType='comment' AND objectID=" . $cID);

            //Update comments on the posts table
            $query = $db->prepare('UPDATE ' . TABLE_POSTS . ' SET `comments`=`comments` - 1 WHERE postID=%d', $postID);
            $db->query($query);

            $postData = BuckysPost::getPostById($postID);
            //Update User Stats
            BuckysUser::updateStats($postData['poster'], 'comments', -1);

            return true;
        }
    }

    /**
     * @param $commendID
     * @return one
     */
    public function getPostID($commendID){
        global $db;

        $query = $db->prepare("SELECT postID FROM " . TABLE_POSTS_COMMENTS . " WHERE commentID=%d", $commendID);

        return $db->getVar($query);
    }

    /**
     * @param $commendID
     * @return array
     */
    public static function getPost($commendID){
        global $db;

        $query = $db->prepare("SELECT p.* FROM " . TABLE_POSTS_COMMENTS . " AS c LEFT JOIN " . TABLE_POSTS . " AS p ON p.postID=c.postID WHERE c.commentID=%d", $commendID);

        return $db->getRow($query);
    }

    /**
     * @param $userID
     * @return bool
     */
    public function checkUserDailyCommentsLimits($userID){
        global $db;

        if(buckys_check_user_acl(USER_ACL_MODERATOR) || buckys_check_user_acl(USER_ACL_ADMINISTRATOR)){
            return true;
        }

        //Get created posts on today
        $query = $db->prepare("SELECT count(*) FROM " . TABLE_POSTS_COMMENTS . " WHERE commenter=%d AND DATE(`posted_date`) = %s", $userID, date("Y-m-d"));
        $comments = $db->getVar($query);

        if($comments > USER_DAILY_LIMIT_COMMENTS){
            return false;
        }

        return true;
    }

}
