<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <section id="main_content">
        <?php render_result_messages(); ?>

        <div id="ad-detail-contr">
            <h2 class="titles">Ad Detail</h2>
            <br/>

            <div class="row">
                <label>Ad Type:</label>
                <?php echo $adDetail['type']; ?>
            </div>
            <div class="row">
                <label>Status:</label>
                <?php
                switch($adDetail['status']){
                    case TNB_AD_STATUS_ACTIVE:
                        echo 'Active';
                        break;
                    case TNB_AD_STATUS_PENDING:
                        echo 'Pending';
                        break;
                    case TNB_AD_STATUS_EXPIRED:
                        echo 'Completed';
                        break;

                }
                ?>
            </div>
            <div class="row">
                <label>ID:</label>
                <?php echo $adDetail['id']; ?>
            </div>
            <div class="row">
                <label>Started:</label>
                <?php
                echo $adDetail['startedDate'] != '0000-00-00 00:00:00' ? buckys_format_date($adDetail['startedDate']) : '-';
                ?>
            </div>
            <div class="row">
                <label>Name of Ad:</label>
                <?php
                echo $adDetail['name'];
                ?>
            </div>
            <?php if($adDetail['type'] == 'Text'): ?>
                <div class="row">
                    <label>Title:</label>
                    <?php
                    echo $adDetail['title'];
                    ?>
                </div>
                <div class="row">
                    <label>Description:</label>
                    <?php
                    echo $adDetail['description'];
                    ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <label>Url:</label> <a href="<?php echo $adDetail['url']; ?>">
                    <?php
                    echo $adDetail['url'];
                    ?>
                </a>
            </div>
            <?php if($adDetail['type'] == 'Text'): ?>
                <div class="row">
                    <label>Display Url:</label>
                    <?php
                    echo $adDetail['display_url'];
                    ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <label>Budget:</label>
                <?php
                echo doubleval($adDetail['budget']);
                ?>
                BTC
            </div>
            <div class="row">
                <label>Impressions:</label>
                <?php
                echo number_format($adDetail['impressions']);
                ?>
            </div>
            <div class="row">
                <label>Received:</label>
                <?php
                echo number_format($adDetail['receivedImpressions']);
                ?>
            </div>
            <div class="row">
                <label>Clicks:</label>
                <?php
                echo number_format($adDetail['clicks']);
                ?>
            </div>
            <div class="row">
                <label>CTR:</label>
                <?php
                if($adDetail['receivedImpressions'] > 0)
                    echo round($adDetail['clicks'] / $adDetail['receivedImpressions'] * 100, 2);else
                    echo '0';
                ?>
                %
            </div>
        </div>

        <div id="add-ad-funds">
            <h2 class="titles">Add Funds</h2>
            <br/>

            <form name="addfunform" id="addfunform" method="post" action="/ads/view.php">
                <div class="row">
                    <label>Amount:</label> <span class="inputholder"><input type="text" name="amount" id="amount"
                            class="input" value="0"/></span> BTC
                </div>
                <div class="row impressions-row">
                    <label>Impressions: </label> <span class="desc">0</span>

                    <div class="clear"></div>
                </div>
                <div class="btn-row"><input type="submit" value="Submit" class="redButton"/></div>
                <input type="hidden" name="action" value="add-funds"/> <input type="hidden" name="id"
                    value="<?php echo $adID ?>"/>
                <?php
                render_form_token();
                ?>
            </form>
        </div>
        <div class="clear"></div>
        <div id="ad-detail-preview">
            <h2 class="titles">Preview</h2>
            <?php if($adDetail['type'] == 'Text'): ?>
                <div class="text-ad">
                    <p class="title"><?php echo $adDetail['title'] ?></p>

                    <p class="desc"><?php echo $adDetail['description'] ?></p>
                    <a href="<?php echo $adDetail['url'] ?>" class="link"><?php echo $adDetail['display_url'] ?></a>
                </div>
            <?php else: ?>
                <div class="img-ad">
                    <a href="<?php echo $adDetail['url'] ?>"><img
                            src="<?php echo DIR_WS_IMAGE ?>user_ads/<?php echo $adDetail['fileName'] ?>"/></a>
                </div>
            <?php endif; ?>
        </div>
        <div class="clear"></div>
    </section>
</section>
<script type="text/javascript">
    jQuery(document).ready(function (){
        jQuery('#addfunform #amount').on('input', function (){
            if(isNaN(this.value))
                jQuery('#addfunform .impressions-row .desc').html(0);else{
                jQuery('#addfunform .impressions-row .desc').html(Math.round(parseFloat(this.value) / 0.0001 * 1000));
                jQuery('#addfunform .impressions-row .desc').number(true);
            }
        })

        jQuery('#addfunform').submit(function (){
            hideMessage(jQuery('#addfunform'));
            jQuery('#addfunform #amount').removeClass('input-error');
            if(jQuery('#addfunform #amount').val() == '' || isNaN(jQuery('#addfunform #amount').val()) || parseInt(jQuery('#addfunform #amount').val()) == 0){
                showMessage(jQuery('#addfunform'), 'Please enter valid amount.', 'error');
                jQuery('#addfunform #amount').addClass('input-error');
                return false;
            }

            return true;
        })
    })
</script>