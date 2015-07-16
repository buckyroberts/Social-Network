<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//If the user is not logged in, redirect to the index page
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php');
}

if(isset($_POST['action']) && $_POST['action'] == 'change_password'){
    $isValid = true;
    if(!$_POST['userID'] || !$_POST['userIDHash'] || !buckys_check_id_encrypted($_POST['userID'], $_POST['userIDHash']) || $userID != $_POST['userID']){
        buckys_redirect("/index.php");
    }
    if(!$_POST['currentPassword'] || !$_POST['newPassword'] || !$_POST['newPassword2']){
        buckys_redirect("/change_password.php", MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        $isValid = false;
    }else if($_POST['newPassword'] != $_POST['newPassword2']){
        buckys_redirect("/change_password.php", MSG_NOT_MATCH_PASSWORD, MSG_TYPE_ERROR);
        $isValid = false;
    }else if(!buckys_check_password_strength($_POST['newPassword'])){
        buckys_redirect("/change_password.php", MSG_NEW_PASSWORD_STRENGTH_ERROR, MSG_TYPE_ERROR);
        $isValid = false;
    }

    //Check Current Password
    $data = BuckysUser::getUserData($userID);
    if(!$data)
        buckys_redirect("/index.php");

    if(!buckys_validate_password($_POST['currentPassword'], $data['password'])){
        buckys_redirect("/change_password.php", MSG_CURRENT_PASSWORD_NOT_CORRECT, MSG_TYPE_ERROR);
        $isValid = false;
    }
    if($isValid){
        $pwd = buckys_encrypt_password($_POST['newPassword']);
        BuckysUser::updateUserFields($userID, ['password' => $pwd]);
        buckys_redirect('/change_password.php', MSG_PASSWORD_UPDATED);
    }

}

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('info.css');

$TNB_GLOBALS['content'] = 'change_password';

$TNB_GLOBALS['title'] = "Change Password - " . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
