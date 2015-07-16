<?php
/**
 * The functions that check user acl
 */

/**
 * Check that the current user acl
 *
 * @param Int $acl
 * @return bool
 */
function buckys_check_user_acl($acl, $userID = null){
    global $TNB_GLOBALS, $db;

    if(!$userID){
        $userAcl = $TNB_GLOBALS['user']['aclLevel'];
    }else{
        $query = $db->prepare("SELECT UA.level FROM " . TABLE_USERS . " AS U LEFT JOIN " . TABLE_USER_ACL . " AS UA ON UA.aclID = U.user_acl_id WHERE userID=%d", $userID);
        $userAcl = $db->getVar($query);
    }

    if($userAcl >= $acl)
        return true;else
        return false;
}

/**
 * Check current user is admin

 */
function buckys_is_admin(){
    global $TNB_GLOBALS;

    if(buckys_check_user_acl(USER_ACL_ADMINISTRATOR))
        return true;

    return false;
}

/**
 * Check that the current user is forum moderator

 */
function buckys_is_moderator(){
    global $TNB_GLOBALS;

    if(!buckys_check_user_acl(USER_ACL_MODERATOR))
        return false;

    //If Administrator, return true    
    if(buckys_check_user_acl(USER_ACL_ADMINISTRATOR))
        return true;

    if(!BuckysModerator::isModerator($TNB_GLOBALS['user']['userID']))
        return false;

    return true;
}

/**
 * Check that the current user is Community moderator

 */
function buckys_is_community_moderator(){
    global $TNB_GLOBALS;

    if(!buckys_check_user_acl(USER_ACL_MODERATOR))
        return false;

    if(!BuckysModerator::isModerator($TNB_GLOBALS['user']['userID']))
        return false;

    return true;
}

/**
 * Check that the current user is trade moderator

 */
function buckys_is_trade_moderator(){
    global $TNB_GLOBALS;

    if(!buckys_check_user_acl(USER_ACL_MODERATOR))
        return false;

    if(!BuckysModerator::isModerator($TNB_GLOBALS['user']['userID']))
        return false;

    return true;
}

/**
 * Check the current user is the admin(creator) of the forum
 *
 * @param int $categoryID
 * @return Boolean
 */
function buckys_is_forum_admin($categoryID){
    global $db;

    if(!($userID = buckys_is_logged_in())){
        return false;
    }

    $category = BuckysForumCategory::getCategory($categoryID);

    if($category['creatorID'] != $userID){
        return false;
    }else{
        return true;
    }
}

/**
 * Check the current user is the moderator of the forum
 *
 * @param int $categoryID
 * @return Boolean
 */
function buckys_is_forum_moderator($categoryID){
    global $db;

    if(!($userID = buckys_is_logged_in())){
        return false;
    }

    if(BuckysForumModerator::isModerator($categoryID, $userID)){
        return true;
    }else{
        return false;
    }
}

