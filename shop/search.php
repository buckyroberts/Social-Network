<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

buckys_enqueue_stylesheet('shop.css');

buckys_enqueue_javascript('shop.js');

$TNB_GLOBALS['content'] = 'shop/search';
$TNB_GLOBALS['headerType'] = 'shop';

$paramCurrentPage = buckys_escape_query_string($_REQUEST['page']);
$paramQueryStr = buckys_escape_query_string($_REQUEST['q'], true);
$paramCategory = buckys_escape_query_string($_REQUEST['cat'], true);
$paramLocation = buckys_escape_query_string($_REQUEST['loc'], true);
$paramSort = buckys_escape_query_string($_REQUEST['sort']);
$paramUserID = buckys_escape_query_string($_REQUEST['user']);

$view = [];

//Get available products
$shopProductIns = new BuckysShopProduct();
$countryIns = new BuckysCountry();

$productResultList = $shopProductIns->search($paramQueryStr, $paramCategory, $paramLocation, $paramUserID);
$productResultList = $shopProductIns->sortProducts($productResultList, $paramSort);

$view['categoryList'] = $shopProductIns->countProductInCategory($productResultList);

//Create Base URL for pagination of search page
$paginationUrlBase = buckys_shop_search_url($paramQueryStr, $paramCategory, $paramLocation, $paramSort, $paramUserID);

//Display

$view['products'] = fn_buckys_pagination($productResultList, $paginationUrlBase, $paramCurrentPage, COMMON_ROWS_PER_PAGE);

$view['param']['q'] = $paramQueryStr;
$view['param']['cat'] = $paramCategory;
$view['param']['loc'] = $paramLocation;
$view['param']['sort'] = $paramSort;
$view['param']['user'] = $paramUserID;

$TNB_GLOBALS['shopSearchParam'] = $view['param'];

$view['countryList'] = $countryIns->getCountryList();

if($paramQueryStr != ''){
    $TNB_GLOBALS['title'] = $paramQueryStr . ' - BuckysRoomShop Search';
}else if($paramCategory != ''){
    $TNB_GLOBALS['title'] = $paramCategory . ' - BuckysRoomShop Search';
}else if($paramUserID != '' && is_numeric($paramUserID)){

    $userIns = new BuckysUser();
    $userData = $userIns->getUserBasicInfo($paramUserID);
    if($userData){
        $TNB_GLOBALS['title'] = trim($userData['firstName'] . ' ' . $userData['lastName']) . "'s Items - BuckysRoomShop Search";
    }else{
        $TNB_GLOBALS['title'] = 'BuckysRoomShop Search';
    }

}else if($paramLocation != ''){
    $TNB_GLOBALS['title'] = $paramLocation . ' - BuckysRoomShop Search';
}else{
    $TNB_GLOBALS['title'] = 'BuckysRoomShop Search';
}

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
