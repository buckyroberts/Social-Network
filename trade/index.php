<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

buckys_enqueue_stylesheet('trade.css');

buckys_enqueue_javascript('trade.js');

$TNB_GLOBALS['content'] = 'trade/index';
$TNB_GLOBALS['headerType'] = 'trade';

//Get Top Users
$tradeUserIns = new BuckysTradeUser();
$tradeItemIns = new BuckysTradeItem();

$view = [];

$view['top_users'] = $tradeUserIns->getUsersTopByItems(10);
$view['top_wanted_items'] = $tradeItemIns->getItemsTopByOffers(10);
// $view['recent_items'] = $tradeItemIns->getRecentItems(10);

$TNB_GLOBALS['title'] = 'BuckysRoomTrade - Trade, Swap, and Barter Online. Exchange Books, Clothes, Movies, and More!';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
