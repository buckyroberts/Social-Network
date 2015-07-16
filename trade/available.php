<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

buckys_enqueue_stylesheet('trade.css');

buckys_enqueue_javascript('trade.js');

$TNB_GLOBALS['content'] = 'trade/available';
$TNB_GLOBALS['headerType'] = 'trade';

$paramCurrentPage = get_secure_integer($_REQUEST['page']);
$paramType = get_secure_string($_REQUEST['type']);

$view = [];

//Get available items
$tradeItemIns = new BuckysTradeItem();

$baseURL = '/trade/available.php';
if($paramType == 'expired'){
    $baseURL .= "?type=" . $paramType;
}else{
    $paramType = '';
}

switch($paramType){
    case 'expired':
        $view['pagetitle'] = 'My Expired Items';
        $view['items'] = $tradeItemIns->getItemList($userID, true, BuckysTradeItem::STATUS_ITEM_ACTIVE);
        $view['type'] = 'expired';
        break;
    case 'available':
    default:
        $view['items'] = $tradeItemIns->getItemList($userID, false, BuckysTradeItem::STATUS_ITEM_ACTIVE);
        $view['pagetitle'] = 'My Available Items';
        $view['type'] = 'available';
        break;
}

$view['items'] = fn_buckys_pagination($view['items'], $baseURL, $paramCurrentPage, COMMON_ROWS_PER_PAGE);

$view['type'] = $paramType;

$TNB_GLOBALS['title'] = $view['pagetitle'] . ' - BuckysRoomTrade';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
