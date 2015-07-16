<?php
/**
 * Show All Top Images, Videos or Text
 */
require(dirname(__FILE__) . '/includes/bootstrap.php');

$userID = buckys_is_logged_in();

$type = isset($_GET['type']) ? strtolower($_GET['type']) : '';

//If the url param is not correct, go to index page
if(!$type || !in_array($type, ['image', 'text', 'video'])){
    buckys_redirect('/index.php');
}

//Perios = Today, This Week, This Month, All Time
$period = isset($_GET['period']) ? strtolower($_GET['period']) : 'all'; //Default all
if(!in_array($period, ['today', 'this-week', 'this-month', 'all'])){
    $period = 'all';
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$totalCount = BuckysPost::getNumberOfPosts($period, $type);

$pageLimit = "COUNT_PER_PAGE_" . strtoupper($type);

//Init Pagination Class
$pagination = new Pagination($totalCount, BuckysPost::$$pageLimit, $page);
$page = $pagination->getCurrentPage();

//Getting Results
$results = BuckysPost::getTopPosts($period, $type, $page, BuckysPost::$$pageLimit);

buckys_enqueue_stylesheet('index.css');

$TNB_GLOBALS['content'] = "tops";

$typeString = ['image' => 'Images ', 'video' => 'Videos ', 'text' => 'Posts '];
$periodString = ['today' => 'Today ', 'this-week' => 'This Week ', 'this-month' => 'This Month ', 'all' => ''];

//Page title
$TNB_GLOBALS['title'] = "Most Popular " . $typeString[$type] . $periodString[$period] . '- ' . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");


