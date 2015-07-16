<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

buckys_enqueue_stylesheet('trade.css');

buckys_enqueue_javascript('trade.js');

$BUCKYS_GLOBALS['content'] = 'trade/index';
$BUCKYS_GLOBALS['headerType'] = 'trade';

//Get Top Users
$tradeUserIns = new BuckysTradeUser();
$tradeItemIns = new BuckysTradeItem();

$view = [];

$view['top_users'] = $tradeUserIns->getUsersTopByItems(10);
$view['top_wanted_items'] = $tradeItemIns->getItemsTopByOffers(10);
// $view['recent_items'] = $tradeItemIns->getRecentItems(10);

$BUCKYS_GLOBALS['title'] = 'BuckysRoomTrade - Trade, Swap, and Barter Online. Exchange Books, Clothes, Movies, and More!';

require(DIR_FS_TEMPLATE . $BUCKYS_GLOBALS['template'] . "/" . $BUCKYS_GLOBALS['layout'] . ".php"); 
