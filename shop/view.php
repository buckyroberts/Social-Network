<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

$userID = buckys_is_logged_in();

buckys_enqueue_stylesheet('shop.css');

buckys_enqueue_javascript('shop.js');

$TNB_GLOBALS['content'] = 'shop/view';
$TNB_GLOBALS['headerType'] = 'shop';

$paramShopID = get_secure_integer($_REQUEST['id']);

$view = [];

$shopProductIns = new BuckysShopProduct();
$catIns = new BuckysShopCategory();
$countryIns = new BuckysCountry();
$userIns = new BuckysUser();
$shippingInfoIns = new BuckysTradeUser();

$view['product'] = $shopProductIns->getProductById($paramShopID);
$view['myID'] = $userID;

if(!isset($view['product']) || $view['product']['status'] == BuckysShopProduct::STATUS_INACTIVE)
    buckys_redirect('/shop/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);

//Check if the items owner is active one
$userData = $userIns->getUserData($view['product']['userID']);
if($userData['status'] == BuckysUser::STATUS_USER_BANNED){
    buckys_redirect('/shop/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

//Read more info from DB
$catData = $catIns->getCategoryByID($view['product']['catID']);
$view['product']['categoryName'] = isset($catData) ? $catData['name'] : '';

$countryData = $countryIns->getCountryById($view['product']['locationID']);
$view['product']['locationName'] = isset($countryData) ? $countryData['country_title'] : '';

$view['product']['userInfo'] = $userIns->getUserBasicInfo($view['product']['userID']);

if(!isset($view['product']['userInfo']))
    buckys_redirect('/shop/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);

$view['my_product_flag'] = false;
$view['available_shipping_price'] = null;
$view['my_shipping_info'] = $myShippingData = $shippingInfoIns->getUserByID($userID);
$view['fill_shipping_info'] = false;
$view['my_info'] = $userIns->getUserBasicInfo($userID);
$view['is_purchased'] = $shopProductIns->isPurchased($userID, $paramShopID);
if(!$userID || $userID == $view['product']['userID']){
    $view['my_product_flag'] = true;
}else{
    if($view['product']['isDownloadable'] == 1){
        $view['available_shipping_price'] = true;
    }else{
        //shipping price show
        $productShippingInfo = $shopProductIns->getShippingPrice($view['product']['productID']);

        if(isset($myShippingData)){
            if(is_numeric($myShippingData['shippingCountryID']) && $myShippingData['shippingCountryID'] > 0){
                $view['available_shipping_price'] = fn_buckys_get_available_shipping_price($userID, $view['product']['productID']);
            }else{
                $view['fill_shipping_info'] = true;
            }
        }else{
            $view['fill_shipping_info'] = true;
        }
    }

}

$TNB_GLOBALS['title'] = $view['product']['title'] . ' - BuckysRoomShop';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
