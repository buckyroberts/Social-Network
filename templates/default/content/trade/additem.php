<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>

<script type="text/javascript">
    <?php if (isset($view['item'])) :?>
    var current_img_files = <?php if ($view['item']['images'] != '') echo json_encode(explode("|", $view['item']['images'])); else echo json_encode([]);?>;
    <?php else :?>
    var current_img_files = [];
    <?php endif;?>
</script>


<?php if($view['no_cash']) : ?>
    <script type="text/javascript">
        // FreeTradeListings - uncomment to enable listing fees
        // var noCashFlag = true;
    </script>
<?php endif; ?>


<section id="main_section">

    <?php buckys_get_panel('trade_top_search'); ?>

    <?php buckys_get_panel('trade_main_nav'); ?>
    <section id="right_side" class="floatright">

        <div><span class="titles"><?php echo $view['page_title']; ?></span></div>


        <?php if($view['no_cash']) : ?>
            <!-- FreeTradeListings - uncomment to enable listing fees
            <p class="message error">You have not enough credits. Click <a href="/credits.php" style="color:white;text-decoration:underline">here</a> to purchase credits. Or put bitcoins in your <a href="/wallet.php" style="color:white;text-decoration:underline">wallet</a>.</p>
            -->
        <?php endif; ?>



        <?php if($view['type'] == 'relist') : ?>
            <!--
            <div class="special-note">
                Please select the days that you want to relist this item more. <br/>
                <span>Note: It requires 1 credit to relist item.</span>
            </div>
            -->
        <?php endif; ?>

        <div>

            <div class="trade-item-panel" style="padding-top:0px;">
                <form method="post" id="tradeEditForm" style="padding-top:10px;">

                    <input type="hidden" id="actionName" value="<?php echo $view['action_name']; ?>"> <input
                        type="hidden" id="itemID" value="<?php if(isset($view['item']))
                        echo $view['item']['itemID']; ?>"> <input type="hidden" id="actionType"
                        value="<?php if(isset($view['type']))
                            echo $view['type']; ?>">

                    <div class="row">
                        <label for="title">Title:</label>
                        <span class="inputholder"><input type="text" value="<?php if(isset($view['item']))
                                echo $view['item']['title']; ?>" class="input" name="title" id="title"
                                maxlength="80"></span>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <label for="subtitle">Subtitle:</label>
                        <span class="inputholder"><input type="text" value="<?php if(isset($view['item']))
                                echo $view['item']['subtitle']; ?>" class="input" name="subtitle" id="subtitle"
                                maxlength="60"></span>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <label for="description">Description:</label>
                        <span class="inputholder"><textarea class="input inputdesc" name="description" id="description"
                                maxlength="5000"><?php if(isset($view['item']))
                                    echo $view['item']['description']; ?></textarea></span>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <label for="items_wanted">Items Wanted:</label>
                        <span class="inputholder"><input class="input" name="items_wanted" id="items_wanted"
                                maxlength="500" value="<?php if(isset($view['item']))
                                echo $view['item']['itemWanted']; ?>"></span>

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

                                        if(isset($view['item']) && $view['item']['catID'] == $catData['catID'])
                                            $selected = 'selected="selected"';

                                        echo sprintf('<option value="%d" %s>%s</option>', $catData['catID'], $selected, $catData['name']);
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
                    $currDuration = isset($view['item']) ? $view['item']['listingDuration'] : 14;
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
                            </select>
                        </span>
                    </div>

                    <div class="clear"></div>
                    <div class="row">
                        <label for="location">Item Location:</label>
                        <span class="inputholder">
                            <select class="select" name="location" id="location">
                                <option value=""> - Select -</option>
                                <?php
                                if(count($view['country_list']) > 0){
                                    foreach($view['country_list'] as $countryData){

                                        $selected = '';
                                        if(isset($view['item']) && $view['item']['locationID'] == $countryData['countryID'])
                                            $selected = 'selected="selected"';

                                        echo sprintf('<option value="%d" %s>%s</option>', $countryData['countryID'], $selected, $countryData['country_title']);
                                    }
                                }
                                ?>
                            </select>
                        </span>

                        <div class="clear"></div>
                    </div>

                    <?php if($view['type'] == 'relist' || $view['type'] == 'additem') : ?>
                        <!-- FreeTradeListings - uncomment to enable listing fees
                        <div class="row">
                            <span class="titles">Listing Fee</span>
                        </div>
                        <div class="row" style="margin-bottom:0px;">
                            <span class="l" style="padding-top:3px;">
                                <input type="radio" name="listing_fee_type" value="<?php echo BuckysTradeItem::LIST_FEE_PAYMENT_TYPE_BTC; ?>" id="listing_fee_btc" <?php if($view['my_bitcoin_balance'] < TRADE_ITEM_LISTING_FEE_IN_BTC)
                            echo 'disabled="disabled"' ?> >
                            </span>
                            <span class="inputholder"><label for="listing_fee_btc" class="r"><?php echo fn_buckys_get_btc_price_formated(TRADE_ITEM_LISTING_FEE_IN_BTC, true); ?> BTC <strong>(<?php echo $view['my_bitcoin_balance'] ?> available)</strong></label></span>
                            <div class="clear"></div>
                        </div>
                        
                        <div class="row" style="margin-top:0px;">
                            <span class="l" style="padding-top:3px;">
                                <input type="radio" name="listing_fee_type" value="<?php echo BuckysTradeItem::LIST_FEE_PAYMENT_TYPE_CREDIT ?>" id="listing_fee_credit"  <?php if($view['my_credit_balance'] < TRADE_ITEM_LISTING_FEE_IN_CREDIT)
                            echo 'disabled="disabled"' ?> >
                            </span>
                            <span class="inputholder"><label for="listing_fee_credit" class="r"><?php echo TRADE_ITEM_LISTING_FEE_IN_CREDIT ?> Credit <strong>(<?php echo floor($view['my_credit_balance']); ?> available)</strong></label></span>
                            <div class="clear"></div>
                        </div>
						-->
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
