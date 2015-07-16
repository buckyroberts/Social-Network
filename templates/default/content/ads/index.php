<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section" class="ads-index-page">
    <section id="main_content">
        <img src="<?php echo DIR_WS_IMAGE ?>ads/main_ads_banner.png" alt="<?php echo TNB_SITE_NAME ?> Ads"
            style="border:1px solid #cccccc; margin-top:5px; display:block;"/>

        <div class="advertisers-col">
            <h2>
                Advertisers <br/> <span style="font-size:18px;">Pay for ads with Bitcoin!</span>
            </h2>

            <p>
                1,000 impressions for only <?php echo ADS_PRICE_FOR_THOUSAND_IMPRESSIONS ?> BTC<br/> Reach new customers and grow your business<br/> Boost website traffic and sales
            </p>

            <div class="btn-row">
                <a href="/ads/advertiser.php" class="redButton"
                    style="font-size:14px;border-radius:5px;"><?php if(!buckys_check_user_acl(USER_ACL_REGISTERED))
                        echo "Get Started Now";else echo "Advertiser Account"; ?></a>
            </div>
            <br/><br/><br/><br/><br/><br/>
        </div>
        <div class="publishers-col">
            <h2>
                Publishers <br/> <span style="font-size:18px;">Earn Bitcoin by placing ads on your website!</span>
            </h2>

            <p>
                Get paid weekly<br/> Instant approval<br/> Easy to create and manage ads
            </p>

            <div class="btn-row">
                <a href="/ads/publisher.php" class="redButton"
                    style="font-size:14px;border-radius:5px;"><?php if(!buckys_check_user_acl(USER_ACL_REGISTERED))
                        echo "Start Earning Bitcoin";else echo "Publisher Panel"; ?></a>
            </div>
            <br/><br/><br/><br/><br/><br/>
        </div>
        <div class="clear"></div>
        <br/>

        <div>
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
    </section>
</section>
