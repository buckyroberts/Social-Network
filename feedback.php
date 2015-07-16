<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

buckys_enqueue_stylesheet('trade.css');

buckys_enqueue_javascript('trade.js');

$TNB_GLOBALS['content'] = 'feedback';
//$TNB_GLOBALS['headerType'] = 'trade';

$paramCurrentPage = get_secure_integer($_REQUEST['page']);
$paramType = get_secure_string($_REQUEST['type']);
$userID = get_secure_integer($_REQUEST['user']);

$userIns = new BuckysUser();

if($userID == ''){
    if(!($userID = buckys_is_logged_in())){
        buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
    }
}else if(!is_numeric($userID)){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}else{
    $userData = $userIns->getUserData($userID);
    if($userData['status'] != BuckysUser::STATUS_USER_ACTIVE){
        buckys_redirect('/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }
}

//Calc base URL
$baseURLParts = [];
if($paramType == 'given'){
    $baseURLParts [] = "type=" . $paramType;
}else{
    $paramType = 'received';
}

if($userID != buckys_is_logged_in()){
    $baseURLParts [] = "user=" . $userID;
}

$baseURL = '/feedback.php';
if(count($baseURLParts) > 0)
    $baseURL .= '?' . implode('&', $baseURLParts);

$view = [];
$feedbackIns = new BuckysFeedback();

$view['feedback'] = $feedbackIns->getFeedbackByUserID($userID, $paramType);

$view['feedback'] = fn_buckys_pagination($view['feedback'], $baseURL, $paramCurrentPage, COMMON_ROWS_PER_PAGE);
$view['myID'] = $userID;
$view['type'] = $paramType;
$view['myRatingInfo'] = $feedbackIns->getUserRating($userID);

$userData = $userIns->getUserBasicInfo($userID);
if($userData){
    if($paramType == 'given'){
        $TNB_GLOBALS['title'] = trim($userData['firstName'] . ' ' . $userData['lastName']) . "'s Feedback Given - " . TNB_SITE_NAME;
    }else{
        $TNB_GLOBALS['title'] = trim($userData['firstName'] . ' ' . $userData['lastName']) . "'s Feedback Received- " . TNB_SITE_NAME;

        //Mark the activity (offer received) as read
        $tradeNotificationIns = new BuckysTradeNotification();
        $tradeNotificationIns->markAsRead($userID, BuckysTradeNotification::ACTION_TYPE_FEEDBACK);

    }

}else{
    $TNB_GLOBALS['title'] = 'Feedback - ' . TNB_SITE_NAME;
}

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
