<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    echo MSG_INVALID_REQUEST;
    exit;
}

$notificationLimit = 5;

//This module will make the notifications as read.
$result = ['success' => 1, 'content' => ''];
$type = isset($_REQUEST['type']) ? strtolower($_REQUEST['type']) : null;

if(isset($_POST['action']) && $_POST['action'] == 'read'){
    switch($type){
        case 'my':
            BuckysActivity::markReadNotifications($userID);
            $notiData = BuckysActivity::getNotifications($userID, $notificationLimit, 0);
            $result['content'] = render_footer_link_content($type, $notiData, false);
            break;
        case 'forum':
            BuckysForumNotification::makeNotificationsToRead($userID);
            $notiData = BuckysForumNotification::getNewNotifications($userID, 0, $notificationLimit);
            $result['content'] = render_footer_link_content($type, $notiData, false);
            break;
        case 'trade':
            $tradeNotiIns = new BuckysTradeNotification();
            $tradeNotiIns->markAsRead($userID);
            $notiData = $tradeNotiIns->getReceivedMessages($userID, null, 0, $notificationLimit);
            $result['content'] = render_footer_link_content($type, $notiData, false);
            break;
        case 'shop':
            $shopNotiIns = new BuckysShopNotification();
            $shopNotiIns->markAsRead($userID);
            $notiData = $shopNotiIns->getReceivedMessages($userID, null, 0, $notificationLimit);
            $result['content'] = render_footer_link_content($type, $notiData, false);
            break;
    }
    echo json_encode($result);
    exit;
}

echo MSG_INVALID_REQUEST;
exit;