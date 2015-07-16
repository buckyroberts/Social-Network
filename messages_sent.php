<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//If the user is not logged in, redirect to the index page
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php');
}

$userData = BuckysUser::getUserBasicInfo($userID);

if(isset($_GET['to']))
    $receiver = BuckysUser::getUserData($_GET['to']);

if(isset($_POST['action'])){
    //Check the user id is same with the current logged user id
    if($_POST['userID'] != $userID){
        echo 'Invalid Request!';
        exit;
    }

    //Save Address
    if($_POST['action'] == 'delete_messages'){
        if(!BuckysMessage::deleteMessages($_POST['messageID'])){
            buckys_redirect('/messages_sent.php', "Error: " . $db->getLastError(), MSG_TYPE_ERROR);
        }else{
            buckys_redirect('/messages_sent.php', MSG_MESSAGE_REMOVED, MSG_TYPE_SUCCESS);
        }
        exit;

    }

}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$totalCount = BuckysMessage::getTotalNumOfMessages($userID, 'sent');
//Init Pagination Class
$pagination = new Pagination($totalCount, BuckysMessage::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$messages = BuckysMessage::getSentMessages($userID, $page);

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('info.css');
buckys_enqueue_stylesheet('messages.css');

buckys_enqueue_javascript('jquery-ui.min.js');
buckys_enqueue_javascript('messages.js');

$TNB_GLOBALS['content'] = 'messages_sent';

$TNB_GLOBALS['title'] = "Sent Messages - " . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
