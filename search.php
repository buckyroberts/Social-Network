<?php

require(dirname(__FILE__) . '/includes/bootstrap.php');

buckys_enqueue_stylesheet('search.css');

buckys_enqueue_javascript('search.js');

$searchIns = new BuckysSearch();

$TNB_GLOBALS['content'] = 'search';
$TNB_GLOBALS['headerType'] = '';

$paramQueryStr = buckys_escape_query_string($_REQUEST['q']);
$paramType = buckys_escape_query_string($_REQUEST['type']);
$paramSort = buckys_escape_query_string($_REQUEST['sort']);

$view = [];

//Create Base URL for pagination of search page
$view['page_base_url'] = buckys_pp_search_url($paramQueryStr, $paramType, $paramSort, true);

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$totalCount = $searchIns->getNumberOfSearchResult($paramQueryStr, $paramType);

$pagination = new Pagination($totalCount, BuckysSearch::SEARCH_RESULT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

//Get Friends
$view['search_result'] = $searchIns->search($paramQueryStr, $paramType, $paramSort, $page);

//Display
$TNB_GLOBALS['searchParamPP']['q'] = $paramQueryStr;
$TNB_GLOBALS['searchParamPP']['type'] = $paramType;
$TNB_GLOBALS['searchParamPP']['sort'] = $paramSort;

if($paramQueryStr != ''){
    $TNB_GLOBALS['title'] = $paramQueryStr . ' - ' . TNB_SITE_NAME . ' Search';
}else{
    $TNB_GLOBALS['title'] = TNB_SITE_NAME . ' Search';
}

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
