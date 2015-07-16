<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
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
$tradeItemIns = new BuckysTradeItem();
$tradeUserIns = new BuckysTradeUser();

$view['category_list'] = $tradeCatIns->getCategoryList(0);
$view['country_list'] = $countryIns->getCountryList();
$view['action_name'] = 'editTradeItem';

$paramItemID = get_secure_integer($_REQUEST['id']);
$paramType = get_secure_string($_REQUEST['type']);

$view['item'] = null;
switch($paramType){
    case 'relist':

        /*
        $view['no_credits'] = false;
        if (!$tradeUserIns->hasCredits($userID)) {
            $view['no_credits'] = true;
        }
        */

        // Relist trade items with bitcoin or credits - now matches Shop code
        $userInfo = BuckysUser::getUserBasicInfo($userID);
        $view['my_bitcoin_balance'] = BuckysBitcoin::getUserWalletBalance($userID);
        $view['my_credit_balance'] = $userInfo['credits'];

        $view['item'] = $tradeItemIns->getItemById($paramItemID, true);
        $view['type'] = 'relist';
        $view['page_title'] = 'Relist an Item';
        break;
    default:
        $view['item'] = $tradeItemIns->getItemById($paramItemID, false);
        $view['type'] = 'edit';
        $view['page_title'] = 'Edit an Item';
        break;
}

if($view['item'] == null || $view['item']['userID'] != $userID || $view['item']['status'] != BuckysTradeItem::STATUS_ITEM_ACTIVE){
    buckys_redirect('/trade/available.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

$TNB_GLOBALS['title'] = 'Edit an Item - BuckysRoomTrade';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
