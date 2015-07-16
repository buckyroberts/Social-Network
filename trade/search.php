<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

buckys_enqueue_stylesheet('trade.css');

buckys_enqueue_javascript('trade.js');

$BUCKYS_GLOBALS['content'] = 'trade/search';
$BUCKYS_GLOBALS['headerType'] = 'trade';

$paramCurrentPage = buckys_escape_query_integer(isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);
$paramQueryStr = buckys_escape_query_string(isset($_REQUEST['q']) ? $_REQUEST['q'] : '');
$paramCategory = buckys_escape_query_string(isset($_REQUEST['cat']) ? $_REQUEST['cat'] : null);
$paramLocation = buckys_escape_query_string(isset($_REQUEST['loc']) ? $_REQUEST['loc'] : null);
$paramSort = buckys_escape_query_string(isset($_REQUEST['sort']) ? $_REQUEST['sort'] : null);
$paramUserID = buckys_escape_query_integer(isset($_REQUEST['user']) ? $_REQUEST['user'] : null);

$view = [];

//Get available items
$tradeItemIns = new BuckysTradeItem();
$countryIns = new BuckysCountry();

$tradeCatIns = new BuckysTradeCategory();

$itemResultList = $tradeItemIns->search($paramQueryStr, $paramCategory, $paramLocation, $paramUserID);
$itemResultList = $tradeItemIns->sortItems($itemResultList, $paramSort);

$view['categoryList'] = $tradeItemIns->countItemInCategory($itemResultList);

//Create Base URL for pagination of search page
$paginationUrlBase = buckys_trade_search_url($paramQueryStr, $paramCategory, $paramLocation, $paramSort, $paramUserID);

//Display

$view['items'] = fn_buckys_pagination($itemResultList, $paginationUrlBase, $paramCurrentPage, COMMON_ROWS_PER_PAGE);

$view['param']['q'] = $paramQueryStr;
$view['param']['cat'] = $paramCategory;
$view['param']['loc'] = $paramLocation;
$view['param']['sort'] = $paramSort;
$view['param']['user'] = $paramUserID;

$BUCKYS_GLOBALS['tradeSearchParam'] = $view['param'];

$view['countryList'] = $countryIns->getCountryList();

if($paramQueryStr != ''){
    $BUCKYS_GLOBALS['title'] = $paramQueryStr . ' - BuckysRoomTrade Search';
}else if($paramCategory != ''){
    $BUCKYS_GLOBALS['title'] = $paramCategory . ' - BuckysRoomTrade Search';
}else if($paramUserID != '' && is_numeric($paramUserID)){

    $userIns = new BuckysUser();
    $userData = $userIns->getUserBasicInfo($paramUserID);
    if($userData){
        $BUCKYS_GLOBALS['title'] = trim($userData['firstName'] . ' ' . $userData['lastName']) . "'s Items - BuckysRoomTrade Search";
    }else{
        $BUCKYS_GLOBALS['title'] = 'BuckysRoomTrade Search';
    }

}else if($paramLocation != ''){
    $BUCKYS_GLOBALS['title'] = $paramLocation . ' - BuckysRoomTrade Search';
}else{
    $BUCKYS_GLOBALS['title'] = 'BuckysRoomTrade Search';
}

require(DIR_FS_TEMPLATE . $BUCKYS_GLOBALS['template'] . "/" . $BUCKYS_GLOBALS['layout'] . ".php");
