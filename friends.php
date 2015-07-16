<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
$userID = buckys_is_logged_in();

//Getting User ID from Parameter
$profileID = isset($_GET['user']) ? intval($_GET['user']) : 0;

//If the parameter is null, goto homepage 
if(!$profileID)
    buckys_redirect('/index.php');

//Getting UserData from Id
$userData = BuckysUser::getUserData($profileID);

//Goto Homepage if the userID is not correct
if(!buckys_not_null($userData) || !BuckysUser::checkUserID($profileID, true)){
    buckys_redirect('/index.php');
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$totalCount = BuckysFriend::getNumberOfFriends($profileID);

$pagination = new Pagination($totalCount, BuckysFriend::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

//Get Friends
$friends = BuckysFriend::getAllFriends($profileID, $page, BuckysFriend::$COUNT_PER_PAGE);

buckys_enqueue_stylesheet('profile.css');
buckys_enqueue_stylesheet('posting.css');
buckys_enqueue_stylesheet('friends.css');
buckys_enqueue_stylesheet('publisher.css');

$TNB_GLOBALS['content'] = 'friends';

if($userData){
    $TNB_GLOBALS['title'] = trim($userData['firstName'] . ' ' . $userData['lastName']) . "'s Friends - " . TNB_SITE_NAME;
}

//if logged user can see all resources of the current user

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
