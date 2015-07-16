<?php

require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

$categoryID = null;
if(isset($_REQUEST['id'])){
    $categoryID = buckys_escape_query_integer($_REQUEST['id']);
    $category = BuckysForumCategory::getCategory($_REQUEST['id']);
}

$keyword = isset($_REQUEST['s']) ? buckys_escape_query_string($_GET['s']) : '';

$orderBy = isset($_GET['orderby']) ? buckys_escape_query_string($_GET['orderby']) : 'popular';

switch($orderBy){
    case 'recent':
        $orderByStr = ' c.createdDate DESC ';
        break;
    case 'popular':
    default:
        $orderByStr = ' c.followers DESC ';
        break;
}

$page = isset($_GET['page']) ? buckys_escape_query_integer($_GET['page']) : 1;

$results = BuckysForumCategory::searchCategories($keyword, $page, $orderByStr, BuckysForumCategory::$COUNT_PER_PAGE);

$pagination = new Pagination($results['total'], BuckysForumCategory::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

buckys_enqueue_stylesheet('sceditor/themes/default.css');
buckys_enqueue_stylesheet('forum.css');
buckys_enqueue_stylesheet('publisher.css');
buckys_enqueue_stylesheet('uploadify.css');

buckys_enqueue_javascript('sceditor/jquery.sceditor.bbcode.js');
buckys_enqueue_javascript('uploadify/jquery.uploadify.js');

$view['action_type'] = 'create';

$TNB_GLOBALS['headerType'] = 'forum';
$TNB_GLOBALS['content'] = 'forum/search_forums';
$TNB_GLOBALS['title'] = 'Search Forums - thenewboston Forum';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");