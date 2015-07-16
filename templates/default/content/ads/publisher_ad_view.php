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
                <label>Ad Size:</label>
                <?php echo $adDetail['size_name']; ?>
            </div>
            <div class="row">
                <label>Name of Ad:</label>
                <?php echo $adDetail['name']; ?>
            </div>
            <div class="row">
                <label>Border:</label> #<?php echo $adDetail['borderColor']; ?>
            </div>
            <div class="row">
                <label>Background:</label> #<?php echo $adDetail['bgColor']; ?>
            </div>
            <div class="row">
                <label>Title:</label> #<?php echo $adDetail['titleColor']; ?>
            </div>
            <div class="row">
                <label>Description:</label> #<?php echo $adDetail['textColor']; ?>
            </div>
            <div class="row">
                <label>URL:</label> #<?php echo $adDetail['urlColor']; ?>
            </div>
            <div class="row">
                <label>Impressions:</label>
                <?php
                $unpaidImpressions = $adDetail['impressions'] - $adDetail['paidImpressions'];
                echo number_format($unpaidImpressions);
                ?>
            </div>
            <div class="row">
                <label>Earnings:</label>
                <?php
                $amountPerImpression = (ADS_PRICE_FOR_THOUSAND_IMPRESSIONS * ADS_PUBLISHER_PERCENTAGE) / 1000;
                $totalAdEarnings = $unpaidImpressions * $amountPerImpression;
                if($totalAdEarnings > 0)
                    echo '<span style="color:#16A085;">' . number_format($totalAdEarnings, 8) . ' BTC</span>';else
                    echo '0 BTC';
                ?>
            </div>
        </div>

        <div id="right-ad-detail">
            <h2 class="titles">Ad Detail</h2>
            <br/>

            <p>Highlight and copy the HTML code below, then paste it into the code for your website</p>
			<pre class="ad-code onclick-select-all">
&lt;script type="text/javascript"&gt;
buckysroom_ad_width = "<?php echo $sizeDetail['width'] ?>";
buckysroom_ad_height = "<?php echo $sizeDetail['height'] ?>";
buckysroom_ad_token = "<?php echo $adDetail['token'] ?>";
&lt;/script&gt;
&lt;script type="text/javascript" src="//<?php echo TNB_DOMAIN ?>/ad.js.php"&gt;&lt;/script&gt;</pre>
        </div>

        <div class="clear"></div>

        <div id="ad-detail-preview">
            <h2 class="titles">Preview</h2>

            <div class="buckysroom-ad-banner" style="margin-top:10px;">
                <table cellpadding="0" cellspacing="0"
                    style="width: <?php echo $sizeDetail['width'] ?>px; height: <?php echo $sizeDetail['height'] ?>px; background-color: #<?php echo $adDetail['bgColor']; ?>; border:1px solid #<?php echo $adDetail['borderColor']; ?>;">
                    <?php for($i = 0; $i < $sizeDetail['ads']; $i++): ?>
                        <?php if($sizeDetail['type'] != 'horizontal' || $i == 0): ?>
                            <tr>
                        <?php endif; ?>

                        <td>
                            <div class="buckysroom-ad">
                                <p class="bsroom-ad-title" style="text-decoration:none;">
                                    <span
                                        style="color: #<?php echo $adDetail['titleColor']; ?>;"><?php echo TNB_SITE_NAME ?> Bitcoin Ad Network</span>
                                </p>

                                <p class="bsroom-ad-desc">
                                    <span
                                        style="color: #<?php echo $adDetail['textColor']; ?>;">Place ads on your website and earn Bitcoin!</span>
                                </p>
                                <a href="#" class="bsroom-ad-link"><span
                                        style="color: #<?php echo $adDetail['urlColor']; ?>;"><?php echo TNB_DOMAIN ?>/ads</span></a>
                            </div>
                        </td>
                        <?php if($sizeDetail['type'] != 'horizontal' || $i == ($sizeDetail['ads'] - 1)): ?>
                            </tr>
                        <?php endif; ?>
                    <?php endfor; ?>
                </table>
            </div>
        </div>

        <div class="clear"></div>
    </section>
</section>
