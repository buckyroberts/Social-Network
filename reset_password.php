<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
$userID = buckys_is_logged_in();

//If the parameter is null, goto homepage 
if($userID)
    buckys_redirect('/account.php');

$token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
if(!$token){
    buckys_redirect('/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

if(!($userID = BuckysUsersToken::checkTokenValidity($token, 'password'))){
    buckys_redirect('/register.php?forgotpwd=1', MSG_USER_TOKEN_LINK_NOT_CORRECT, MSG_TYPE_ERROR);
}

if(isset($_POST['action']) && $_POST['action'] == 'reset-password'){
    if(!$_POST['password'] || !$_POST['password']){
        buckys_add_message(MSG_EMPTY_PASSWORD, MSG_TYPE_ERROR);
    }else if($_POST['password'] != $_POST['password']){
        buckys_add_message(MSG_NOT_MATCH_PASSWORD, MSG_TYPE_ERROR);
    }else{
        $pwd = buckys_encrypt_password($_POST['password']);
        BuckysUser::updateUserFields($userID, ['password' => $pwd]);
        buckys_redirect('/index.php', MSG_PASSWORD_UPDATED);
    }

}

buckys_enqueue_stylesheet('register.css');

buckys_enqueue_javascript('register.js');

$TNB_GLOBALS['content'] = 'reset_password';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
