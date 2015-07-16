<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

buckys_enqueue_stylesheet('trade.css');
buckys_enqueue_javascript('trade.js');

$TNB_GLOBALS['content'] = 'trade/notify';
$TNB_GLOBALS['headerType'] = 'trade';

$view = [];

//Save Shipping info
$tradeUserIns = new BuckysTradeUser();

if($_POST['action'] == 'saveNotifyInfo'){

    $paramData = ['optOfferReceived' => isset($_POST['optOfferReceived']) ? 1 : 0, 'optOfferAccepted' => isset($_POST['optOfferAccepted']) ? 1 : 0, 'optOfferDeclined' => isset($_POST['optOfferDeclined']) ? 1 : 0, 'optFeedbackReceived' => isset($_POST['optFeedbackReceived']) ? 1 : 0,];

    $retVal = $tradeUserIns->updateTradeUser($userID, $paramData);

    $view['status'] = ['success' => true, 'message' => 'Your shipping info has been updated successfully.'];

}

//Get offer_received info

$view['trade_user_info'] = $tradeUserIns->getUserByID($userID);

if(empty($view['trade_user_info'])){
    buckys_redirect('/trade/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

$TNB_GLOBALS['title'] = 'Notification Settings - BuckysRoomTrade';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
