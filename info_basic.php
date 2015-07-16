<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//If the user is not logged in, redirect to the index page
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php');
}

//Getting UserData from Id
$userData = BuckysUser::getUserBasicInfo($userID);

//Goto Homepage if the userID is not correct
if(!buckys_not_null($userData)){
    buckys_redirect('/index.php');
}

if(isset($_POST['action']) && $_POST['action'] == 'save_basic_info'){

    //Check the user id is same with the current logged user id
    if($_POST['userID'] != $userID){
        echo 'Invalid Request!';
        exit;
    }

    //Check first name and last name
    if(trim($_POST['firstName']) == '' || trim($_POST['lastName']) == ''){
        echo MSG_USERNAME_EMPTY_ERROR;
        exit;
    }

    if(BuckysUser::saveUserBasicInfo($userID, $_POST)){
        echo 'Success';
        exit;
    }else{
        echo $db->last_query;
        echo $db->getLastError();
        exit;
    }
}

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('info.css');
buckys_enqueue_javascript('info.js');

$TNB_GLOBALS['content'] = 'info_basic';
$TNB_GLOBALS['title'] = "Basic Info - " . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
