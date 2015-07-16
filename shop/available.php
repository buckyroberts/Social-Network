<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

buckys_enqueue_javascript('shop.js');

buckys_enqueue_stylesheet('shop.css');

$TNB_GLOBALS['content'] = 'shop/available';
$TNB_GLOBALS['headerType'] = 'shop';

$paramCurrentPage = get_secure_integer($_REQUEST['page']);
$paramType = get_secure_string($_REQUEST['type']);

$view = [];

//Get available products
$shopProductIns = new BuckysShopProduct();

$baseURL = '/shop/available.php';
if($paramType == 'expired'){
    $baseURL .= "?type=" . $paramType;
}else{
    $paramType = '';
}

switch($paramType){
    case 'expired':
        $view['pagetitle'] = 'My Expired Items';
        $view['products'] = $shopProductIns->getProductList($userID, true, BuckysShopProduct::STATUS_ACTIVE);
        $view['type'] = 'expired';
        break;
    case 'available':
    default:
        $view['products'] = $shopProductIns->getProductList($userID, false, BuckysShopProduct::STATUS_ACTIVE);
        $view['pagetitle'] = 'My Items for Sale';
        $view['type'] = 'available';
        break;
}

$view['products'] = fn_buckys_pagination($view['products'], $baseURL, $paramCurrentPage, COMMON_ROWS_PER_PAGE);

$view['type'] = $paramType;

$TNB_GLOBALS['title'] = $view['pagetitle'] . ' - BuckysRoomShop';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
