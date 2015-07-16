<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/register.php');
}

buckys_enqueue_stylesheet('uploadify.css');
buckys_enqueue_stylesheet('jquery.Jcrop.css');
buckys_enqueue_stylesheet('trade.css');

buckys_enqueue_javascript('uploadify/jquery.uploadify.js');
buckys_enqueue_javascript('jquery.Jcrop.js');
buckys_enqueue_javascript('jquery.color.js');
buckys_enqueue_javascript('trade.js');
buckys_enqueue_javascript('trade-edit.js');
buckys_enqueue_javascript('uploadify/flash_install.js');

$TNB_GLOBALS['content'] = 'trade/additem';
$TNB_GLOBALS['headerType'] = 'trade';

$view = [];

$tradeCatIns = new BuckysTradeCategory();
$countryIns = new BuckysCountry();
$tradeUserIns = new BuckysTradeUser();

$view['no_cash'] = false;

$view['no_credits'] = false;

if(!$tradeUserIns->hasCredits($userID)){
    $view['no_credits'] = true;
}

$userInfo = BuckysUser::getUserBasicInfo($userID);

$view['category_list'] = $tradeCatIns->getCategoryList(0);
$view['country_list'] = $countryIns->getCountryList();
$view['action_name'] = 'addTradeItem';
$view['page_title'] = 'Add an Item';
$view['type'] = 'additem';

$view['my_bitcoin_balance'] = BuckysBitcoin::getUserWalletBalance($userID);
$view['my_credit_balance'] = $userInfo['credits'];

if($view['my_bitcoin_balance'] < TRADE_ITEM_LISTING_FEE_IN_BTC && $view['my_credit_balance'] < TRADE_ITEM_LISTING_FEE_IN_CREDIT){
    $view['no_cash'] = true;
}

$TNB_GLOBALS['title'] = 'Add an Item - BuckysRoomTrade';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
