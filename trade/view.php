<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

$userID = buckys_is_logged_in();

buckys_enqueue_stylesheet('trade.css');

buckys_enqueue_javascript('trade.js');

$TNB_GLOBALS['content'] = 'trade/view';
$TNB_GLOBALS['headerType'] = 'trade';

$paramItemID = buckys_escape_query_integer($_REQUEST['id']);

$view = [];

$tradeItemIns = new BuckysTradeItem();
$tradeCatIns = new BuckysTradeCategory();
$countryIns = new BuckysCountry();
$userIns = new BuckysUser();
$tradeOfferIns = new BuckysTradeOffer();

$view['item'] = $tradeItemIns->getItemById($paramItemID);
$view['myID'] = $userID;

if(!isset($view['item']) || $view['item']['status'] == BuckysTradeItem::STATUS_ITEM_INACTIVE)
    buckys_redirect('/trade/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);

//Check if the items owner is active one
$userData = $userIns->getUserData($view['item']['userID']);
if($userData['status'] == BuckysUser::STATUS_USER_BANNED){
    buckys_redirect('/trade/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

//Read more info from DB
$catData = $tradeCatIns->getCategoryByID($view['item']['catID']);
$view['item']['categoryName'] = isset($catData) ? $catData['name'] : '';

$countryData = $countryIns->getCountryById($view['item']['locationID']);
$view['item']['locationName'] = isset($countryData) ? $countryData['country_title'] : '';

$view['item']['userInfo'] = $userIns->getUserBasicInfo($view['item']['userID']);

if(!isset($view['item']['userInfo']))
    buckys_redirect('/trade/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);

//Check if you can make an offer to this user. If this user decline your offer before for this item, then you can't send again
$view['offerDisabled'] = false;
if(!$userID || $userID == $view['item']['userID']){
    $view['offerDisabled'] = true;
}else{
    /**
     * If it has been set, then it means you can't make an offer if one of your offer declined by this user.
     * When you enable this block, please note BuckysTradeOffer::addOffer() function, there are parts disabled
     */
    //$view['offerDisabled'] = $tradeOfferIns->checkDeclinedOffer($view['item']['itemID'], null, $userID);
}

//If you are logged in, then get available to make an offer
$view['availableItems'] = [];
if($userID && is_numeric($userID) && $view['offerDisabled'] == false){
    $view['availableItems'] = $tradeItemIns->getItemList($userID, false, BuckysTradeItem::STATUS_ITEM_ACTIVE);
    $view['availableItems'] = $tradeOfferIns->getAvailableItemList($view['item']['itemID'], $view['availableItems']);

}

$TNB_GLOBALS['title'] = $view['item']['title'] . ' - BuckysRoomTrade';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
