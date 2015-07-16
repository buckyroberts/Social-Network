<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}

$tradeShippingInfo = $view['trade_user_info'];

?>



<section id="main_section">

    <?php buckys_get_panel('account_links'); ?>
    <section id="right_side_padding" class="user-info-section">

        <?php echo buckys_get_messages(); ?>

        <span class="titles">Shipping Info</span><br/>

        <div>

            <div class="trade-item-panel" style="padding-top:0px;">

                <?php if(isset($view['status'])) : ?>
                    <p style="" class="message <?php if($view['status']['success'])
                        echo "success";else "error" ?>"><?php echo $view['status']['message']; ?></p>
                <?php endif; ?>

                <form method="post" action="/shipping_info.php" onsubmit="validateShippingInfoForm();return false;"
                    id="shippingInfoForm" style="padding-top:5px;">
                    <input type="hidden" value="saveShippingInfo" name="action">
                    <!--<div class="row">
                        <label for="shippingAddress">Full Name:</label>
                        <span class="inputholder"><input type="text" value="<?php echo $tradeShippingInfo['shippingFullName']; ?>" class="input" name="shippingFullName" id="shippingFullName"></span>
                        <div class="clear"></div>
                    </div>-->
                    <div class="row">
                        <label for="shippingAddress">Address:</label> <span class="inputholder"><input type="text"
                                value="<?php echo $tradeShippingInfo['shippingAddress']; ?>" class="input"
                                name="shippingAddress" id="shippingAddress"></span>

                        <div class="clear"></div>
                    </div>
                    <div class="row">
                        <label for="shippingAddress">Address 2:</label> <span class="inputholder"><input type="text"
                                value="<?php echo $tradeShippingInfo['shippingAddress2']; ?>" class="input"
                                name="shippingAddress2" id="shippingAddress2"></span>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <label for="shippingCity">City:</label> <span class="inputholder"><input type="text"
                                value="<?php echo $tradeShippingInfo['shippingCity']; ?>" class="input"
                                name="shippingCity" id="shippingCity"></span>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <label for="shippingState">State:</label> <span class="inputholder"><input type="text"
                                value="<?php echo $tradeShippingInfo['shippingState']; ?>" class="input"
                                name="shippingState" id="shippingState"></span>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <label for="shippingZip">Zip:</label> <span class="inputholder"><input type="text"
                                value="<?php echo $tradeShippingInfo['shippingZip']; ?>" class="input"
                                name="shippingZip" id="shippingZip"></span>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <label for="shippingCountryID">Country:</label>
                        <span class="inputholder">
                            <select class="input select" name="shippingCountryID" id="shippingCountryID">
                                <option value=""> - Select -</option>
                                <?php
                                if(count($view['country_list']) > 0){
                                    foreach($view['country_list'] as $countryData){

                                        $selected = '';
                                        if($tradeShippingInfo['shippingCountryID'] == $countryData['countryID'])
                                            $selected = 'selected="selected"';

                                        echo sprintf('<option value="%d" %s>%s</option>', $countryData['countryID'], $selected, $countryData['country_title']);
                                    }
                                }
                                ?>
                            </select>
                        </span>

                        <div class="clear"></div>
                    </div>

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
