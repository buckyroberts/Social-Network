<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
$userID = buckys_is_logged_in();

//Getting User ID from Parameter
$profileID = isset($_GET['user']) ? $_GET['user'] : 0;

//If the parameter is null, goto homepage 
if(!$profileID)
    buckys_redirect('/index.php');

//Getting UserData from Id
$userData = BuckysUser::getUserData($profileID);
$userBitcoinInfo = BuckysUser::getUserBitcoinInfo($profileID);

//Goto Homepage if the userID is not correct
if(!buckys_not_null($userData) || !BuckysUser::checkUserID($profileID, true)){
    buckys_redirect('/index.php');
}

//Display
$TNB_GLOBALS['title'] = trim($userData['firstName'] . ' ' . $userData['lastName']) . "'s Bitcoin Address - " . TNB_SITE_NAME;

buckys_enqueue_stylesheet('profile.css');
buckys_enqueue_stylesheet('posting.css');
buckys_enqueue_stylesheet('publisher.css');

$TNB_GLOBALS['content'] = 'bitcoin';
$TNB_GLOBALS['meta'] = '<meta http-equiv="Pragma" content="no-cache">
                           <meta http-equiv="Cache-Control" content="no-cache">';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");

