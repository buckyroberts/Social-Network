<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
    buckys_redirect('/register.php');
}

$bitcoinClass = new BuckysBitcoin();

//Create Wallet if it is not created
$bitcoinInfo = BuckysUser::getUserBitcoinInfo($userID);
if(!$bitcoinInfo){
    $bitcoinInfo = $bitcoinClass->createWallet($TNB_GLOBALS['user']['userID'], $TNB_GLOBALS['user']['email']);
}

if(isset($_POST['action']) && $_POST['action'] == 'send-bitcoins'){
    //Check Token
    if(!buckys_check_form_token()){
        buckys_redirect("/wallet.php", MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }
    $toAddress = $_POST['receiver'];
    $amount = doubleval($_POST['amount']);
    $password = $_POST['password'];

    $user = BuckysUser::getUserData($TNB_GLOBALS['user']['userID']);

    $is_error = false;

    if(!$password || !buckys_validate_password($password, $user['password'])){
        buckys_redirect("/wallet.php", MSG_CURRENT_PASSWORD_NOT_CORRECT, MSG_TYPE_ERROR);
    }

    if(!$toAddress){
        buckys_redirect("/wallet.php", MSG_ENTER_BITCOINS_ADDRESS_OF_RECIPIENT, MSG_TYPE_ERROR);
    }

    if(!$amount || $amount <= 0){
        buckys_redirect("/wallet.php", MSG_INVALID_BITCOIN_AMOUNT, MSG_TYPE_ERROR);
    }

    if(!$is_error){
        $bitcoinClass->sendBitcoin($userID, $toAddress, $amount);
    }
    buckys_redirect("/wallet.php");
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;

list($totalCount, $bitcoinBalance, $transactions) = $bitcoinClass->getTransactions($userID, $page, $bitcoinClass->COUNT_PER_PAGE);

if(!$bitcoinBalance)
    $bitcoinBalance = 0;

//Init Pagination Class
$pagination = new Pagination($totalCount, $bitcoinClass->COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

//Getting Balance
//$bitcoinBalance = $bitcoinClass->getWalletBalance($bitcoinInfo['bitcoin_guid'], buckys_decrypt($bitcoinInfo['bitcoin_password']));

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('credits.css');

buckys_enqueue_javascript('wallet.js');

$TNB_GLOBALS['content'] = 'wallet';

$TNB_GLOBALS['title'] = "Wallet - " . TNB_SITE_NAME;
$TNB_GLOBALS['payerID'] = $userID;

$TNB_GLOBALS['meta'] = '<meta http-equiv="Pragma" content="no-cache">
                           <meta http-equiv="Cache-Control" content="no-cache">';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
