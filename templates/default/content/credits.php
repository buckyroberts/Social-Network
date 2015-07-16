<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}


$paypalSetting = [];

if(TNB_PAYPAL_MODE_LIVE == true){
    $paypalSetting['url'] = 'https://www.paypal.com/cgi-bin/webscr';
    $paypalSetting['merchant_email'] = TNB_PAYPAL_EMAIL;
}else{
    $paypalSetting['url'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    $paypalSetting['merchant_email'] = TNB_PAYPAL_SANDBOX_EMAIL;
}



?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <?php echo render_result_messages() ?>
            <div id="send-credits">
                <h2 class="titles">Send Credits</h2>

                <form name="sendcreditsform" id="sendcreditsform" action="/credits.php" method="post">
                    <div class="row" id="receiverholder">
                        <label>To: </label> <input type="text" class="input" name="receiver" id="receiver"/>

                        <div class="clear"></div>
                    </div>
                    <div class="row">
                        <label>Amount: </label> <input type="text" class="input" name="amount" id="amount"/>

                        <div class="clear"></div>
                    </div>
                    <div class="row">
                        <label>&nbsp;</label> <input type="submit" id="send-credits-btn" value="Send Credits"
                            class="redButton"/>

                        <div class="clear"></div>
                    </div>
                    <input type="hidden" name="action" value="send-money"/>
                </form>
            </div>
            <div id="purchase-credits">
                <h2 class="titles">Purchase Credits</h2>
                <br/>

                <div class="row">
                    <input type="radio" name="credits" id="credits10" value="3.5"/> <label
                        for="credits10">10 Credits for $3.50 <span
                            style="color:#999999;font-size:11px;">(35&cent; per credit)</span></label>
                </div>
                <div class="row">
                    <input type="radio" name="credits" id="credits50" value="15"/> <label
                        for="credits50">50 Credits for $15.00 <span
                            style="color:#999999;font-size:11px;">(30&cent; per credit)</span></label>
                </div>
                <div class="row">
                    <input type="radio" name="credits" id="credits100" value="25"/> <label
                        for="credits100">100 Credits for $25.00 <span
                            style="color:#999999;font-size:11px;">(25&cent; per credit)</span></label>
                </div>
                <div class="row">
                    <input type="button" value="Buy Now" class="redButton" id="purchase_credits_btn"/>
                </div>

                <form id="paypalForm" action="<?php echo $paypalSetting['url']; ?>" method="post">

                    <input type="hidden" name="business" value="<?php echo $paypalSetting['merchant_email']; ?>"> <input
                        type="hidden" name="cmd" value="_xclick"> <input type="hidden" name="currency_code"
                        value="<?php echo TNB_PAYPAL_CURRENCY; ?>">

                    <!-- should be set by javascript -->
                    <input type="hidden" name="item_name" value=""> <input type="hidden" name="amount" value=""> <input
                        type="hidden" name="custom" value="<?php echo $TNB_GLOBALS['payerID']; ?>"/>

                    <!-- return url setting -->
                    <input type="hidden" name="notify_url" value="<?php echo TNB_PAYPAL_NOTIFY_URL; ?>"> <input
                        type="hidden" name="return" value="<?php echo TNB_PAYPAL_RETURN_URL; ?>"> <input
                        type="hidden" name="cancel_return" value="<?php echo TNB_PAYPAL_CANCEL_RETURN_URL; ?>">

                    <!-- Shipping and Misc Information -->
                    <input type="hidden" name="no_shipping" value="1"> <input type="hidden" name="shipping_1" value="0">
                    <input type="hidden" name="no_note" value="1"> <input type="hidden" name="bn" value="PP-BuyNowBF">
                    <input type="hidden" name="rm" value="2">

                </form>

            </div>
            <div class="clear"></div>
            <div id="credits-activities">
                <h2 class="titles">Recent Activity</h2>

                <div class="row">
                    <div class="table">
                        <?php if(count($activities) > 0){ ?>
                            <div class="thead">
                                <div class="td td-type">Type</div>
                                <div class="td td-name">Name</div>
                                <div class="td td-amount">Amount</div>
                                <div class="td td-balance">Balance</div>
                                <div class="td td-date">Date</div>
                                <div class="clear"></div>
                            </div>
                            <?php foreach($activities as $row){ ?>
                                <div class="tr">
                                    <div class="td td-type">
                                        <?php
                                        if($row['payerID'] == 0 && $row['activityType'] == BuckysTransaction::ACTIVITY_TYPE_DEPOSIT_BY_PAYPAL)
                                            echo 'Deposit';else if($row['payerID'] == $TNB_GLOBALS['user']['userID'])
                                            echo 'Payment To';else if($row['receiverID'] == $TNB_GLOBALS['user']['userID'])
                                            echo 'Payment From';else
                                            echo 'Paycheck';
                                        ?>
                                    </div>
                                    <div class="td td-name">
                                        <?php

                                        if($row['activityType'] == BuckysTransaction::ACTIVITY_TYPE_TRADE_ITEM_ADD){
                                            echo '<span>Trade Listing Fee</span>';
                                        }else if($row['activityType'] == BuckysTransaction::ACTIVITY_TYPE_PAYMENT_TO_OTHER){
                                            if($row['payerID'] == $TNB_GLOBALS['user']['userID']){
                                                echo sprintf('<a href="/profile.php?user=%s">%s</a>', $row['receiverID'], $row['receiverName']);
                                            }else{
                                                echo sprintf('<a href="/profile.php?user=%s">%s</a>', $row['payerID'], $row['payerName']);
                                            }
                                        }else if($row['activityType'] == BuckysTransaction::ACTIVITY_TYPE_DEPOSIT_BY_PAYPAL){
                                            echo '<span>Purchase credits</span>';
                                        }else if($row['activityType'] == BuckysTransaction::ACTIVITY_TYPE_SHOP_PRODUCT_ADD){
                                            echo '<span>Shop Listing Fee</span>';
                                        }

                                        ?>

                                    </div>
                                    <div class="td td-amount">
                                        <?php
                                        if($row['receiverID'] == $TNB_GLOBALS['user']['userID'])
                                            echo '<span style="color:#16A085;">';else
                                            echo '<span style="color:#C0392B;">-';

                                        echo number_format($row['amount'], 2);
                                        echo '</span>';
                                        ?>
                                    </div>
                                    <div class="td td-balance">
                                        <?php
                                        if($row['payerID'] == 0 || $row['receiverID'] == $TNB_GLOBALS['user']['userID'])
                                            echo number_format($row['receiverBalance'], 2);else
                                            echo number_format($row['payerBalance'], 2);
                                        ?>
                                    </div>
                                    <div class="td td-date">
                                        <?php echo buckys_format_date($row['createdDate'], "F j, Y"); ?>
                                        <?php /* echo buckys_format_date($row['createdDate'], "F j, Y h:i A"); */ ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            <?php } ?>
                            <br/>
                            <?php $pagination->renderPaginate('/credits.php?', count($activities)); ?>
                        <?php }else{ ?>
                            <div class="tr noborder">
                                Nothing to see here.
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>