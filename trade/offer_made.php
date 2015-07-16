<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

buckys_enqueue_stylesheet('trade.css');

buckys_enqueue_javascript('trade.js');

$BUCKYS_GLOBALS['content'] = 'trade/offer_made';
$BUCKYS_GLOBALS['headerType'] = 'trade';

$paramCurrentPage = get_secure_integer($_REQUEST['page']);

$view = [];

//Get offer_received info
$tradeOfferIns = new BuckysTradeOffer();
$view['offers'] = $tradeOfferIns->getOfferMade($userID);
$view['offers'] = fn_buckys_pagination($view['offers'], '/trade/offer_made.php', $paramCurrentPage, COMMON_ROWS_PER_PAGE);

$BUCKYS_GLOBALS['title'] = 'Offers Made - BuckysRoomTrade';

require(DIR_FS_TEMPLATE . $BUCKYS_GLOBALS['template'] . "/" . $BUCKYS_GLOBALS['layout'] . ".php"); 
