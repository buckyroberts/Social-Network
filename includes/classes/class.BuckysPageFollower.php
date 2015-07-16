<?php

/**
 * Page Followers management
 */
class BuckysPageFollower {

    const COUNT_PER_PAGE = 15;

    /**
     * Add followers
     *
     * @param integer $pageID
     * @param integer $userID
     * @return int
     */
    public function addFollower($pageID, $userID){
        global $db;

        if(!is_numeric($pageID) || !is_numeric($userID))
            return; // failed

        if($this->hasRelationInFollow($pageID, $userID))
            return; // already exists

        $pageIns = new BuckysPage();
        $pageData = $pageIns->getPageByID($pageID);

        if(isset($pageData)){
            $data = [];
            $data['pageID'] = $pageID;
            $data['userID'] = $userID;
            $data['createdDate'] = date('Y-m-d H:i:s');
            $newID = $db->insertFromArray(TABLE_PAGE_FOLLOWERS, $data);

            //Update User Stats
            BuckysUser::updateStats($pageData['userID'], 'pageFollowers', 1);

            return $newID;
        }else{
            return;
        }

    }

    /**
     * Unfollow
     *
     * @param integer $pageID
     * @param integer $userID
     * @return int
     */
    public function removeFollower($pageID, $userID){
        global $db;

        if(!is_numeric($pageID) || !is_numeric($userID))
            return; // failed

        if($this->hasRelationInFollow($pageID, $userID)){

            $query = sprintf("DELETE FROM %s WHERE pageID=%d AND userID=%d", TABLE_PAGE_FOLLOWERS, $pageID, $userID);
            $db->query($query);

            $pageData = BuckysPage::getPageByID($pageID);

            //Update User Stats
            BuckysUser::updateStats($pageData['userID'], 'pageFollowers', -1);

            return true;
        }

        return;
    }

    /**
     * Check relations if it has already followed the page
     *
     * @param integer $pageID
     * @param integer $userID
     * @return bool
     */
    public function hasRelationInFollow($pageID, $userID){

        global $db;
        $pageIns = new BuckysPage();

        if(!is_numeric($pageID) || !is_numeric($userID))
            return false; // failed

        $pageData = $pageIns->getPageByID($pageID);
        if($pageData['userID'] == $userID){
            //It means you are the owner of this page.
            //            return true;
        }

        $query = sprintf("SELECT * FROM %s WHERE pageID=%d AND userID=%d", TABLE_PAGE_FOLLOWERS, $pageID, $userID);

        if($db->getRow($query)){
            return true;
        }else{
            return false;
        }

    }

    /**
     * Get followers by PageID
     *
     * @param         $pageID
     * @param integer $page
     * @param integer $limit
     * @param boolean $isRand
     * @return Indexed
     */
    public function getFollowers($pageID, $page = 1, $limit = 1, $isRand = false){

        global $db;

        if(!is_numeric($pageID))
            return;

        $randStr = '';
        if($isRand){

            $randStr = ', rand() ';
        }

        $query = sprintf("SELECT DISTINCT(u.userID), u.*, CONCAT(u.firstName, ' ', u.lastName) AS fullName, IF(u.thumbnail = '', 0, 1) AS hasThumbnail
                FROM %s AS pf 
                LEFT JOIN %s AS u ON u.userID = pf.userID 
                WHERE u.status=1 AND pf.pageID=%d ORDER BY hasTHumbnail DESC, pf.createdDate, fullName ASC %s
        ", TABLE_PAGE_FOLLOWERS, TABLE_USERS, $pageID, $randStr);

        $query .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;

        $rows = $db->getResultsArray($query);

        return $rows;

    }

    /**
     * Remove page followers when removing page
     *
     * @param mixed $pageID
     */
    public function removeAllFollowersByPageID($pageID){

        global $db;

        if(!is_numeric($pageID))
            return;

        //Getting Followers
        $query = $db->prepare("SELECT userID FROM " . TABLE_PAGES . " WHERE pageID=%d", $pageID);
        $pageCreatorId = $db->getVar($query);

        //Getting Followers
        $query = $db->prepare("SELECT count(*) FROM " . TABLE_PAGE_FOLLOWERS . " WHERE pageID=%d", $pageID);
        $followers = $db->getVar($query);

        if($followers > 0)
            BuckysUser::updateStats($pageCreatorId, 'pageFollowers', -1 * $followers);

        $query = sprintf("DELETE FROM %s WHERE pageID=%d", TABLE_PAGE_FOLLOWERS, $pageID);
        $db->query($query);

        return;
    }

    /**
     * Get number of followers
     *
     * @param integer $pageID
     * @return int|one
     */
    public function getNumberOfFollowers($pageID){

        global $db;

        if(!is_numeric($pageID))
            return 0;

        $query = sprintf("SELECT count(*) FROM %s WHERE pageID=%d", TABLE_PAGE_FOLLOWERS, $pageID);
        return $db->getVar($query);

    }

    /**
     * Get page list with follower ID, in another words, return pages this user followed
     *
     * @param integer $userID
     * @param integer $limit
     * @return Indexed|void
     */
    public function getPagesByFollowerID($userID, $page = 1, $limit = null){

        global $db;

        if(!is_numeric($userID))
            return;

        $limitCond = '';
        if(isset($limit) && is_numeric($limit) && $limit > 0 && $page >= 1){
            $limitCond .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;
        }

        $query = sprintf("SELECT pf.pageID, p.userID, p.title, p.logo, p.about, p.links, p.createdDate, (SELECT COUNT(*) FROM %s AS fcpf WHERE fcpf.pageID=pf.pageID) AS followerCount, IF(p.userID=%s, 0, 1) AS pageOwner FROM %s AS pf LEFT JOIN %s AS p ON p.pageID=pf.pageID WHERE pf.userID=%d AND p.status=%d ORDER BY pageOwner %s", TABLE_PAGE_FOLLOWERS, $userID, TABLE_PAGE_FOLLOWERS, TABLE_PAGES, $userID, BuckysPage::STATUS_ACTIVE, $limitCond);

        return $db->getResultsArray($query);

    }

    /**
     * Get page count by follower ID
     *
     * @param integer $userID
     * @return int|one
     */
    public function getPagesCountByFollowerID($userID){

        global $db;

        if(!is_numeric($userID))
            return 0;

        $query = sprintf("SELECT count(pf.pageID) FROM %s AS pf LEFT JOIN %s AS p ON p.pageID=pf.pageID WHERE pf.userID=%d AND p.status=%d %s", TABLE_PAGE_FOLLOWERS, TABLE_PAGES, $userID, BuckysPage::STATUS_ACTIVE, $limitCond);

        return $db->getVar($query);

    }

    /**
     * Check the user is following the page
     *
     * @param mixed $userID
     * @param mixed $pageID
     * @return bool
     */
    public static function isFollower($userID, $pageID){
        global $db;

        $query = $db->prepare("SELECT id FROM " . TABLE_PAGE_FOLLOWERS . " WHERE pageID=%d AND userID=%d", $pageID, $userID);
        $fid = $db->getVar($query);

        return $fid ? true : false;
    }

}