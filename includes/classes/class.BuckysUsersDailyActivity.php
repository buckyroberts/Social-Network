<?php

class BuckysUsersDailyActivity {

    /**
     * @param $userID
     */
    public static function addPost($userID){
        global $db;

        $date = date('Y-m-d');

        $query = $db->prepare("INSERT INTO " . TABLE_USERS_DAILY_ACTIVITIES . "(`userID`, `date`, `posts`)VALUES(%d, %s, 1) ON DUPLICATE KEY UPDATE `posts` = `posts` + 1", $userID, $date);
        $db->query($query);

    }

    /**
     * @param $userID
     */
    public static function addComment($userID){
        global $db;

        $date = date('Y-m-d');

        $query = $db->prepare("INSERT INTO " . TABLE_USERS_DAILY_ACTIVITIES . "(`userID`, `date`, `comments`)VALUES(%d, %s, 1) ON DUPLICATE KEY UPDATE `comments` = `comments` + 1", $userID, $date);
        $db->query($query);

    }

    /**
     * @param $userID
     */
    public static function addLikes($userID){
        global $db;

        $date = date('Y-m-d');

        $query = $db->prepare("INSERT INTO " . TABLE_USERS_DAILY_ACTIVITIES . "(`userID`, `date`, `likes`)VALUES(%d, %s, 1) ON DUPLICATE KEY UPDATE `likes` = `likes` + 1", $userID, $date);
        $db->query($query);
    }

    /**
     * @param $userID
     */
    public static function addFrendRequest($userID){
        global $db;

        $date = date('Y-m-d');

        $query = $db->prepare("INSERT INTO " . TABLE_USERS_DAILY_ACTIVITIES . "(`userID`, `date`, `friendRequests`)VALUES(%d, %s, 1) ON DUPLICATE KEY UPDATE `friendRequests` = `friendRequests` + 1", $userID, $date);
        $db->query($query);
    }

    /**
     * @param $userID
     * @param $type
     * @return bool
     */
    public static function checkUserDailyLimit($userID, $type){
        global $db;

        $date = date('Y-m-d');

        //Delete Old Data
        $db->query($db->prepare("DELETE FROM " . TABLE_USERS_DAILY_ACTIVITIES . " WHERE userID=%d AND `date` < %s", $userID, $date));

        if(buckys_check_user_acl(USER_ACL_MODERATOR, $userID) || buckys_check_user_acl(USER_ACL_ADMINISTRATOR, $userID)){
            return true;
        }

        //Get Activities
        $query = $db->prepare("SELECT * FROM " . TABLE_USERS_DAILY_ACTIVITIES . " WHERE userID=%d AND `date` = %s", $userID, $date);
        $row = $db->getRow($query);

        if(!$row){
            return true;
        }

        switch($type){
            case 'posts':
                return $row['posts'] < USER_DAILY_LIMIT_POSTS;
            case 'likes':
                return $row['likes'] < USER_DAILY_LIMIT_LIKES;
            case 'comments':
                return $row['comments'] < USER_DAILY_LIMIT_COMMENTS;
            case 'friendRequests':
                return $row['friendRequests'] < USER_DAILY_LIMIT_FRIEND_REQUESTS;
        }

        return false;
    }
}