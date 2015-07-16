<?php

require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
$userID = buckys_is_logged_in();

//Process Some Actions
if(isset($_GET['action']) && $_GET['action'] == 'ban-user'){
    if(!BuckysModerator::isModerator($userID)){
        die(MSG_PERMISSION_DENIED);
    }

    if(!isset($_GET['userID']) || !BuckysUser::checkUserID($userID)){
        buckys_redirect('/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }

    //Ban User
    BuckysBanUser::banUser($_GET['userID']);
    buckys_redirect('/index.php', MSG_BAN_USER);
    exit;
}

//Getting User ID from Parameter
$profileID = buckys_escape_query_integer(isset($_GET['user']) ? $_GET['user'] : null);

//If the parameter is null, goto homepage 
if(!$profileID)
    buckys_redirect('/index.php');

//Getting UserData from Id
$userData = BuckysUser::getUserData($profileID);

//Goto Homepage if the userID is not correct
if(!buckys_not_null($userData) || (!BuckysUser::checkUserID($profileID, true) && !buckys_check_user_acl(USER_ACL_ADMINISTRATOR))){
    buckys_redirect('/index.php');
}

$postType = isset($_GET['type']) ? $_GET['type'] : 'all';
if(!in_array($postType, ['all', 'user', 'friends'])){
    $postType = 'all';
}

//if logged user can see all resources of the current user
$canViewPrivate = $userID == $profileID || BuckysFriend::isFriend($userID, $profileID) || BuckysFriend::isSentFriendRequest($profileID, $userID);

$friends = BuckysFriend::getAllFriends($profileID, 1, 18, true);
$totalFriendsCount = BuckysFriend::getNumberOfFriends($profileID);

$posts = BuckysPost::getPostsByUserID($profileID, $userID, BuckysPost::INDEPENDENT_POST_PAGE_ID, $canViewPrivate, isset($_GET['post']) ? $_GET['post'] : null, null, $postType);

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('profile.css');
buckys_enqueue_stylesheet('posting.css');
buckys_enqueue_stylesheet('publisher.css');
buckys_enqueue_stylesheet('uploadify.css');
buckys_enqueue_stylesheet('jquery.Jcrop.css');

buckys_enqueue_javascript('uploadify/jquery.uploadify.js');
buckys_enqueue_javascript('jquery.Jcrop.js');
buckys_enqueue_javascript('jquery.color.js');

buckys_enqueue_javascript('posts.js');
buckys_enqueue_javascript('add_post.js');
buckys_enqueue_javascript('account.js');

$TNB_GLOBALS['content'] = 'profile';

//Page title
$TNB_GLOBALS['title'] = $userData['firstName'] . ' ' . $userData['lastName'] . ' - ' . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
