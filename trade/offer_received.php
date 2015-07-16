<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

buckys_enqueue_stylesheet('trade.css');

buckys_enqueue_javascript('trade.js');

$TNB_GLOBALS['content'] = 'trade/offer_received';
$TNB_GLOBALS['headerType'] = 'trade';

$paramCurrentPage = buckys_escape_query_integer($_REQUEST['page']);
$paramTargetID = buckys_escape_query_integer($_REQUEST['targetID']);

$view = [];

//Get offer_received info
$tradeOfferIns = new BuckysTradeOffer();
$view['offers'] = $tradeOfferIns->getOfferReceived($userID, $paramTargetID);
$view['offers'] = fn_buckys_pagination($view['offers'], '/trade/offer_received.php', $paramCurrentPage, COMMON_ROWS_PER_PAGE);

$TNB_GLOBALS['title'] = 'Offers Received - BuckysRoomTrade';

//Mark the activity (offer received) as read
$tradeNotificationIns = new BuckysTradeNotification();
$tradeNotificationIns->markAsRead($userID, BuckysTradeNotification::ACTION_TYPE_OFFER_RECEIVED);
$tradeOfferIns->markAsRead($userID, BuckysTradeOffer::STATUS_OFFER_ACTIVE);

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
