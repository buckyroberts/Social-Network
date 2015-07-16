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

//Get this user followed page info
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$pageFollowerIns = new BuckysPageFollower();
$totalCount = $pageFollowerIns->getPagesCountByFollowerID($profileID);

$pagination = new Pagination($totalCount, BuckysPageFollower::COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

//Get Pages
$view['pages'] = $pageFollowerIns->getPagesByFollowerID($profileID, $page, BuckysPageFollower::COUNT_PER_PAGE);
$view['profileID'] = $profileID;

//if logged user can see all resources of the current user
$canViewPrivate = $userID == $profileID || BuckysFriend::isFriend($userID, $profileID) || BuckysFriend::isSentFriendRequest($profileID, $userID);

buckys_enqueue_stylesheet('profile.css');
buckys_enqueue_stylesheet('friends.css');
buckys_enqueue_stylesheet('posting.css');
buckys_enqueue_stylesheet('publisher.css');

$TNB_GLOBALS['content'] = 'follows';

//Page title
$TNB_GLOBALS['title'] = trim($userData['firstName'] . ' ' . $userData['lastName']) . "'s Pages Followed - thenewboston";

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
