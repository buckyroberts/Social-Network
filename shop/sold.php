<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

buckys_enqueue_stylesheet('shop.css');
buckys_enqueue_javascript('shop.js');

$TNB_GLOBALS['content'] = 'shop/sold';
$TNB_GLOBALS['headerType'] = 'shop';

//Update sold notification as read
$notificationIns = new BuckysShopNotification();
$notificationIns->markAsRead($userID, BuckysShopNotification::ACTION_TYPE_PRODUCT_SOLD);

$paramCurrentPage = get_secure_integer(isset($_REQUEST['page']) ? $_REQUEST['page'] : null);
$paramType = get_secure_string(isset($_REQUEST['type']) ? $_REQUEST['type'] : "");

$view = [];
$orderIns = new BuckysShopOrder();

$view['sold'] = $orderIns->getSold($userID);

//Update Sold product as read
$orderIns->updateSoldAsRead($userID);

$view['sold'] = fn_buckys_pagination($view['sold'], '/shop/sold.php', $paramCurrentPage, COMMON_ROWS_PER_PAGE);

$TNB_GLOBALS['title'] = 'My Sold Items - BuckysRoomShop';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
