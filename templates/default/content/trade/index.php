<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}

$topTenUsers = $view['top_users'];
$topTenWantedItems = $view['top_wanted_items'];
// $topTenRecentItems = $view['recent_items'];

?>

<section id="main_section">
    <?php buckys_get_panel('trade_top_search'); ?>


    <?php
    $tradeCatIns = new BuckysTradeCategory();
    $categoryList = $tradeCatIns->getCategoryList(0);
    ?>

    <aside id="main_aside" class="main_aside_wide">
        <ul class="left-trade-cat-list">
            <li><a href="/trade/search.php?sort=endsoon">All Categories</a></li>
            <?php
            if(count($categoryList) > 0){
                foreach($categoryList as $catData){
                    echo sprintf('<li><a href="/trade/search.php?cat=%s">%s</a></li>', urlencode($catData['name']), $catData['name']);
                }
            }
            ?>
        </ul>
        <?php
        if(buckys_is_logged_in()){
            echo '
				<div style="text-align:center;margin-bottom:10px;">
					<iframe src="https://rcm-na.amazon-adsystem.com/e/cm?t=thenewbosto0d-20&o=1&p=21&l=ur1&category=software&banner=04NQMHW01WEJR8NDJFR2&f=ifr&linkID=ABPSI74EVTUHMPG4" width="125" height="125" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
				</div>';
        }else{
            echo '
				<div style="text-align:center;margin-bottom:10px;">
					<iframe src="https://rcm-na.amazon-adsystem.com/e/cm?t=thenewbosto0d-20&o=1&p=21&l=ur1&category=software&banner=1C5F3C0ZZR6CRRN26482&f=ifr&linkID=DPEAITK5A6CXBVMI" width="125" height="125" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
				</div>';
        }
        ?>
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
    </aside>

    <section id="right_side" class="right_side_narrow" style="border-left:none;">

        <div class="home-inner">

            <?php render_result_messages(); ?>

            <div class="banner-section">
                <?php
                if(buckys_is_logged_in()){
                    echo '<a href="/trade/search.php"><img src="/images/trade/main_trade_home_banner_7.jpg"></a>';
                }else{
                    echo '<a href="/register.php"><img src="/images/trade/main_trade_home_banner_8.jpg"></a>';
                }
                ?>
            </div>

            <div class="top-users-section">
                <div class="pb10">
                    <span class="titles">Top 10 Users</span>
                </div>

                <?php if(is_array($topTenUsers) && count($topTenUsers) > 0) : ?>
                    <ul>
                        <?php

                        foreach($topTenUsers as $userData) :
                            if($userData['itemCount'] == 0)
                                break;
                            ?>
                            <li>
                                <div class="f-user-image">
                                    <a href="/profile.php?user=<?php echo $userData['userID'];?>" class="profileLink">
                                        <img src="<?php echo BuckysUser::getProfileIcon($userData['userID'])?>"
                                            class="postIcons" style="margin-bottom:8px;"/> </a>
                                </div>
                                <div class="f-user-desc">
                                    <a href="/profile.php?user=<?php echo $userData['userID'];?>" class="profileLink">
                                        <span><?php echo trim($userData['firstName'] . ' ' . $userData['lastName']);?></span>
                                    </a>
                                </div>
                                <div class="item-count">
                                    <a href="/trade/search.php?user=<?php echo $userData['userID'];?>"
                                        class="profileLink">
                                        <?php echo $userData['itemCount'];?> items </a>
                                </div>
                                <div class="clear"></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

            </div>
            <div class="clear"></div>

            <div class="home-block top-ten-products">
                <div class="pb10">
                    <span class="titles">Most Wanted Items</span> <span><a href="/trade/search.php?sort=offersmost"
                            class="gray">(view more)</a></span>
                </div>

                <?php if(is_array($topTenWantedItems) && count($topTenWantedItems) > 0): ?>
                    <?php
                    $index = 0;

                    echo "<div> <!-- 5 items block -->";

                    foreach($topTenWantedItems as $itemData):

                        $index++;
                        // $thumbFileUrl = fn_buckys_get_item_first_image_thumb($itemData['images']);
                        $thumbFileUrl = fn_buckys_get_item_first_image_normal($itemData['images']);
                        $timeLeftStr = fn_buckys_get_item_time_left($itemData['expiryDate']);

                        $itemLink = '/trade/view.php?id=' . $itemData['itemID'];
                        $userLink = '/profile.php?user=' . $itemData['userID'];

                        if(strlen($itemData['title']) > 100)
                            $itemData['title'] = substr($itemData['title'], 0, 100) . "...";

                        ?>
                        <div class="node <?php if($index % 5 == 0)
                            echo "nomargin";?>">
                            <div class="thumb">
                                <a href="<?php echo $itemLink;?>"> <img src="<?php echo $thumbFileUrl;?>"> </a>
                            </div>
                            <div class="tt">
                                <a href="<?php echo $itemLink;?>"><?php echo $itemData['title'];?></a>
                            </div>
                            <div class="u">
                                <a href="<?php echo $userLink;?>">
                                    <?php echo trim($itemData['firstName'] . ' ' . $itemData['lastName']);?>
                                </a>
                            </div>
                            <div class="o">
                                <?php echo $itemData['offerCount'];?> Offers
                                <?php //render_report_link($itemData['itemID'], 'trade_item', $itemData['userID'], $userID, $itemData['reportID'], '&middot;')
                                ?>
                            </div>
                            <!--
                                <div class="tl">
                                    <?php echo $timeLeftStr;?>&nbsp;left
                                </div>
								-->
                        </div>

                        <?php
                        if($index % 5 == 0){
                            echo '<div class="clear"></div></div><div>';
                        }
                        ?>


                    <?php endforeach; ?>
                    <?php echo "</div>  <!-- end of 5 items block -->"; ?>
                <?php endif; ?>

                <div class="clear"></div>
            </div>

            <!--
            <div class="home-block top-ten-products">
                <div class="pb10">
                    <span class="titles">Newest Items</span> <span><a href="/trade/search.php?sort=newly" class="gray">(view more)</a></span>
                </div>

                <?php /* if (is_array($topTenRecentItems) && count($topTenRecentItems) > 0):?>
                    <?php 
                        $index = 0;
                        
                        echo "<div>";
                        
                        foreach ($topTenRecentItems as $itemData):
                            
                            $index ++;
							$thumbFileUrl = fn_buckys_get_item_first_image_normal($itemData['images']);
                            $timePastStr = fn_buckys_get_item_time_past($itemData['createdDate']);
                            
                            $itemLink = '/trade/view.php?id='. $itemData['itemID'];
                            $userLink = '/profile.php?user='.$itemData['userID'];
                            
                            if (strlen($itemData['title']) > 100)
                                $itemData['title'] = substr($itemData['title'], 0, 100) . "...";
                            
                    ?>
                            <div class="node <?php if ($index % 5 == 0) echo "nomargin";?>">
                                <div class="thumb">
                                    <a href="<?php echo $itemLink;?>">
                                        <img src="<?php echo $thumbFileUrl;?>">
                                    </a>
                                </div>
                                <div class="tt">
                                    <a href="<?php echo $itemLink;?>"><?php echo $itemData['title'];?></a>
                                </div>
                                <div class="u">
                                    <a href="<?php echo $userLink;?>">
                                        <?php echo trim($itemData['firstName'] . ' ' . $itemData['lastName']);?>
                                    </a>
                                </div>
                                <div class="tl">
                                    <?php echo $timePastStr;?>&nbsp;ago
                                </div>                                
                            </div>
                            
                            <?php 
                                if ($index % 5 == 0) {
                                    echo '<div class="clear"></div></div><div>';
                                }
                            ?>

                    <?php endforeach;?>
                        <?php echo "</div>";?>
                <?php endif; */ ?>
                <div class="clear"></div>
            </div>
			-->
            <div class="clear"></div>
        </div>
    </section>
</section>

<!-- Go to www.addthis.com/dashboard to customize your tools 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53b910e169f3bbcf"></script>
-->