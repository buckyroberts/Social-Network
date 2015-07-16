<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

buckys_enqueue_stylesheet('trade.css');

buckys_enqueue_javascript('trade.js');

$TNB_GLOBALS['content'] = 'trade/offer_declined';
$TNB_GLOBALS['headerType'] = 'trade';

$paramCurrentPage = get_secure_integer($_REQUEST['page']);
$paramType = get_secure_string($_REQUEST['type']); // default 'bythem' or empty, another possible value is 'byme'

$view = [];

//Get offer_received info
$tradeOfferIns = new BuckysTradeOffer();

$baseURL = '/trade/offer_declined.php';

if($paramType == 'byme'){
    $view['offers'] = $tradeOfferIns->getOfferDeclined($userID, false);
    $baseURL .= "?type=byme";
}else{
    $paramType = '';
    $view['offers'] = $tradeOfferIns->getOfferDeclined($userID, true);
}

$view['offers'] = fn_buckys_pagination($view['offers'], $baseURL, $paramCurrentPage, COMMON_ROWS_PER_PAGE);

$view['type'] = $paramType;

$TNB_GLOBALS['title'] = 'Offers Declined - BuckysRoomTrade';

//Mark the activity (offer received) as read
$tradeNotificationIns = new BuckysTradeNotification();
$tradeNotificationIns->markAsRead($userID, BuckysTradeNotification::ACTION_TYPE_OFFER_DECLINED);

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
