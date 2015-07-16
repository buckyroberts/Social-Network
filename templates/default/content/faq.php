<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>

<section id="main_section">
    <div class="static-page-wrap">
        <h2 class="titles">FAQ's</h2>

        <!-- General -->
        <h3 class="titles">General</h3>

        <div id="question">What is <?php echo TNB_SITE_NAME ?>?</div>
        <p><?php echo TNB_SITE_NAME ?> is a social network that was built for computer programmers, web designers, and tech enthusiast. However, anyone is welcome to join.</p>

        <div id="question">How do I upload a profile picture?</div>
        <p>When posting a photo, select the option "Use as Profile Photo" at the bottom. Additionally, you may visit your
            <a href="https://<?php echo TNB_DOMAIN ?>/photo_manage.php"
                target="_blank">Manage Photos</a> page after uploading a photo and click the "Set as Profile Photo" link.
        </p>

        <div id="question">Why didn't I receive a verification email?</div>
        <p>Check your Spam folder. Also, some users are reporting that certain email providers (such as Yahoo!) are blocking emails from <?php echo TNB_SITE_NAME ?>. If you do not receive a verification email within a few hours after registration, please use a different email provider.</p>

        <div id="question">What are credits?</div>
        <p>Credits can be used to list items in the <a href="https://<?php echo TNB_DOMAIN ?>/trade/"
                target="_blank">Trade</a> section or the <a href="https://<?php echo TNB_DOMAIN ?>/shop/"
                target="_blank">Shop</a> section of the website.</p>

        <div id="question">What is the difference between the "Public" and "Private" options?</div>
        <p>When something is public, anyone can see it. When it is private, only your friends are able to see it.</p>

        <div id="question">How do I report bugs?</div>
        <p>Please report bugs in the <a href="https://<?php echo TNB_DOMAIN ?>/forum/category.php?id=41"
                target="_blank">Bug Report</a> section of the forum. If you find a security vulnerability with the site, please send me a private message.
        </p>

        <div id="question">How do I create a new Page?</div>
        <p>Go to <a href="https://<?php echo TNB_DOMAIN ?>/account.php"
                target="_blank">your account</a>. On the left hand side under the Pages section, click on the "Create New Page" link.
        </p>

        <!-- Bitcoin -->
        <h3 class="titles">Bitcoin</h3>

        <div id="question">What is Bitcoin?</div>
        <p>Bitcoin is a digital currency. You can send and receive Bitcoin with <a
                href="https://<?php echo TNB_DOMAIN ?>/wallet.php" target="_blank">your Bitcoin wallet</a>. </p>

        <div id="question">How do I get Bitcoin?</div>
        <p>There are many ways to get Bitcoin. You can sell items in the <a
                href="https://<?php echo TNB_DOMAIN ?>/shop/"
                target="_blank">Shop</a> section and you will get paid in Bitcoin. You can buy Bitcoin online from companies such as
            <a href="https://coinbase.com/"
                target="_blank">https://coinbase.com/</a>. You can also buy Bitcoin in person from <a
                href="https://localbitcoins.com/" target="_blank">https://localbitcoins.com/</a>.</p>

        <div id="question">How do I send Bitcoin?</div>
        <p>When you visit a users profile page, click the link under their profile photo that says "View Bitcoin Address". Copy that address and use it to send Bitcoin to users with
            <a href="https://<?php echo TNB_DOMAIN ?>/wallet.php" target="_blank">your Bitcoin wallet</a>.</p>

        <div id="question">Is there a transaction fee when sending Bitcoin?</div>
        <p>The current transaction fee when sending Bitcoin is <?php echo BLOCKCHAIN_FEE; ?> BTC.</p>

        <!-- Ads -->
        <h3 class="titles">Ads</h3>

        <div id="question">What is BuckysRoomAds?</div>
        <p>It is an platform that allows advertisers to create and purchase online advertisements with Bitcoin. Additionally, any website owner can earn Bitcoin by placing these ads on their website.</p>

        <div id="question">Why am I earning Bitcoin?</div>
        <p>All users will have default ads that will appear on their <?php echo TNB_SITE_NAME ?> content. That means that you will earn Bitcoin every time someone views your profile, pages that you created, or forum discussions that you participated in.</p>

        <div id="question">So I will earn Bitcoin just by using this site?</div>
        <p>Yes.</p>

        <div id="question">How and when do I get paid?</div>
        <p>You will get paid once a week, if your current balance is above <?php echo ADS_MINIMUM_PAYOUT_BALANCE; ?> BTC. All payments will be sent directly to
            <a href="https://<?php echo TNB_DOMAIN ?>/wallet.php" target="_blank">your Bitcoin wallet</a>.</p>

        <div id="question">Advertisers - what types of ads are not allowed?</div>
        <p style="margin-bottom: 0;">Restricted ads include products are services related to the following:</p>
        <ul>
            <li>Alcohol</li>
            <li>Drugs</li>
            <li>Counterfeit Money/Documents</li>
            <li>Explosives</li>
            <li>Hacking</li>
            <li>Pornography</li>
            <li>Any other content that we feel is inappropriate</li>
        </ul>

        <div id="question">Publishers - what websites are not allowed to display BuckysRoomAds?</div>
        <p style="margin-bottom: 0;">Publishers may not place ads on any websites containing prohibited content. This includes, but is not limited to:</p>
        <ul>
            <li>Excessive violence</li>
            <li>Hacking content</li>
            <li>Illegal drugs or alcohol related content</li>
            <li>Websites promoting illegal activity</li>
            <li>Websites that display copyrighted material</li>
        </ul>

        <div id="question">Publishers - how many ads can I display per webpage?</div>
        <p>Three.</p>

        <div id="question">Publishers - why were my ads disabled?</div>
        <p><?php echo TNB_SITE_NAME ?> owner, administrators, and moderators reserve the right to cancel, delete, or disable all ads at any time. We will disable your ads if we feel that they violate the Terms of Service or otherwise inappropriate behavior. There is also an algorithm that detects and disables ads due to impression fraud caused by bots, manual refreshing, and other unauthentic behavior.</p>

        <div id="question">Publishers - how is impression fraud dealt with?</div>
        <p>We reserve the right to delete any account that we believe is generating false impressions through the use of bots, manual refreshing, and other unauthentic behavior. Any accounts found to be responsible for impression fraud will be deleted without warning. All Bitcoin associated with those account will not be refunded.</p>

        <!-- Trade -->
        <h3 class="titles">Trade</h3>

        <div id="question">What is BuckysRoomTrade?</div>
        <p>
            <a href="https://<?php echo TNB_DOMAIN ?>/trade/"
                target="_blank">BuckysRoomTrade</a> is a section of the website where users can trade items (such as book, video games, clothes, etc...) with each other.
        </p>

        <div id="question">How long are items listed for?</div>
        <p>Items will remain listed for 7 days.</p>

        <div id="question">What items are not allowed?</div>
        <p>Please see the Terms or Service for a list of prohibited items.</p>

        <div id="question">When an item is traded, who pays for shipping?</div>
        <p>Each user is responsible for shipping their item.</p>

        <!-- Shop -->
        <h3 class="titles">Shop</h3>

        <div id="question">What is BuckysRoomShop?</div>
        <p>
            <a href="https://<?php echo TNB_DOMAIN ?>/shop/"
                target="_blank">BuckysRoomShop</a> is a section of the website where users are able to buy and sell items using Bitcoin.
        </p>

        <div id="question">How long are items listed for?</div>
        <p>Items will remain listed for 7 days.</p>

        <div id="question">What items are not allowed?</div>
        <p>Please see the <a href="https://<?php echo TNB_DOMAIN ?>/terms_of_service.php"
                target="_blank">Terms or Service</a> for a list of prohibited items.
        </p>

</section>
</section>