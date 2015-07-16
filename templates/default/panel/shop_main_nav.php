<?php
/**
 * Display shop left side navitation

 */

$soldItemCount = 0;

$userData = $TNB_GLOBALS['user'];

if(isset($userData) && isset($userData['userID'])){
    $orderIns = new BuckysShopOrder();
    $soldItemCount = $orderIns->getNewSoldItemCount($userData['userID']);

}

?>
<aside id="main_aside" class="shop-left-panel">
    <span class="titles">Shop Account</span>

    <a href="/shop/available.php" class="accountLinks" style="margin-top:10px;">Selling</a> <a
        href="/shop/available.php" class="accountSubLinks">Selling Now</a> <br/> <a href="/shop/sold.php"
        class="accountSubLinks<?php echo $soldItemCount > 0 ? 'Bold' : '' ?>">Sold<?php echo $soldItemCount > 0 ? ' (' . $soldItemCount . ') ' : '' ?></a><br/>
    <a href="/shop/available.php?type=expired" class="accountSubLinks">Expired</a> <br/><br/>

    <a href="/shop/purchase.php" class="accountLinks">Purchases</a> <a href="/shop/purchase.php"
        class="accountSubLinks">Recent</a> <br/> <a href="/shop/purchase.php?type=archived"
        class="accountSubLinks">Archived</a> <br/><br/>

    <a href="/notify.php" class="accountLinks">Shop Settings</a> <a href="/notify.php"
        class="accountSubLinks">Notification Settings</a> <br/> <a href="/shipping_info.php"
        class="accountSubLinks">Shipping Information</a> <br/><br/>

</aside>
