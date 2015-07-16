<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

buckys_enqueue_stylesheet('shop.css');

buckys_enqueue_javascript('shop.js');

$TNB_GLOBALS['content'] = 'shop/index';
$TNB_GLOBALS['headerType'] = 'shop';

//Get Top Users
$shopProductIns = new BuckysShopProduct();
$catIns = new BuckysShopCategory();

$view = [];

$view['recent_products'] = $shopProductIns->getRecentProducts(10);
$view['categories'] = $catIns->getCategoryList(0);

$TNB_GLOBALS['title'] = 'BuckysRoomShop - Buy and Sell Items with Bitcoin';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
