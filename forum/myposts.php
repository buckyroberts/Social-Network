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

$total = BuckysForumTopic::getTotalNumberOfMyPosts($BUCKYS_GLOBALS['user']['userID'], $listType);

$pagination = new Pagination($total, BuckysForumTopic::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$topics = BuckysForumTopic::getMyPosts($BUCKYS_GLOBALS['user']['userID'], $listType, $page, BuckysForumTopic::$COUNT_PER_PAGE);

//Mark Forum Notifications to read
BuckysForumNotification::makeNotificationsToRead($BUCKYS_GLOBALS['user']['userID']);

buckys_enqueue_javascript('jquery-migrate-1.2.0.js');

buckys_enqueue_stylesheet('forum.css');
buckys_enqueue_stylesheet('publisher.css');

$BUCKYS_GLOBALS['headerType'] = 'forum';
$BUCKYS_GLOBALS['content'] = 'forum/myposts';
$BUCKYS_GLOBALS['title'] = 'Recent Activity - thenewboston Forum';

require(DIR_FS_TEMPLATE . $BUCKYS_GLOBALS['template'] . "/" . $BUCKYS_GLOBALS['layout'] . ".php");  


