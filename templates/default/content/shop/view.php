<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}

$productData = $view['product'];
$shippingPriceText = '';


/*Get images*/
$imageList = [];
if($productData['images'] != '')
    $imageList = explode("|", $productData['images']);

$imageThumbList = []; // it will save image & thumb list

if(count($imageList) > 0){

    foreach($imageList as $imgData){

        $thumbPathInfo = pathinfo($imgData);
        $thumbFileName = $thumbPathInfo['dirname'] . "/" . $thumbPathInfo['filename'] . SHOP_PRODUCT_IMAGE_THUMB_SUFFIX . "." . $thumbPathInfo['extension'];

        $tmpData['image'] = $imgData;
        $tmpData['thumb'] = $thumbFileName;

        $imageThumbList[] = $tmpData;
    }

}else{
    $imageThumbList[0]['image'] = '/images/shop/no-image.jpg';
    $imageThumbList[0]['thumb'] = '/images/shop/no-image-thumb.jpg';
}


$totalRating = 'No';
$positiveRating = '';

if(isset($productData['totalRating']) && $productData['totalRating'] > 0){
    $totalRating = $productData['totalRating'];
    if(is_numeric($productData['positiveRating'])){
        $positiveRating = number_format($productData['positiveRating'] / $productData['totalRating'] * 100, 2, '.', '') . '% Positive';
    }
}

$sendMessageLink = '/register.php';
if(isset($view['myID']) && is_numeric($view['myID']))
    $sendMessageLink = '/messages_compose.php?to=' . $productData['userID'];

?>

<section id="main_section">

    <?php buckys_get_panel('shop_top_search'); ?>

    <section class="shop-full-panel">
        <?php echo buckys_get_messages(); ?>

        <div class="shop-view-images">
            <div class="m">
                <img id="shop_view_main_image" src="<?php echo $imageThumbList[0]['image']; ?>"/>
            </div>

            <div class="d">mouse over images to zoom</div>

            <div class="thumb">
                <ul>
                    <?php
                    for($idx = 0; $idx < count($imageThumbList); $idx++){
                        echo sprintf('<li class="%s"><table cellpadding="0" cellspacing="0"><tr><td><img src="%s" /><img src="%s" class="large"/></td></tr></table></li>', $idx == 0 ? 'first sel' : '', $imageThumbList[$idx]['thumb'], $imageThumbList[$idx]['image']);
                    }
                    ?>
                </ul>
                <div class="clear"></div>
            </div>

        </div>

        <div class="shop-view-info">
            <div><span class="titles">Item Information</span></div>

            <div class="i-name"><?php echo $productData['title']; ?></div>
            <div class="i-subtitle"><?php echo $productData['subtitle']; ?></div>
            <div class="i-info">
                <dl>
                    <dt>
                        Price: <br/>
                        <?php if(!$productData['isDownloadable']){ ?>
                            Shipping: <br/>
                        <?php } ?>
                        Category: <br/>
                        <?php if(!$productData['isDownloadable']){ ?>
                            Item Location: <br/>
                        <?php } ?>
                        Time Left:
                    </dt>
                    <dd>
                        <span
                            style="color:#16A085;"><?php echo fn_buckys_get_btc_price_formated($productData['price'], true) ?> BTC </span>
                        <br/>

                        <?php if(!$productData['isDownloadable']){ ?>
                            <?php

                            if($view['available_shipping_price'] == null)
                                $shippingPriceText = '<span style="color:#999999;">Not available </span><a href="/shipping_info.php">(edit shipping info)</a>';else{
                                if($view['available_shipping_price'] == 0){
                                    $shippingPriceText = "Free";
                                }else{
                                    $shippingPriceText = fn_buckys_get_btc_price_formated($view['available_shipping_price'], true) . " BTC";
                                }
                            }

                            echo $shippingPriceText;

                            ?><br/>
                        <?php } ?>

                        <a href="/shop/search.php?cat=<?php echo urlencode($productData['categoryName']); ?>"><?php echo $productData['categoryName'] ?></a><br/>

                        <?php if(!$productData['isDownloadable']){ ?>
                            <?php echo $productData['locationName'] ?> <br/>
                        <?php } ?>

                        <?php
                        if($productData['status'] != BuckysShopProduct::STATUS_SOLD){
                            echo sprintf('<span style="color:#C0392B;">%s</span>', fn_buckys_get_item_time_left($productData['expiryDate']));
                        }else
                            echo '-';
                        ?>

                    </dd>

                </dl>
                <div class="clear"></div>
            </div>

            <div class="action-cont">
                <div><span class="titles">Action</span></div>
                <?php if(!$view['is_purchased']): ?>
                    <?php if($productData['status'] != BuckysShopProduct::STATUS_SOLD) : ?>
                        <?php if($view['myID'] != $productData['userID']): ?>
                            <?php if(isset($view['myID']) && is_numeric($view['myID'])): ?>
                                <?php if($view['my_product_flag'] == false) : ?>
                                    <?php if(!$view['product']['isDownloadable']): ?>
                                        <?php
                                        $buyNowHtml = '';
                                        if($view['fill_shipping_info'] == true){
                                            $buyNowHtml = '<a href="/shipping_info.php?fill=shop">Buy Now</a> <br/>';
                                        }else{
                                            $buyNowHtml = '<a href="javascript:void(0)" class="show-buy-now-btn">Buy Now</a><br/>';
                                        }

                                        if($view['available_shipping_price'] == null){
                                            $buyNowHtml = '<a href="javascript:void(0)" class="disabled-purchase-btn">Buy Now</a><br/>';
                                        }

                                        echo $buyNowHtml;

                                        ?>
                                    <?php else: ?>
                                        <a href="javascript:void(0)" class="show-buy-now-btn">Buy Now</a><br/>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <a href="/register.php">Buy Now</a>  <br/>
                            <?php endif; ?>
                            <!--<br/>-->


                        <?php else : ?>

                            <?php if(fn_buckys_get_item_time_left($productData['expiryDate']) == '0') : ?>
                                <a href="javascript:void(0)"
                                    onclick="deleteShopProduct(<?php echo $productData['productID']; ?>);">Delete</a>
                                <br/>
                                <a href="/shop/edititem.php?id=<?php echo $productData['productID']; ?>&type=relist">Relist Item</a>
                                <br/>
                            <?php else: ?>
                                <a href="/shop/edititem.php?id=<?php echo $productData['productID']; ?>">Edit</a> <br/>
                                <a href="javascript:void(0)"
                                    onclick="deleteShopProduct(<?php echo $productData['productID']; ?>);">Delete</a>
                                <br/>
                            <?php endif; ?>

                        <?php endif; ?>
                    <?php else: ?>
                        <div class="">This item has been sold.</div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="">You already purchased this item.</div>
                <?php endif; ?>
                <?php render_report_link($productData['productID'], 'shop_item', $productData['userID'], $userID, $productData['reportID']); ?>
            </div>

        </div>

        <div class="shop-view-owner">
            <div><span class="titles">Owner Information</span></div>
            <a href="/profile.php?user=<?php echo $productData['userID']; ?>" class="profileLink"> <img
                    src="<?php echo BuckysUser::getProfileIcon($productData['userID']) ?>" class="postIcons"/> <span
                    style="font-weight:bold;"><?php echo trim($productData['userInfo']['firstName'] . ' ' . $productData['userInfo']['lastName']); ?></span>
            </a>

            <div>
                <?php
                if(is_numeric($totalRating)){
                    echo sprintf('<a href="%s" class="rating">(%d ratings)</a> %s', '/feedback.php?user=' . $productData['userID'], $totalRating, $positiveRating);
                }else{
                    echo sprintf('(%s ratings)', $totalRating);
                }
                ?>
            </div>
            <div class="clear"></div>
            <div class="action-cont">
                <a href="/shop/search.php?user=<?php echo $productData['userID'] ?>">See Other Items</a> <br/>
                <?php if($view['myID'] != $productData['userID']): ?>
                    <a href="<?php echo $sendMessageLink ?>">Send Message</a> <br/>
                <?php endif; ?>
                <a href="/profile.php?user=<?php echo $productData['userID']; ?>">View Profile</a> <br/>
            </div>

        </div>

        <?php if($view['my_product_flag'] == false && $view['available_shipping_price'] != null) : ?>
            <div class="buy-product-panel">
                <div><span class="titles">Buy Now</span></div>
                <div class="buy-product-panel-inner">

                    <form action="/shop/process.php" method="post" id="buy_now_form">
                        <input type="hidden" name="action" value="purchaseProduct"> <input type="hidden"
                            name="actionType" value="POST"> <input type="hidden" name="productID"
                            value="<?php echo $productData['productID'] ?>"> <input type="hidden" name="buyerID"
                            value="<?php echo $view['myID']; ?>">
                    </form>
                    <?php if(!$productData['isDownloadable']){ ?>
                        <label>Shipping Address:</label>
                        <p>
                            <?php
                            echo $view['my_info']['firstName'] . ' ' . $view['my_info']['lastName'] . "<br/>";
                            if($view['my_shipping_info']['shippingAddress'] != '')
                                echo $view['my_shipping_info']['shippingAddress'] . ' ' . $view['my_shipping_info']['shippingAddress2'] . "<br/>";
                            if($view['my_shipping_info']['shippingCity'] != '')
                                echo $view['my_shipping_info']['shippingCity'] . ", ";
                            if($view['my_shipping_info']['shippingState'] != '')
                                echo $view['my_shipping_info']['shippingState'] . "<br/>";
                            if($view['my_shipping_info']['shippingZip'] != '')
                                echo $view['my_shipping_info']['shippingZip'] . "<br/>";
                            if($view['my_shipping_info']['shippingCountryID'] != ''){
                                $cotD = BuckysCountry::getCountryById($view['my_shipping_info']['shippingCountryID']);
                                echo $cotD['country_title'];
                            }

                            ?>
                        </p>

                        <label>Returns:</label>
                        <p>
                            <?php echo $productData['returnPolicy']; ?>
                        </p>

                        <label>Item:</label>
                        <div class="clear"></div>
                        <div class="prod-l">
                            <?php echo $productData['title']; ?>
                        </div>
                        <div class="prod-r">
                            <label>Item Price: </label> <span><?php echo $productData['price'] ?> BTC</span>
                            <label>Shipping: </label> <span><?php echo $shippingPriceText; ?></span>
                            <label>Total: </label>
                            <span><strong><?php echo $productData['price'] + $view['available_shipping_price']; ?> BTC</strong></span>
                        </div>
                        <div class="clear"></div>
                    <?php }else{ ?>
                        <p>This item will be available for instant download. All digital goods are non-returnable and non-refundable after purchase.</p>
                        <label>Item:</label>
                        <div class="clear"></div>
                        <div class="prod-l">
                            <?php echo $productData['title']; ?>
                        </div>
                        <div class="prod-r">
                            <label>Item Price: </label> <span><?php echo $productData['price'] ?> BTC</span>
                            <label>Total: </label> <span><strong><?php echo $productData['price'] ?> BTC</strong></span>
                        </div>
                        <div class="clear"></div>
                    <?php } ?>
                </div>
                <div>
                    <input type="button" id="btn_buy_now" class="red-btn" value="Buy" style="margin-right: 5px;"/>
                    <input type="button" id="btn_cancel_buy" class="gray-btn" value="Cancel"/>
                </div>
            </div>
        <?php endif; ?>

        <div class="clear"></div>

        <div class="shop-view-description">
            <div><span class="titles">Description:</span></div>
            <div class="d">
                <?php echo render_enter_to_br($productData['description']); ?>
            </div>

            <div <?php echo ($productData['isDownloadable']) ? 'style="display: none"' : '' ?>>
                <span class="titles">Return Policy:</span></div>
            <div class="d" <?php echo ($productData['isDownloadable']) ? 'style="display: none"' : '' ?>>
                <?php echo $productData['returnPolicy']; ?>
            </div>
        </div>

        <div style="text-align: center;">
            <br/><br/> <img src="/images/btc_accepted_here.png" style="margin:0px 20px 10px 0px;"/>

            <div style="display:inline-block;">
                <!-- Begin DigiCert site seal HTML and JavaScript -->
                <div id="DigiCertClickID_05D1VcQp" data-language="en_US">
                    <a href="http://www.digicert.com/ssl-certificate.htm">SSL Certificate</a>
                </div>
                <script type="text/javascript">
                    var __dcid = __dcid || [];
                    __dcid.push(["DigiCertClickID_05D1VcQp", "7", "m", "black", "05D1VcQp"]);
                    (function (){
                        var cid = document.createElement("script");
                        cid.async = true;
                        cid.src = "//seal.digicert.com/seals/cascade/seal.min.js";
                        var s = document.getElementsByTagName("script");
                        var ls = s[(s.length - 1)];
                        ls.parentNode.insertBefore(cid, ls.nextSibling);
                    }());
                </script>
                <!-- End DigiCert site seal HTML and JavaScript -->
            </div>
            <br/>
        </div>

    </section>
</section>

<!-- Go to www.addthis.com/dashboard to customize your tools 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53b910e169f3bbcf"></script>
-->
