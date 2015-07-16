<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}


if(!isset($view['shipping_fee_list']))
    $view['shipping_fee_list'] = [];else{
    foreach($view['shipping_fee_list'] as &$shippingFeeData){
        $shippingFeeData['price'] = fn_buckys_get_btc_price_formated($shippingFeeData['price'], true);
    }
}

$isDownloadable = isset($view['product']) && $view['product']['isDownloadable'] == 1 ? true : false;

?>

<script type="text/javascript">
    <?php if (isset($view['product'])) :?>
    var current_img_files = <?php if ($view['product']['images'] != '') echo json_encode(explode("|", $view['product']['images'])); else echo json_encode([]);?>;
    <?php else :?>
    var current_img_files = [];
    <?php endif;?>

    var countryCodeList = <?php echo json_encode($view['country_list']);?>;
    var shippingFeeList = <?php echo json_encode($view['shipping_fee_list']);?>;

</script>




<?php if($view['no_cash']) : ?>
    <script type="text/javascript">
        var noCashFlag = true;
    </script>
<?php endif; ?>

<section id="main_section">

    <?php buckys_get_panel('shop_top_search'); ?>

    <?php buckys_get_panel('shop_main_nav'); ?>
    <section id="right_side" class="floatright">

        <div><span class="titles"><?php echo $view['page_title']; ?></span></div>


        <?php if($view['no_cash']) : ?>
            <p class="message error">You have not enough credits. Click <a href="/credits.php"
                    style="color:white;text-decoration:underline">here</a> to purchase credits. Or put bitcoins in your
                <a href="/wallet.php" style="color:white;text-decoration:underline">wallet</a>.</p>
        <?php endif; ?>


        <div>

            <div class="shop-item-panel" style="padding-top:0px;">
                <form method="post" id="shopEditForm" style="padding-top:10px;">

                    <input type="hidden" id="actionName" value="<?php echo $view['action_name']; ?>"> <input
                        type="hidden" id="productID" value="<?php if(isset($view['product']))
                        echo $view['product']['productID']; ?>"> <input type="hidden" id="actionType"
                        value="<?php if(isset($view['type']))
                            echo $view['type']; ?>"> <input type="hidden" id="shippingFeeVal" value="">

                    <div class="row">
                        <label for="title">Title:</label>
                        <span class="inputholder"><input type="text" value="<?php if(isset($view['product']))
                                echo $view['product']['title']; ?>" class="input" name="title" id="title"
                                maxlength="80"></span>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <label for="subtitle">Subtitle:</label>
                        <span class="inputholder"><input type="text" value="<?php if(isset($view['product']))
                                echo $view['product']['subtitle']; ?>" class="input" name="subtitle" id="subtitle"
                                maxlength="60"></span>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <label for="description">Description:</label>
                        <span class="inputholder"><textarea class="input inputdesc" name="description" id="description"
                                maxlength="5000"><?php if(isset($view['product']))
                                    echo $view['product']['description']; ?></textarea></span>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <label for="category">Category:</label>
                        <span class="inputholder">
                            <select class="input select" name="category" id="category">
                                <option value=""> - Select -</option>
                                <?php
                                if(count($view['category_list']) > 0){
                                    foreach($view['category_list'] as $catData){

                                        $selected = '';

                                        if(isset($view['product']) && $view['product']['catID'] == $catData['catID'])
                                            $selected = 'selected="selected"';

                                        echo sprintf('<option value="%d" %s %s>%s</option>', $catData['catID'], $selected, "is-downloadable='" . $catData['isDownloadable'] . "'", $catData['name']);
                                    }
                                }
                                ?>
                            </select>
                        </span>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <label>Images (Up to 5) :</label>
                        <span class="inputholder">
                            <input type="button" id="image_upload_btn" name="image_upload_btn" type="file"/>
                        </span>

                        <div class="clear"></div>
                    </div>
                    <div class="row" id="image_list_container">
                    </div>

                    <div class="clear"></div>
                    <?php
                    $currDuration = isset($view['product']) ? $view['product']['listingDuration'] : 14;
                    ?>
                    <div class="row">
                        <label for="listing_duration">Listing Duration</label>
                        <span class="inputholder">
                            <select class="select" name="listing_duration" id="listing_duration">
                                <option value="1" <?php echo $currDuration == 1 ? 'selected="selected"' : '' ?>>1 day
                                </option>
                                <option value="7" <?php echo $currDuration == 7 ? 'selected="selected"' : '' ?>>7 days
                                </option>
                                <option
                                    value="14" <?php echo $currDuration == 14 ? 'selected="selected"' : '' ?>>14 days
                                </option>
                                <?php if($isDownloadable){ ?>
                                    <option
                                        value="-1" <?php echo $currDuration == -1 ? 'selected="selected"' : '' ?>>Unlimited
                                    </option>
                                <?php } ?>
                            </select>
                        </span>
                    </div>

                    <div class="clear"></div>
                    <div class="row"
                        id="item-location-row" <?php echo $isDownloadable ? 'style="display: none"' : '' ?>>
                        <label for="location">Item Location:</label>
                        <span class="inputholder">
                            <select class="input select" name="location" id="location">
                                <option value=""> - Select -</option>
                                <?php
                                if(count($view['country_list']) > 0){
                                    foreach($view['country_list'] as $countryData){

                                        $selected = '';
                                        if(isset($view['product']) && $view['product']['locationID'] == $countryData['countryID'])
                                            $selected = 'selected="selected"';

                                        echo sprintf('<option value="%d" %s>%s</option>', $countryData['countryID'], $selected, $countryData['country_title']);
                                    }
                                }
                                ?>
                            </select>
                        </span>

                        <div class="clear"></div>
                    </div>

                    <div class="row"
                        id="return-policy-row" <?php echo $isDownloadable ? 'style="display: none"' : '' ?>>
                        <label for="return_policy">Return Policy:</label>
                        <span class="inputholder"><input class="input" name="return_policy" id="return_policy"
                                maxlength="500" value="<?php if(isset($view['product']))
                                echo $view['product']['returnPolicy']; ?>"></span>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <label for="price">Price:</label>
                        <span class="inputholder"><input type="text" class="input input-short zero-omit" name="price"
                                id="price" maxlength="50" value="<?php if(isset($view['product']))
                                echo fn_buckys_get_btc_price_formated($view['product']['price'], true); ?>"> BTC</span>

                        <div class="clear"></div>
                    </div>

                    <div class="row"
                        id="digital_goods_file_row" <?php echo !$isDownloadable ? 'style="display: none"' : '' ?>>
                        <label>File(300MB limit) :</label>
                        <span class="inputholder">
                            <input type="button" id="digital_goods_file" name="digital_goods_file" type="file"/>
                        </span>

                        <div class="clear"></div>
                        <?php if(isset($isDownloadable)){ ?>
                            <p style="padding-left: 130px;">(The current file will be updated. Please leave this blank if you don't want to update.)</p>
                        <?php } ?>
                        <input type="hidden" name="filename" id="filename" value=""/>
                    </div>
                    <div id="shipping-fee-list"  <?php echo $isDownloadable ? 'style="display: none"' : '' ?>>
                        <div class="row">
                            <span class="titles">Shipping</span>
                        </div>

                        <div class="row" id="shipping_fee_cont">

                        </div>
                        <div class="row" style="padding-left: 130px;">
                            <a href="javascript:void(0)" class="btn_add_shipping_fee_field">Add New</a>
                        </div>

                    </div>

                    <?php if($view['type'] == 'relist' || $view['type'] == 'additem') : ?>
                        <div class="row">
                            <span class="titles">Listing Fee</span>
                        </div>
                        <div class="row" style="margin-bottom:0px;">
                            <span class="l" style="padding-top:3px;">
                                <input type="radio" name="listing_fee_type"
                                    value="<?php echo BuckysShopProduct::LIST_FEE_PAYMENT_TYPE_BTC; ?>"
                                    id="listing_fee_btc" <?php if($view['my_bitcoin_balance'] < SHOP_PRODUCT_LISTING_FEE_IN_BTC)
                                    echo 'disabled="disabled"' ?> >
                            </span>
                            <span class="inputholder"><label for="listing_fee_btc"
                                    class="r"><?php echo fn_buckys_get_btc_price_formated(SHOP_PRODUCT_LISTING_FEE_IN_BTC, true); ?> BTC
                                    <strong>(<?php echo $view['my_bitcoin_balance'] ?> available)</strong></label></span>

                            <div class="clear"></div>
                        </div>

                        <div class="row" style="margin-top:0px;">
                            <span class="l" style="padding-top:3px;">
                                <input type="radio" name="listing_fee_type"
                                    value="<?php echo BuckysShopProduct::LIST_FEE_PAYMENT_TYPE_CREDIT ?>"
                                    id="listing_fee_credit"  <?php if($view['my_credit_balance'] < SHOP_PRODUCT_LISTING_FEE_IN_CREDIT)
                                    echo 'disabled="disabled"' ?> >
                            </span>
                            <span class="inputholder"><label for="listing_fee_credit"
                                    class="r"><?php echo SHOP_PRODUCT_LISTING_FEE_IN_CREDIT ?> Credit
                                    <strong>(<?php echo floor($view['my_credit_balance']); ?> available)</strong></label></span>

                            <div class="clear"></div>
                        </div>

                    <?php endif; ?>

                    <div class="row">
                        <label for="">&nbsp;</label>
                        <span class="inputholder">
                            <input type="submit" value="Submit" class="redButton" name="submit" id="submit">
                        </span>

                        <div class="clear"></div>
                    </div>

                </form>
            </div>
        </div>

        <div class="clear"></div>

    </section>
</section>
