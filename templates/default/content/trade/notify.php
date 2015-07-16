<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}

$tradeNotifyInfo = $view['trade_user_info'];
if(!$tradeNotifyInfo)
    $tradeNotifyInfo = [];

?>



<section id="main_section">

    <?php buckys_get_panel('trade_top_search'); ?>

    <?php buckys_get_panel('trade_main_nav'); ?>
    <section id="right_side" class="floatright">

        <span class="titles">Send Me a Notification When...</span>

        <div>

            <?php if(isset($view['status'])) : ?>
                <p style="" class="message <?php if($view['status']['success'])
                    echo "success";else "error" ?>"><?php echo $view['status']['message']; ?></p>
            <?php endif; ?>

            <div class="trade-item-panel notify-setting-panel" style="padding:0px;">

                <form method="post" action="/trade/notify.php" onsubmit="validateNotifyForm();return false;"
                    id="notifyForm" style="padding-top:5px;">
                    <input type="hidden" value="saveNotifyInfo" name="action">

                    <div class="row" style="margin:0px;">
                        <div class="l">Someone makes me an offer</div>
                        <div class="r">
                            <input type="checkbox" name="optOfferReceived"
                                id="optOfferReceived" <?php if($tradeNotifyInfo['optOfferReceived'] == 1)
                                echo 'checked="checked"' ?> value="1"></div>
                        <div class="clear"></div>
                    </div>

                    <div class="row" style="margin:0px;">
                        <div class="l">Someone accepts my offer</div>
                        <div class="r">
                            <input type="checkbox" name="optOfferAccepted"
                                id="optOfferAccepted" <?php if($tradeNotifyInfo['optOfferAccepted'] == 1)
                                echo 'checked="checked"' ?> value="1"></div>
                        <div class="clear"></div>
                    </div>

                    <div class="row" style="margin:0px;">
                        <div class="l">Someone declines my offer</div>
                        <div class="r">
                            <input type="checkbox" name="optOfferDeclined"
                                id="optOfferDeclined" <?php if($tradeNotifyInfo['optOfferDeclined'] == 1)
                                echo 'checked="checked"' ?> value="1"></div>
                        <div class="clear"></div>
                    </div>

                    <div class="row" style="margin:0px;">
                        <div class="l">Feedback is received</div>
                        <div class="r">
                            <input type="checkbox" name="optFeedbackReceived"
                                id="optFeedbackReceived" <?php if($tradeNotifyInfo['optFeedbackReceived'] == 1)
                                echo 'checked="checked"' ?> value="1"></div>
                        <div class="clear"></div>
                    </div>

                    <div class="row" style="border:none;margin:0px;">
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
