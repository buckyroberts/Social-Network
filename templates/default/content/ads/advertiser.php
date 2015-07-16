<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <section id="main_content">
        <?php render_result_messages() ?>
        <h2 class="titles left">Advertiser Account</h2>
        <a href="/ads/create_ad.php" class="redButton top-right-button" style="">Create New Ad</a>

        <div class="clear"></div>
        <div class="advertisements-nav">
            <a href="/ads/advertiser.php?status=active" <?php echo $status == 'active' ? 'class="current"' : '' ?>>Active (<?php echo $activeAdsCount ?>)</a>
            &middot;
            <a href="/ads/advertiser.php?status=pending" <?php echo $status == 'pending' ? 'class="current"' : '' ?>>Pending Approval (<?php echo $pendingAdsCount ?>)</a>
            &middot;
            <a href="/ads/advertiser.php?status=expired" <?php echo $status == 'expired' ? 'class="current"' : '' ?>>Completed (<?php echo $expiredAdsCount ?>)</a>
        </div>
        <table cellpadding="0" cellspacing="3" class="adlist">
            <?php if(count($userAds) > 0){ ?>
                <thead>
                <tr>
                    <th style="padding-left: 0px;">ID</th>
                    <th>Name</th>
                    <th>Action</th>
                    <th>Start</th>
                    <th style="text-align:right;">Budget</th>
                    <th style="text-align:right;">Impressions</th>
                    <th style="text-align:right;">Received</th>
                    <th style="text-align:right;">Clicks</th>
                    <th style="text-align:right;">CTR</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($userAds as $row){ ?>
                    <tr>
                        <td style="padding-left: 0px;"><?php echo $row['id'] ?></td>
                        <td><a href="/ads/view.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></td>
                        <td><a href="/ads/view.php?id=<?php echo $row['id'] ?>">View</a></td>
                        <td><?php echo $row['startedDate'] == '0000-00-00 00:00:00' ? '-' : buckys_format_date($row['startedDate']); ?></td>
                        <td style="text-align:right;"><?php echo doubleval($row['budget']) ?> BTC</td>
                        <td style="text-align:right;"><?php echo number_format($row['impressions']) ?></td>
                        <td style="text-align:right;"><?php echo number_format($row['receivedImpressions']) ?></td>
                        <td style="text-align:right;"><?php echo $row['clicks'] ?></td>
                        <td style="text-align:right;">
                            <?php
                            if($row['receivedImpressions'] > 0)
                                echo round($row['clicks'] / $row['receivedImpressions'] * 100, 2);else
                                echo '0';
                            ?>
                            %
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            <?php } ?>
        </table>
        <div
            style="margin-left: -10px;padding-top: 10px;"><?php echo $pagination->renderPaginate('/ads/advertiser.php?status=' . $status . "&", count($userAds)) ?></div>
    </section>
</section>
