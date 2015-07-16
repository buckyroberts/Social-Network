<?php
/**
 * Display trade left side navitation

 */

$tradeOfferReceived = 0;

$userData = $TNB_GLOBALS['user'];

if(isset($userData) && isset($userData['userID'])){
    $tradeOfferIns = new BuckysTradeOffer();
    $tradeOfferReceived = $tradeOfferIns->getNewOfferCount($userData['userID']);
}

$current_page = '';
$uri = $_SERVER['REQUEST_URI'];

if(strpos($uri, 'available.php')){
    $current_page = 'available';
}
if(strpos($uri, 'available.php?type=expired')){
    $current_page = 'expired';
}
if(strpos($uri, 'offer_made.php')){
    $current_page = 'made';
}
if(strpos($uri, 'offer_received.php')){
    $current_page = 'received';
}
if(strpos($uri, 'offer_declined.php')){
    $current_page = 'declined';
}
if(strpos($uri, 'traded.php')){
    $current_page = 'completed';
}
if(strpos($uri, 'traded.php?type=history')){
    $current_page = 'history';
}

?>
<aside id="main_aside" class="trade-left-panel">
    <span class="small-titles">My Items</span><br/> <a href="/trade/available.php" class="accountSubLinks"
        style="<?php echo ($current_page == 'available') ? 'color:#C0392B;font-weight:bold' : '' ?>">Available</a> <br/>
    <a href="/trade/available.php?type=expired" class="accountSubLinks"
        style="<?php echo ($current_page == 'expired') ? 'color:#C0392B;font-weight:bold' : '' ?>">Expired</a>
    <br/><br/>

    <span class="small-titles">Offers</span><br/> <a href="/trade/offer_made.php" class="accountSubLinks"
        style="<?php echo ($current_page == 'made') ? 'color:#C0392B;font-weight:bold' : '' ?>">Made</a> <br/> <a
        href="/trade/offer_received.php" class="accountSubLinks<?php echo $tradeOfferReceived > 0 ? 'Bold' : '' ?>"
        style="<?php echo ($current_page == 'received') ? 'color:#C0392B;font-weight:bold' : '' ?>">Received<?php echo $tradeOfferReceived > 0 ? ' (' . $tradeOfferReceived . ') ' : '' ?></a><br/>
    <a href="/trade/offer_declined.php" class="accountSubLinks"
        style="<?php echo ($current_page == 'declined') ? 'color:#C0392B;font-weight:bold' : '' ?>">Declined</a>
    <br/><br/>

    <span class="small-titles">Trades</span><br/> <a href="/trade/traded.php" class="accountSubLinks"
        style="<?php echo ($current_page == 'completed') ? 'color:#C0392B;font-weight:bold' : '' ?>">Completed Trades</a>
    <br/> <a href="/trade/traded.php?type=history" class="accountSubLinks"
        style="<?php echo ($current_page == 'history') ? 'color:#C0392B;font-weight:bold' : '' ?>">Trade History</a>
    <br/><br/>

    <span class="small-titles">Trade Settings</span><br/> <a href="/notify.php"
        class="accountSubLinks">Notification Settings</a> <br/> <a href="/shipping_info.php"
        class="accountSubLinks">Shipping Information</a> <br/><br/>
</aside>
