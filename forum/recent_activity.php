<?php
require_once(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

//Getting Topics by category id
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$total = BuckysForumTopic::getTotalNumOfTopics('publish');

$pagination = new Pagination($total, BuckysForumTopic::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$topics = BuckysForumTopic::getTopics($page, 'publish', null, 'lastReplyDate DESC, t.createdDate DESC', BuckysForumTopic::$COUNT_PER_PAGE);

buckys_enqueue_javascript('jquery-migrate-1.2.0.js');

buckys_enqueue_stylesheet('forum.css');
buckys_enqueue_stylesheet('publisher.css');

$BUCKYS_GLOBALS['headerType'] = 'forum';
$BUCKYS_GLOBALS['content'] = 'forum/recent_activity';
$BUCKYS_GLOBALS['title'] = 'Recent Activity - thenewboston Forum';

require(DIR_FS_TEMPLATE . $BUCKYS_GLOBALS['template'] . "/" . $BUCKYS_GLOBALS['layout'] . ".php");  


