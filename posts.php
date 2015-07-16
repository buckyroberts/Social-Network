<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
$userID = buckys_is_logged_in();

//Getting User ID from Parameter
$profileID = get_secure_integer($_GET['user']);
$postID = buckys_escape_query_integer(isset($_GET['post']) ? $_GET['post'] : null);

//If the parameter is null, goto homepage
if(!$profileID)
    buckys_redirect('/index.php');

//Getting UserData from Id
$userData = BuckysUser::getUserData($profileID);

//Goto Homepage if the userID is not correct
if(!buckys_not_null($userData) || !BuckysUser::checkUserID($profileID, true)){
    buckys_redirect('/index.php');
}

$postType = isset($_GET['type']) ? $_GET['type'] : 'all';
if(!in_array($postType, ['all', 'user', 'friends'])){
    $postType = 'all';
}

//if logged user can see all resources of the current user
$canViewPrivate = $userID == $profileID || BuckysFriend::isFriend($userID, $profileID) || BuckysFriend::isSentFriendRequest($profileID, $userID);

$posts = BuckysPost::getPostsByUserID($profileID, $userID, BuckysPost::INDEPENDENT_POST_PAGE_ID, $canViewPrivate, $postID, null, $postType);

/*if( !buckys_not_null($posts) )
{
    //Goto Index Page
    buckys_redirect('/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}*/

//Mark the notifications to read
if($postID)
    BuckysActivity::markReadNotifications($userID, $postID);

buckys_enqueue_stylesheet('profile.css');
buckys_enqueue_stylesheet('posting.css');
buckys_enqueue_stylesheet('uploadify.css');
buckys_enqueue_stylesheet('jquery.Jcrop.css');
buckys_enqueue_stylesheet('publisher.css');

buckys_enqueue_javascript('uploadify/jquery.uploadify.js');
buckys_enqueue_javascript('jquery.Jcrop.js');

buckys_enqueue_javascript('posts.js');

$TNB_GLOBALS['content'] = 'posts';

if($userData){
    $TNB_GLOBALS['title'] = trim($userData['firstName'] . ' ' . $userData['lastName']) . "'s Posts - " . TNB_SITE_NAME;
}

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
