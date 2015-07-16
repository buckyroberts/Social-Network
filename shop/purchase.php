<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

buckys_enqueue_stylesheet('shop.css');

buckys_enqueue_javascript('shop.js');

$TNB_GLOBALS['content'] = 'shop/purchase';
$TNB_GLOBALS['headerType'] = 'shop';

$paramCurrentPage = get_secure_integer($_REQUEST['page']);
$paramType = get_secure_string($_REQUEST['type']);

$view = [];
$orderIns = new BuckysShopOrder();
$view['purchase'] = null;
$view['type'] = null;

if($paramType == 'archived'){

    //Purchases archived
    $view['subtitle'] = 'My Purchases Archived';
    $view['purchase'] = $orderIns->getPurchased($userID, BuckysShopOrder::ORDER_ARCHIVED);
    $view['type'] = 'archived';
}else{

    //Purchases not archived
    $view['subtitle'] = 'My Recent Purchases';
    $view['purchase'] = $orderIns->getPurchased($userID);

}

$view['purchase'] = fn_buckys_pagination($view['purchase'], '/shop/purchase.php', $paramCurrentPage, COMMON_ROWS_PER_PAGE);

$TNB_GLOBALS['title'] = $view['subtitle'] . ' - BuckysRoomShop';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
