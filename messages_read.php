<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//If the user is not logged in, redirect to the index page
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php');
}

$userData = BuckysUser::getUserBasicInfo($userID);

if(isset($_POST['action'])){
    //Check the user id is same with the current logged user id
    if($_POST['userID'] != $userID){
        echo 'Invalid Request!';
        exit;
    }
    //Delete Message
    if($_POST['action'] == 'delete_message'){
        if(!BuckysMessage::deleteMessages($_POST['messageID'])){
            buckys_redirect('/messages_inbox.php', "Error: " . $db->getLastError(), MSG_TYPE_ERROR);
        }else{
            buckys_redirect('/messages_inbox.php', MSG_MESSAGE_REMOVED, MSG_TYPE_SUCCESS);
        }
        exit;
    }

    //Delete Message Foreer
    if($_POST['action'] == 'delete_forever'){
        if(!BuckysMessage::deleteMessagesForever($_POST['messageID'])){
            buckys_redirect('/messages_inbox.php', "Error: " . $db->getLastError(), MSG_TYPE_ERROR);
        }else{
            buckys_redirect('/messages_inbox.php', MSG_MESSAGE_REMOVED, MSG_TYPE_SUCCESS);
        }
        exit;
    }

}

$messageID = buckys_escape_query_integer(isset($_GET['message']) ? $_GET['message'] : null);

if(!$messageID){
    buckys_redirect('/messages_inbox.php');
}

$message = BuckysMessage::getMessage($messageID);

//If the current user is morderator and this message has been reported
if(!$message && buckys_check_user_acl(USER_ACL_MODERATOR) && BuckysReport::isReported($messageID, 'message')){
    //Getting Message
    $message = BuckysMessage::getMessageById($messageID);

    $msgType = 'reported';
}

if(!$message){
    buckys_redirect('/messages_inbox.php');
}

if(!isset($msgType)){
    //Make Message as read
    BuckysMessage::changeMessageStatus($message['messageID'], 'read');

    //Getting Next Message ID and Prev Message ID
    if($message['is_trash'] == 1){
        $msgType = 'trash';
    }else if($message['receiver'] == $userID){
        $msgType = 'inbox';
    }else if($message['sender'] == $userID){
        $msgType = 'sent';
    }

    $nextID = BuckysMessage::getNextID($userID, $message['messageID'], $msgType);
    $prevID = BuckysMessage::getPrevID($userID, $message['messageID'], $msgType);
}
buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('info.css');
buckys_enqueue_stylesheet('messages.css');

buckys_enqueue_javascript('messages.js');

$TNB_GLOBALS['content'] = 'messages_read';

$TNB_GLOBALS['title'] = "Read Message - " . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
