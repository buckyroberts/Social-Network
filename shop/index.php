<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

buckys_enqueue_stylesheet('shop.css');

buckys_enqueue_javascript('shop.js');

$BUCKYS_GLOBALS['content'] = 'shop/index';
$BUCKYS_GLOBALS['headerType'] = 'shop';

//Get Top Users
$shopProductIns = new BuckysShopProduct();
$catIns = new BuckysShopCategory();

$view = [];

$view['recent_products'] = $shopProductIns->getRecentProducts(10);
$view['categories'] = $catIns->getCategoryList(0);

$BUCKYS_GLOBALS['title'] = 'BuckysRoomShop - Buy and Sell Items with Bitcoin';

require(DIR_FS_TEMPLATE . $BUCKYS_GLOBALS['template'] . "/" . $BUCKYS_GLOBALS['layout'] . ".php"); 
