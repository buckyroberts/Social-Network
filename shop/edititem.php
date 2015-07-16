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

$countryIns = new BuckysCountry();
$shopProductIns = new BuckysShopProduct();

$view['category_list'] = BuckysShopCategory::getCategoryList(0);
$view['country_list'] = $countryIns->getCountryList();
$view['action_name'] = 'editProduct';

$paramProdID = get_secure_integer($_REQUEST['id']);
$paramType = get_secure_string($_REQUEST['type']);

$view['product'] = null;
switch($paramType){
    case 'relist':

        $userInfo = BuckysUser::getUserBasicInfo($userID);

        $view['my_bitcoin_balance'] = BuckysBitcoin::getUserWalletBalance($userID);
        $view['my_credit_balance'] = $userInfo['credits'];

        $view['product'] = $shopProductIns->getProductById($paramProdID, true);
        $view['type'] = 'relist';
        $view['page_title'] = 'Relist an Item';
        break;
    default:
        $view['product'] = $shopProductIns->getProductById($paramProdID, false);
        $view['type'] = 'edit';
        $view['page_title'] = 'Edit an Item';
        break;
}

if($view['product'] == null || $view['product']['userID'] != $userID || $view['product']['status'] != BuckysShopProduct::STATUS_ACTIVE){
    buckys_redirect('/shop/available.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

$view['shipping_fee_list'] = $shopProductIns->getShippingPrice($paramProdID);

$TNB_GLOBALS['title'] = 'Edit an Item - BuckysRoomShop';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
