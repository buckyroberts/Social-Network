<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
    buckys_redirect('/forum');
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;

//Getting Type
$listType = isset($_GET['type']) ? $_GET['type'] : 'all';
if(!in_array($listType, ['all', 'responded', 'started']))
    $listType = 'all';

$total = BuckysForumTopic::getTotalNumberOfMyPosts($TNB_GLOBALS['user']['userID'], $listType);

$pagination = new Pagination($total, BuckysForumTopic::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$topics = BuckysForumTopic::getMyPosts($TNB_GLOBALS['user']['userID'], $listType, $page, BuckysForumTopic::$COUNT_PER_PAGE);

//Mark Forum Notifications to read
BuckysForumNotification::makeNotificationsToRead($TNB_GLOBALS['user']['userID']);

buckys_enqueue_javascript('jquery-migrate-1.2.0.js');

buckys_enqueue_stylesheet('forum.css');
buckys_enqueue_stylesheet('publisher.css');

$TNB_GLOBALS['headerType'] = 'forum';
$TNB_GLOBALS['content'] = 'forum/myposts';
$TNB_GLOBALS['title'] = 'Recent Activity - thenewboston Forum';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");


