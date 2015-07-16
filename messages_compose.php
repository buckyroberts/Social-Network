<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//If the user is not logged in, redirect to the index page
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php');
}

if(isset($_GET['to']))
    $receiver = BuckysUser::getUserData($_GET['to']);

if(isset($_GET['reply']))
    $replyTo = BuckysMessage::getMessage($_GET['reply']);

if(isset($_POST['action'])){

    //Check the user id is same with the current logged user id
    if($_POST['userID'] != $userID){
        echo 'Invalid Request!';
        exit;
    }

    //Save Address
    if($_POST['action'] == 'compose_message'){
        //Show Results
        header('Content-type: application/xml');
        if(!BuckysMessage::composeMessage($_POST)){
            render_result_xml(['status' => 'error', 'message' => buckys_get_messages()]);
        }else{
            render_result_xml(['status' => 'success', 'message' => buckys_get_messages()]);
        }
        exit;
    }

}

buckys_enqueue_stylesheet('jquery-ui/jquery-ui.css');
buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('info.css');
buckys_enqueue_stylesheet('messages.css');

buckys_enqueue_javascript('jquery-ui.min.js');
buckys_enqueue_javascript('messages.js');

$BUCKYS_GLOBALS['content'] = 'messages_compose';

$BUCKYS_GLOBALS['title'] = "Compose Message - " . BUCKYSROOM_SITE_NAME;

require(DIR_FS_TEMPLATE . $BUCKYS_GLOBALS['template'] . "/" . $BUCKYS_GLOBALS['layout'] . ".php");  
