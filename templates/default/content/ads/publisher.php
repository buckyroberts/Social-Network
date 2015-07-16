<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <section id="main_content">
        <?php render_result_messages() ?>
        <h2 class="titles left">Publisher Panel</h2>
        <span class="titles top-right">Current Earnings: <span
                style="color: #16A085;"><?php echo $userBalance ?> BTC</span></span>

        <div class="clear"></div>
        <div class="advertisements-nav">
            <a href="/ads/publisher.php?status=active" <?php echo $status == 'active' ? 'class="current"' : '' ?>>Active (<?php echo $activeAdsCount ?>)</a>
            &middot;
            <a href="/ads/publisher.php?status=deleted" <?php echo $status == 'deleted' ? 'class="current"' : '' ?>>Deleted (<?php echo $deletedAdsCount ?>)</a>
        </div>
        <table cellpadding="0" cellspacing="3" class="adlist">
            <?php if(count($userAds) > 0){ ?>
                <thead>
                <tr>
                    <th style="padding-left: 0px;">ID</th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Action</th>
                    <th style="text-align:right;">Impressions</th>
                    <th style="text-align:right;">Earnings (BTC)</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $amountPerImpression = (ADS_PRICE_FOR_THOUSAND_IMPRESSIONS * ADS_PUBLISHER_PERCENTAGE) / 1000;
                foreach($userAds as $row){
                    $unpaidImpressions = $row['impressions'] - $row['paidImpressions'];
                    $totalAdEarnings = $unpaidImpressions * $amountPerImpression;
                    ?>
                    <tr>
                        <td style="padding-left: 0px;"><?php echo $row['id']?></td>
                        <td>
                            <a href="/ads/publisher_ad_view.php?id=<?php echo $row['id']?>"><?php echo $row['name']?></a>
                        </td>
                        <td><?php echo $row['size_name']?></td>
                        <td>
                            <a href="/ads/publisher_ad_view.php?id=<?php echo $row['id']?>">Get Code</a>
                            <?php if($row['adType'] == TNB_AD_TYPE_CUSTOM){
                                if($status == 'active'){
                                    ?>
                                    &middot;
                                    <a href="/ads/publisher.php?id=<?php echo $row['id']?>&action=delete-ad&<?php echo buckys_get_form_token()?>=1">Delete</a>
                                <?php } ?>
                            <?php } ?>
                        </td>
                        <td style="text-align:right;"><?php echo number_format($unpaidImpressions)?></td>
                        <td style="text-align:right;">
                            <?php
                            if($totalAdEarnings > 0)
                                echo '<span style="color:#16A085;">' . number_format($totalAdEarnings, 8) . '</span>';else
                                echo '<span style="color:#999999;">0</span>';
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            <?php } ?>
        </table>
        <div style="padding: 10px 0px 5px 0px;">
            <a href="/ads/create_publisher_ad.php" class="redButton">Create Publisher Ad</a></div>
        <div
            style="margin-left: -10px;"><?php echo $pagination->renderPaginate('/ads/publisher.php?status=' . $status . "&", count($userAds)) ?></div>
    </section>
</section>
