<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');
require_once(DIR_FS_FUNCTIONS . 'recaptcha.php');

// Getting Current User ID
$userID = buckys_is_logged_in();

// If the parameter is null, goto homepage
if($userID)
	buckys_redirect('/account.php');

if(isset($_GET['action']) && $_GET['action'] == 'verify'){
	$token = trim($_GET['token']);
	$email = trim($_GET['email']);
	if(!$token || !$email){
		buckys_redirect("/index.php", MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
	}
	BuckysUser::verifyAccount($email, $token);
	buckys_redirect("/index.php");
}

// Check CAPTCHA and create new account
if(isset($_POST['action']) && $_POST['action'] == 'create-account'){

	$recaptcha_challenge_field = '';
	$recaptcha_response_field = '';

	if(!DEVELOPER_MODE){
		$recaptcha_challenge_field = $_POST["recaptcha_challenge_field"];
		$recaptcha_response_field = $_POST["recaptcha_response_field"];
	}

	$resp = recaptcha_check_answer(RECAPTCHA_PRIVATE_KEY, $_SERVER["REMOTE_ADDR"], $recaptcha_challenge_field, $recaptcha_response_field);
	if($resp->is_valid){
		if(!BuckysUser::checkDailyUserLimit()){
			render_result_xml(['status' => 'error', 'message' => '<p class="message error">' . sprintf(MSG_DAILY_ACCOUNTS_LIMIT_EXCEED_ERROR, USER_DAILY_LIMIT_ACCOUNTS) . '</p>']);
			exit;
		}
		$newID = BuckysUser::createNewAccount($_POST);
		render_result_xml(['status' => !$newID ? 'error' : 'success', 'message' => !$newID ? buckys_get_messages() : MSG_NEW_ACCOUNT_CREATED]);
	}else{
		render_result_xml(['status' => 'error', 'message' => '<p class="message error">' . ($resp->error == 'incorrect-captcha-sol' ? 'The captcha input is not correct!' : $resp->error) . '</p>']);
	}
	exit;
}else if(isset($_POST['action']) && $_POST['action'] == 'reset-password'){
	if(!buckys_check_form_token()){
		exit;
	}
	BuckysUser::resetPassword($_POST['email']);
}

$returnUrl = isset($_GET['return']) ? $_GET['return'] : null;
$showForgotPwdForm = isset($_GET['forgotpwd']) && $_GET['forgotpwd'];

buckys_enqueue_stylesheet('register.css');
buckys_enqueue_javascript('register.js');

$TNB_GLOBALS['content'] = 'register';
$TNB_GLOBALS['title'] = 'Register - ' . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
