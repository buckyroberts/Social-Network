<?php

/**
 * Moderator Management
 */
class BuckysModerator {

    public static $CANDIDATES_PER_PAGE = 15;

    /**
     * Get Moderator
     *
     * @return array
     * @internal param String $type
     */
    public static function getModerators(){
        global $db, $TNB_GLOBALS;

        $query = "SELECT u.firstName, u.lastName, u.thumbnail, u.userID FROM " . TABLE_MODERATOR . " AS m " . "LEFT JOIN " . TABLE_USERS . " AS u ON m.userID=u.userID WHERE m.moderatorStatus=1";

        $row = $db->getResultsArray($query);

        return $row;
    }

    /**
     * Get Candidates Count
     *
     * @return Int
     */
    public static function getCandidatesCount(){
        global $db, $TNB_GLOBALS;

        $query = "SELECT count(1) FROM " . TABLE_MODERATOR_CANDIDATES;

        $count = $db->getVar($query);

        return $count;
    }

    /**
     * Get Candidates
     *
     * @param int  $page
     * @param null $limit
     * @return Array
     */
    public static function getCandidates($page = 1, $limit = null){
        global $db, $TNB_GLOBALS;

        if($limit == null)
            $limit = BuckysModerator::$CANDIDATES_PER_PAGE;

        $query = $db->prepare("SELECT mc.*, u.firstName, u.lastName, u.thumbnail, v.voteID FROM " . TABLE_MODERATOR_CANDIDATES . " AS mc " . "LEFT JOIN " . TABLE_USERS . " AS u ON mc.userID=u.userID " . "LEFT JOIN " . TABLE_MODERATOR_VOTES . " AS v ON v.candidateID=mc.candidateID AND v.voterID=%d " . "ORDER BY mc.votes DESC ", $TNB_GLOBALS['user']['userID']);

        $query .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;

        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * Apply For Moderator
     *
     * @param Int    $userID
     * @param String $text
     * @param null   $candidateID
     * @return bool|void
     */
    public static function applyCandidate($userID, $text, $candidateID = null){
        global $db;

        //Check whether the user has already applied or not
        $query = $db->prepare("SELECT candidateID FROM " . TABLE_MODERATOR_CANDIDATES . " WHERE userID=%d", $userID);
        $candidateID = $db->getVar($query);

        if($candidateID){
            buckys_redirect('/moderator.php', MSG_ALREADY_APPLIED_THE_MODERATOR, MSG_TYPE_ERROR);
            return;
        }

        $text = trim($text);
        if(!$text){
            buckys_redirect('/moderator.php', MSG_TELL_US_WHY_YOU_WOULD_MAKE_MODERATOR, MSG_TYPE_ERROR);
            return;
        }

        //Save Candidate
        $newID = $db->insertFromArray(TABLE_MODERATOR_CANDIDATES, ['userID' => $userID, 'candidateText' => $text, 'votes' => 0, 'appliedDate' => date('Y-m-d H:i:s')]);

        if(!$newID){
            buckys_redirect('/moderator.php', $db->getLastError(), MSG_TYPE_ERROR);
            return;
        }

        return true;
    }

    /**
     * Apply For Moderator
     *
     * @param        $candidateID
     * @param Int    $userID
     * @param String $text
     * @return bool|void
     */
    public static function updateCandidate($candidateID, $userID, $text){
        global $db;

        //Check whether the user has already applied or not
        $query = $db->prepare("SELECT candidateID FROM " . TABLE_MODERATOR_CANDIDATES . " WHERE userID=%d AND candidateID=%d", $userID, $candidateID);
        $candidateID = $db->getVar($query);

        if(!$candidateID){
            buckys_redirect('/moderator.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
            return;
        }

        $text = trim($text);
        if(!$text){
            buckys_redirect('/moderator.php', MSG_TELL_US_WHY_YOU_WOULD_MAKE_MODERATOR, MSG_TYPE_ERROR);
            return;
        }

        //Save Candidate
        $newID = $db->updateFromArray(TABLE_MODERATOR_CANDIDATES, ['candidateText' => $text], ['candidateID' => $candidateID]);

        if(!$newID){
            buckys_redirect('/moderator.php', $db->getLastError(), MSG_TYPE_ERROR);
            return;
        }

        return true;
    }

    /**
     * Vote Candidate
     *
     * @param Int     $userID : Voter ID
     * @param Int     $candidateID
     * @param Boolean $isApproval
     * @return int|null|string
     */
    public static function voteCandidate($userID, $candidateID, $isApproval = true){
        global $db;

        //Get the Candidate User ID        
        $query = $db->prepare("SELECT * FROM " . TABLE_MODERATOR_CANDIDATES . " WHERE candidateID=%d", $candidateID);
        $candidateRow = $db->getRow($query);

        //If the candidate id is not correct,
        if(!$candidateRow){
            return MSG_INVALID_REQUEST;
        }

        //If the candidate's id is the same with the current user id
        if($candidateRow['userID'] == $userID){
            return MSG_INVALID_REQUEST;
        }

        //If the user already took a vote on this candidate
        $query = $db->prepare("SELECT voteID FROM " . TABLE_MODERATOR_VOTES . " WHERE candidateID=%d AND voterID=%d", $candidateID, $userID);
        $voteID = $db->getVar($query);
        if($voteID){
            return MSG_ALREADY_VOTE;
        }

        //Take a vote on this candidate
        $newID = $db->insertFromArray(TABLE_MODERATOR_VOTES, ['voterID' => $userID, 'candidateID' => $candidateID, 'voteType' => $isApproval ? 1 : 0, 'voteDate' => date('Y-m-d H:i:s')]);
        if(!$newID)
            return $db->getLastError();

        //Update moderator_candidates table

        if($isApproval)
            $newVotes = intval($candidateRow['votes']) + 1;else
            $newVotes = intval($candidateRow['votes']) - 1;
        $query = $db->prepare("UPDATE " . TABLE_MODERATOR_CANDIDATES . " SET `votes`=%d WHERE candidateID=%d", $newVotes, $candidateID);
        $db->query($query);

        return $newVotes;
    }

    /**
     * Check that the user is a moderator.
     *
     * @param Int $userID
     * @return bool
     */
    public static function isModerator($userID){
        global $db;

        $query = $db->prepare("SELECT moderatorID FROM " . TABLE_MODERATOR . " WHERE moderatorStatus=1 AND userID=%d", $userID);
        $mID = $db->getVar($query);

        return !$mID ? false : true;
    }

    /**
     * Choose Moderator
     *
     * @param $userID
     * @return Error Message or True
     */
    public static function addModerator($userID){
        global $db, $TNB_GLOBALS;

        //Check user acl again
        if(!buckys_check_user_acl(USER_ACL_ADMINISTRATOR)){
            return MSG_PERMISSION_DENIED;
        }

        //Check Candidate ID 
        $query = $db->prepare("SELECT userID FROM " . TABLE_USERS . " WHERE userID=%d", $userID);
        $userID = $db->getVar($query);
        if(!$userID){
            buckys_add_message(MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
            return false;
        }

        //Getting Old Moderator
        $query = $db->prepare("SELECT moderatorID, userID FROM " . TABLE_MODERATOR . " WHERE userID=%d", $userID);
        $oldModerator = $db->getRow($query);

        if($oldModerator){
            buckys_add_message(MSG_ALREADY_BE_MODERATOR, MSG_TYPE_NOTIFY);
            return false;
        }

        //Create New Moderator
        $mId = $db->insertFromArray(TABLE_MODERATOR, ['userID' => $userID, 'moderatorStatus' => 1, 'electedDate' => date('Y-m-d H:i:s')]);
        //Update user table        
        $db->update("UPDATE " . TABLE_USERS . " SET user_type='Moderator', user_acl_id='" . BuckysUserAcl::getIdFromName('Moderator') . "' WHERE userID='" . $userID . "' AND user_acl_id != '" . BuckysUserAcl::getIdFromName('Administrator') . "'");

        buckys_add_message(MSG_NEW_MODERATOR_ADDED);

        return true;
    }

    /**
     * Delete Moderator
     *
     * @param mixed $userID
     * @return bool
     */
    public static function deleteModerator($userID){
        global $db;

        //Getting Old Moderator
        $query = $db->prepare("SELECT moderatorID, userID FROM " . TABLE_MODERATOR . " WHERE userID=%d", $userID);
        $oldModerator = $db->getRow($query);

        if(!$oldModerator){
            buckys_add_message(MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
            return false;
        }

        //Remove Candidate
        $db->query("DELETE FROM " . TABLE_MODERATOR . " WHERE userID=" . $oldModerator['userID']);

        //Update User ACL
        //$db->query("UPDATE " . TABLE_USERS . " SET user_acl_id='" . USER_ACL_REGISTERED . "' WHERE userID=" . $oldModerator['userID']);
        $db->update("UPDATE " . TABLE_USERS . " SET user_type='Registered', user_acl_id='" . BuckysUserAcl::getIdFromName('Registered') . "' WHERE userID='" . $userID . "' AND user_acl_id != '" . BuckysUserAcl::getIdFromName('Administrator') . "'");

        buckys_add_message(MSG_MODERATOR_REMOVED);

        return true;
    }

    /**
     * Getting Candidate by ID
     *
     * @param Int $userID
     * @return array OR null
     */
    public static function getCandidate($userID){
        global $db;

        $query = $db->prepare("SELECT * FROM " . TABLE_MODERATOR_CANDIDATES . " WHERE userID=%d", $userID);
        $row = $db->getRow($query);

        return $row;
    }

    /**
     * @param $userID
     * @param $candidateID
     * @return bool
     */
    public static function deleteCandidate($userID, $candidateID){
        global $db;

        //Get the Candidate User ID        
        $query = $db->prepare("SELECT * FROM " . TABLE_MODERATOR_CANDIDATES . " WHERE candidateID=%d AND userID=%d", $candidateID, $userID);
        $candidateRow = $db->getRow($query);

        //If the candidate id is not correct,
        if(!$candidateRow){
            buckys_add_message(MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
            return false;
        }

        //Remove Candidate
        $db->query("DELETE FROM " . TABLE_MODERATOR_CANDIDATES . " WHERE candidateID=" . $candidateID);

        buckys_add_message(MSG_CANDIDATE_REMOVED);

        return true;
    }

    /**
     * @return bool
     */
    public static function resetVotes(){
        global $db;

        //Check user acl again
        if(!buckys_check_user_acl(USER_ACL_ADMINISTRATOR)){
            buckys_add_message(MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
            return false;
        }

        $db->query("DELETE FROM " . TABLE_MODERATOR_CANDIDATES);
        $db->query("DELETE FROM " . TABLE_MODERATOR_VOTES);

        return true;
    }
}    
