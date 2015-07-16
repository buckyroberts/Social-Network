<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

if(isset($_POST['login_submit'])){
    if(BuckysTracker::getLoginAttemps() >= MAX_LOGIN_ATTEMPT){
        buckys_redirect('/register.php', MSG_EXCEED_MAX_LOGIN_ATTEMPS, MSG_TYPE_ERROR);
    }

    BuckysTracker::addTrack('login');

    $returnUrl = isset($_POST['return']) ? $_POST['return'] : null;

    //E-mail    
    if(!trim($_POST['email'])){
        $loginError = 1;
        buckys_redirect('/register.php' . ($returnUrl ? "?return=$returnUrl" : ""), MSG_EMPTY_EMAIL, MSG_TYPE_ERROR);
    }else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])){
        buckys_redirect('/register.php' . ($returnUrl ? "?return=$returnUrl" : ""), MSG_INVALID_EMAIL, MSG_TYPE_ERROR);
    }

    //Password
    if(empty($_POST['password'])){
        buckys_redirect('/register.php', MSG_EMPTY_PASSWORD, MSG_TYPE_ERROR);
    }
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $info = buckys_get_user_by_email($email);
    if(buckys_not_null($info)){
        if(!buckys_validate_password($password, $info['password'])) //Password Incorrect
        {
            buckys_redirect('/register.php' . ($returnUrl ? "?return=$returnUrl" : ""), MSG_INVALID_LOGIN_INFO, MSG_TYPE_ERROR);
        }else if($info['status'] == 0){ //Account Not Verified or Banned            
            buckys_redirect('/index.php', !$info['token'] ? MSG_ACCOUNT_BANNED : MSG_ACCOUNT_NOT_VERIFIED, MSG_TYPE_ERROR);
        }else{ //Login Success            
            //Clear Login Attempts
            BuckysTracker::clearLoginAttemps();

            //Restart Session
            session_regenerate_id(true);

            $_SESSION['userID'] = $info['userID'];

            //Init Some Session Values
            $_SESSION['converation_list'] = [];

            //Create Login Cookie Token
            $login_token = hash('sha256', time() . buckys_generate_random_string(20, true) . time());

            $login_token_secure = md5($login_token);

            //Store Login Token
            BuckysUsersToken::removeUserToken($info['userID'], "auth");
            BuckysUsersToken::createNewToken($info['userID'], "auth", $login_token_secure);

            //Slice the login token to three pieces
            $login_token_piece1 = substr($login_token, 0, 20);
            $login_token_piece2 = substr($login_token, 20, 20);
            $login_token_piece3 = substr($login_token, 40);

            //If website is using SSL, use secure cookies
            if(SITE_USING_SSL == true){
                setcookie('COOKIE_KEEP_ME_NAME1', base64_encode($login_token_piece1), time() + COOKIE_LIFETIME, "/", TNB_DOMAIN, true, true);
                setcookie('COOKIE_KEEP_ME_NAME2', base64_encode($login_token_piece3), time() + COOKIE_LIFETIME, "/", TNB_DOMAIN, true, true);
                setcookie('COOKIE_KEEP_ME_NAME3', base64_encode($login_token_piece2), time() + COOKIE_LIFETIME, "/", TNB_DOMAIN, true, true);
            }else{
                setcookie('COOKIE_KEEP_ME_NAME1', base64_encode($login_token_piece1), time() + COOKIE_LIFETIME, "/", TNB_DOMAIN);
                setcookie('COOKIE_KEEP_ME_NAME2', base64_encode($login_token_piece3), time() + COOKIE_LIFETIME, "/", TNB_DOMAIN);
                setcookie('COOKIE_KEEP_ME_NAME3', base64_encode($login_token_piece2), time() + COOKIE_LIFETIME, "/", TNB_DOMAIN);
            }

            buckys_redirect($returnUrl ? base64_decode($returnUrl) : '/account.php');
        }
    }else{ //Email Incorrect
        buckys_redirect('/register.php' . ($returnUrl ? "?return=$returnUrl" : ""), MSG_INVALID_LOGIN_INFO, MSG_TYPE_ERROR);
    }
}
