<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

$view = [];

//Save Shipping info
$tradeUserIns = new BuckysTradeUser();

if(isset($_POST['action']) && $_POST['action'] == 'saveNotifyInfo'){
    $result = BuckysUser::saveUserNotificationSettings($userID, $_POST);
    if($result === true)
        buckys_redirect('/notify.php', MSG_NOTIFICATION_SETTINGS_SAVED);else
        buckys_redirect('/notify.php', $result, MSG_TYPE_ERROR);
}
//Get offer_received info

$view['trade_user_info'] = $tradeUserIns->getUserByID($userID);

$userNotifyInfo = BuckysUser::getUserNotificationSettings($userID);

if(empty($view['trade_user_info'])){
    buckys_redirect('/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('info.css');

$TNB_GLOBALS['content'] = 'notify';
$TNB_GLOBALS['title'] = 'Notification Settings - ' . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
