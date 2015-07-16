<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

buckys_enqueue_stylesheet('trade.css');

buckys_enqueue_javascript('trade.js');

$TNB_GLOBALS['content'] = 'trade/traded';
$TNB_GLOBALS['headerType'] = 'trade';

$paramCurrentPage = buckys_escape_query_integer($_REQUEST['page']);
$paramType = buckys_escape_query_string($_REQUEST['type']);

$view = [];

$baseURL = '/trade/traded.php';
if($paramType == 'history'){
    $baseURL .= '?type=' . $paramType;
}else{
    $paramType = 'completed';
}

//Get offer_received info
$tradeIns = new BuckysTrade();
$countryIns = new BuckysCountry();
$view['trades'] = $tradeIns->getTradesByUserID($userID, $paramType);
$view['trades'] = fn_buckys_pagination($view['trades'], $baseURL, $paramCurrentPage, COMMON_ROWS_PER_PAGE);

$view['myID'] = $userID;

switch($paramType){
    case 'history':
        $view['pagetitle'] = 'My Trade History';

        break;
    case 'completed':
    default:
        $view['pagetitle'] = 'My Completed Trades';

        //Mark the activity (offer received) as read
        $tradeNotificationIns = new BuckysTradeNotification();
        $tradeNotificationIns->markAsRead($userID, BuckysTradeNotification::ACTION_TYPE_OFFER_ACCEPTED);

        break;
}

$TNB_GLOBALS['title'] = $view['pagetitle'] . ' - BuckysRoomTrade';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
