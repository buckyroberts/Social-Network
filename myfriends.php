<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
if(!in_array($type, ['all', 'pending', 'requested']))
    $type = 'all';

if(isset($_REQUEST['action'])){
    $return = isset($_REQUEST['return']) ? base64_decode($_REQUEST['return']) : ('/myfriends.php?type=' . $type);

    $isAjax = isset($_REQUEST['buckys_ajax']) ? true : false;

    if($isAjax)
        header('Content-type: application/xml');

    $friendID = buckys_escape_query_integer($_REQUEST['friendID']);

    if(!buckys_check_form_token('request')){
        if($isAjax){
            $resultXML = ['status' => 'error', 'message' => MSG_INVALID_REQUEST,];
            render_result_xml($resultXML);

        }else{
            buckys_redirect($return, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }
        exit;
    }

    if($_REQUEST['action'] == 'unfriend'){
        if(BuckysFriend::unfriend($userID, $friendID)){
            if($isAjax){
                $resultXML = ['status' => 'success', 'message' => MSG_FRIEND_REMOVED, 'html' => 'Send Friend Request', 'action' => 'unfriend', 'link' => '/myfriends.php?action=request&friendID=' . $friendID . buckys_get_token_param()];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, MSG_FRIEND_REMOVED);
            }
        }else{
            if($isAjax){
                $resultXML = ['status' => 'error', 'message' => $db->getLastError(),];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, $db->getLastError(), MSG_TYPE_ERROR);
            }
        }
    }else if($_REQUEST['action'] == 'decline'){
        if(BuckysFriend::decline($userID, $friendID)){
            if($isAjax){
                $resultXML = ['status' => 'success', 'message' => MSG_FRIEND_REQUEST_DECLINED, 'html' => 'Send Friend Request', 'action' => 'decline-friend-request', 'link' => '/myfriends.php?action=request&friendID=' . $friendID . buckys_get_token_param()];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, MSG_FRIEND_REQUEST_DECLINED);
            }
        }else{
            if($isAjax){
                $resultXML = ['status' => 'error', 'message' => $db->getLastError(),];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, $db->getLastError(), MSG_TYPE_ERROR);
            }
        }
    }else if($_REQUEST['action'] == 'accept'){
        if(BuckysFriend::accept($userID, $friendID)){
            if($isAjax){
                $resultXML = ['status' => 'success', 'message' => MSG_FRIEND_REQUEST_APPROVED, 'html' => 'Unfriend', 'action' => 'accept-friend-request', 'link' => '/myfriends.php?action=unfriend&friendID=' . $friendID . buckys_get_token_param()];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, MSG_FRIEND_REQUEST_APPROVED);
            }
        }else{
            if($isAjax){
                $resultXML = ['status' => 'error', 'message' => $db->getLastError(),];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, $db->getLastError(), MSG_TYPE_ERROR);
            }
        }
    }else if($_REQUEST['action'] == 'delete'){
        if(BuckysFriend::delete($userID, $friendID)){
            if($isAjax){
                $resultXML = ['status' => 'success', 'message' => MSG_FRIEND_REQUEST_REMOVED, 'html' => 'Send Friend Request', 'action' => 'delete-friend-request', 'link' => '/myfriends.php?action=request&friendID=' . $friendID . buckys_get_token_param()];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, MSG_FRIEND_REQUEST_REMOVED);
            }
        }else{
            if($isAjax){
                $resultXML = ['status' => 'error', 'message' => $db->getLastError(),];
                render_result_xml($resultXML);
            }else{
                buckys_redirect($return, $db->getLastError(), MSG_TYPE_ERROR);
            }
        }
    }else if($_REQUEST['action'] == 'request'){
        if(!isset($friendID) || !BuckysUser::checkUserID($friendID)){
            if($isAjax){
                $resultXML = ['status' => 'error', 'message' => MSG_INVALID_REQUEST,];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
            }
            exit;
        }
        if(BuckysFriend::isFriend($userID, $friendID)){
            if($isAjax){
                $resultXML = ['status' => 'error', 'message' => MSG_INVALID_REQUEST,];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
            }
            exit;
        }
        if(BuckysFriend::isSentFriendRequest($userID, $friendID)){
            if($isAjax){
                $resultXML = ['status' => 'error', 'message' => MSG_FRIEND_REQUEST_ALREADY_SENT,];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, MSG_FRIEND_REQUEST_ALREADY_SENT, MSG_TYPE_ERROR);
            }
            exit;
        }
        if(BuckysFriend::isSentFriendRequest($friendID, $userID)){
            if($isAjax){
                $resultXML = ['status' => 'error', 'message' => MSG_FRIEND_REQUEST_ALREADY_RECEIVED,];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, MSG_FRIEND_REQUEST_ALREADY_RECEIVED, MSG_TYPE_ERROR);
            }
            exit;
        }

        if(!BuckysUsersDailyActivity::checkUserDailyLimit($userID, "friendRequests")){
            if($isAjax){
                $resultXML = ['status' => 'error', 'message' => sprintf(MSG_DAILY_FRIEND_REQUESTS_LIMIT_EXCEED_ERROR, USER_DAILY_LIMIT_FRIEND_REQUESTS),];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, sprintf(MSG_DAILY_FRIEND_REQUESTS_LIMIT_EXCEED_ERROR, USER_DAILY_LIMIT_FRIEND_REQUESTS), MSG_TYPE_ERROR);
            }
            exit;
        }

        if(BuckysFriend::sendFriendRequest($userID, $friendID)){
            if($isAjax){
                $resultXML = ['status' => 'success', 'message' => MSG_FRIEND_REQUEST_SENT, 'html' => 'Delete Friend Request', 'action' => 'send-friend-request', 'link' => '/myfriends.php?action=delete&friendID=' . $friendID . buckys_get_token_param()];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, MSG_FRIEND_REQUEST_SENT);
            }
        }else{
            if($isAjax){
                $resultXML = ['status' => 'error', 'message' => $db->getLastError(),];
                render_result_xml($resultXML);

            }else{
                buckys_redirect($return, $db->getLastError(), MSG_TYPE_ERROR);
            }
        }
    }
    exit;
}

//Getting UserData from Id
$userData = BuckysUser::getUserData($userID);

$page = isset($_GET['page']) ? $_GET['page'] : 1;

if($type == 'all'){
    $totalCount = BuckysFriend::getNumberOfFriends($userID);
}else if($type == 'pending'){
    $totalCount = BuckysFriend::getNumberOfPendingRequests($userID);
}else if($type == 'requested'){
    $totalCount = BuckysFriend::getNumberOfReceivedRequests($userID);
}

//Init Pagination Class
$pagination = new Pagination($totalCount, BuckysFriend::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

if($type == 'all'){
    $friends = BuckysFriend::getAllFriends($userID, $page, BuckysFriend::$COUNT_PER_PAGE);
}else if($type == 'pending'){
    $friends = BuckysFriend::getPendingRequests($userID, $page, BuckysFriend::$COUNT_PER_PAGE);
}else if($type == 'requested'){
    $friends = BuckysFriend::getReceivedRequests($userID, $page, BuckysFriend::$COUNT_PER_PAGE);
}

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('friends.css');

buckys_enqueue_javascript('friends.js');

$TNB_GLOBALS['content'] = 'myfriends';

$TNB_GLOBALS['title'] = "My Friends - " . TNB_SITE_NAME;

//if logged user can see all resources of the current user

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
