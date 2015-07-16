<?php

/**
 * Manage Forum Follower
 */
class BuckysForumFollower {

    /**
     * Make user follow all categories
     *
     * @param mixed $userID
     * @return bool
     */
    public function followAllForum($userID){
        global $db;

        $all_categories = $db->getResultsArray("SELECT categoryID FROM " . TABLE_FORUM_CATEGORIES . " ORDER BY parentID, sortOrder");

        foreach($all_categories as $c){
            $query = $db->prepare("INSERT INTO " . TABLE_FORUM_FOLLOWERS . "(`userID`, `categoryID`)VALUES(%d, %d)", $userID, $c['categoryID']);
            $db->query($query);
            $query = $db->prepare("UPDATE " . TABLE_FORUM_CATEGORIES . " SET `followers`=`followers` + 1 WHERE categoryID=%d", $c['categoryID']);
            $db->query($query);
        }

        return true;
    }

    /**
     * Make user follow the basic forums
     *
     * @param mixed $userID
     * @return bool
     */
    public static function followBasicForums($userID){
        global $db;

        $all_categories = $db->getResultsArray("SELECT categoryID FROM " . TABLE_FORUM_CATEGORIES . " WHERE parentID IN (1,2,3,4,5) ORDER BY parentID, sortOrder");

        foreach($all_categories as $c){
            $query = $db->prepare("INSERT INTO " . TABLE_FORUM_FOLLOWERS . "(`userID`, `categoryID`)VALUES(%d, %d)", $userID, $c['categoryID']);
            $db->query($query);
            $query = $db->prepare("UPDATE " . TABLE_FORUM_CATEGORIES . " SET `followers`=`followers` + 1 WHERE categoryID=%d", $c['categoryID']);
            $db->query($query);
        }

        return true;
    }

    /**
     * @param $userID
     * @param $categoryID
     * @return bool
     */
    public static function followForum($userID, $categoryID){
        global $db;

        $query = $db->prepare("INSERT INTO " . TABLE_FORUM_FOLLOWERS . "(`userID`, `categoryID`)VALUES(%d, %d)", $userID, $categoryID);
        $db->query($query);

        //Update Category Followers
        $query = $db->prepare("UPDATE " . TABLE_FORUM_CATEGORIES . " SET `followers`=`followers` + 1 WHERE categoryID=%d", $categoryID);
        $db->query($query);

        return true;
    }

    /**
     * @param $userID
     * @param $categoryID
     * @return bool
     */
    public static function unfollowForum($userID, $categoryID){
        global $db;

        $query = $db->prepare("DELETE FROM " . TABLE_FORUM_FOLLOWERS . " WHERE `userID`=%d AND `categoryID`=%d", $userID, $categoryID);
        $db->query($query);

        //Update Category Followers
        $query = $db->prepare("UPDATE " . TABLE_FORUM_CATEGORIES . " SET `followers`=`followers` - 1 WHERE categoryID=%d", $categoryID);
        $db->query($query);

        //Remove Moderator
        $query = $db->prepare("DELETE FROM " . TABLE_FORUM_MODERATORS . " WHERE `userID`=%d AND `categoryID`=%d", $userID, $categoryID);
        $db->query($query);

        return true;
    }

    /**
     * @param      $categoryID
     * @param null $userID
     * @return one
     */
    public static function isFollow($categoryID, $userID = null){
        global $db;

        if(!$userID)
            $userID = buckys_is_logged_in();

        $query = $db->prepare("SELECT id FROM " . TABLE_FORUM_FOLLOWERS . " WHERE categoryID=%d AND userID=%d", $categoryID, $userID);
        $id = $db->getVar($query);

        return $id;
    }

}