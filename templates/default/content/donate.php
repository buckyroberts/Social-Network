<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>

<section id="main_section">
    <div class="static-page-wrap">
        <h2 class="titles">Donate</h2>

        <p>Feel free to donate to help support <?php echo TNB_SITE_NAME ?>. All contributions will be used to improve the website and will help us build a bigger and better community.</p>

        <p>Donation Bitcoin Address: <b>16FCD5zrkJp6AqfDm3j6LBWNYx1Gard2Z1</b></p>
        <!-- <h3>Heading Three Sample</h3> -->
        <img src="/images/qr_donate_code.png" style="float:left;">

        <div style="margin-top:32px;margin-left:20px;float:left;">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick"> <input type="hidden" name="hosted_button_id"
                    value="NYUBMLNQRHFPW"> <input type="image"
                    src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit"
                    alt="PayPal - The safer, easier way to pay online!"> <img alt="" border="0"
                    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>
</section>
</section>