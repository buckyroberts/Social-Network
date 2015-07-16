<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

$bitcoinInfo = BuckysUser::getUserBitcoinInfo($userID);
if(!$bitcoinInfo){
    $bitcoinInfo = BuckysBitcoin::createWallet($TNB_GLOBALS['user']['userID'], $TNB_GLOBALS['user']['email']);
}

buckys_enqueue_stylesheet('uploadify.css');
buckys_enqueue_stylesheet('jquery.Jcrop.css');
buckys_enqueue_stylesheet('shop.css');

buckys_enqueue_javascript('uploadify/jquery.uploadify.js');
buckys_enqueue_javascript('jquery.Jcrop.js');
buckys_enqueue_javascript('jquery.color.js');
buckys_enqueue_javascript('shop.js');
buckys_enqueue_javascript('shop-edit.js');
buckys_enqueue_javascript('uploadify/flash_install.js');

$TNB_GLOBALS['content'] = 'shop/additem';
$TNB_GLOBALS['headerType'] = 'shop';

$view = [];

$shopCatIns = new BuckysShopCategory();
$countryIns = new BuckysCountry();

$view['no_cash'] = false;

$userInfo = BuckysUser::getUserBasicInfo($userID);

$view['category_list'] = $shopCatIns->getCategoryList(0);
$view['country_list'] = $countryIns->getCountryList();
$view['action_name'] = 'addShopProduct';
$view['page_title'] = 'Sell an Item';
$view['type'] = 'additem';

$view['my_bitcoin_balance'] = BuckysBitcoin::getUserWalletBalance($userID);
$view['my_credit_balance'] = $userInfo['credits'];

$view['shipping_fee_list'] = [];

if($view['my_bitcoin_balance'] < SHOP_PRODUCT_LISTING_FEE_IN_BTC && $view['my_credit_balance'] < SHOP_PRODUCT_LISTING_FEE_IN_CREDIT){
    $view['no_cash'] = true;
}

$TNB_GLOBALS['title'] = 'Sell an Item - BuckysRoomShop';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");