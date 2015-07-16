<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
$userID = buckys_is_logged_in();

$pageIns = new BuckysPage();
$pageFollowerIns = new BuckysPageFollower();
$paramPageID = isset($_GET['pid']) ? intval($_GET['pid']) : null;

$pageData = $pageIns->getPageByID($paramPageID);

//If the parameter is null, goto homepage 
if(!buckys_not_null($pageData))
	buckys_redirect('/index.php');

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$totalCount = $pageFollowerIns->getNumberOfFollowers($pageData['pageID']);;

$pagination = new Pagination($totalCount, BuckysPageFollower::COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

//Get Friends
$view['followers'] = $pageFollowerIns->getFollowers($pageData['pageID'], $page, BuckysPageFollower::COUNT_PER_PAGE);
$view['pageData'] = $pageData;

buckys_enqueue_stylesheet('profile.css');
buckys_enqueue_stylesheet('friends.css');

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('stream.css');
buckys_enqueue_stylesheet('posting.css');
buckys_enqueue_stylesheet('uploadify.css');
buckys_enqueue_stylesheet('jquery.Jcrop.css');
buckys_enqueue_stylesheet('page.css');

buckys_enqueue_javascript('uploadify/jquery.uploadify.js');
buckys_enqueue_javascript('jquery.Jcrop.js');
buckys_enqueue_javascript('jquery.color.js');

buckys_enqueue_javascript('posts.js');
buckys_enqueue_javascript('add_post.js');
buckys_enqueue_javascript('page.js');
buckys_enqueue_stylesheet('publisher.css');

$TNB_GLOBALS['content'] = 'followers';

$TNB_GLOBALS['title'] = trim($pageData['title']) . " Members - " . TNB_SITE_NAME;

//if logged user can see all resources of the current user

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
