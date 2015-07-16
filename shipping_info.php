<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

buckys_enqueue_stylesheet('trade.css');
buckys_enqueue_stylesheet('account.css');
buckys_enqueue_javascript('trade.js');

$TNB_GLOBALS['content'] = 'shipping_info';
//$TNB_GLOBALS['headerType'] = 'trade';

$view = [];

$paramFillShippingInfoFromShop = get_secure_integer($_REQUEST['fill']);
if($paramFillShippingInfoFromShop == 'shop'){
    buckys_add_message('Before buying an item, you must fill out your shipping information in order to determine shipping fees.', MSG_TYPE_ERROR);
}

//Save Shipping info
$tradeUserIns = new BuckysTradeUser();
$countryIns = new BuckysCountry();
if($_POST['action'] == 'saveShippingInfo'){
    $paramData = [//                'shippingFullName' => $_POST['shippingFullName'],
        'shippingAddress' => $_POST['shippingAddress'], 'shippingAddress2' => $_POST['shippingAddress2'], 'shippingCity' => $_POST['shippingCity'], 'shippingState' => $_POST['shippingState'], 'shippingZip' => $_POST['shippingZip'], 'shippingCountryID' => $_POST['shippingCountryID']];
    $retVal = $tradeUserIns->updateShippingInfo($userID, $paramData);

    if($retVal == false){
        $view['status'] = ['success' => false, 'message' => 'Something goes wrong! Please contact customer support.'];

    }else{
        $view['status'] = ['success' => true, 'message' => 'Your shipping info has been updated successfully.'];

    }

}

//Get offer_received info

$view['trade_user_info'] = $tradeUserIns->getUserByID($userID);
$view['country_list'] = $countryIns->getCountryList();

//Set your current name

if(empty($view['trade_user_info'])){
    buckys_redirect('/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

$TNB_GLOBALS['title'] = 'Shipping Info - ' . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
