<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}


$recentProducts = $view['recent_products'];
$categoryList = $view['categories'];

?>

<section id="main_section">
    <?php buckys_get_panel('shop_top_search'); ?>


    <aside id="main_aside" class="main_aside_wide">
        <ul class="left-shop-cat-list">
            <li><a href="/shop/search.php">All Categories</a></li>
            <?php
            if(count($categoryList) > 0){
                foreach($categoryList as $catData){
                    echo sprintf('<li><a href="/shop/search.php?cat=%s">%s</a></li>', urlencode($catData['name']), $catData['name']);
                }
            }
            ?>
        </ul>
        <div style="width:200px;text-align:center;">
            <img src="/images/btc_accepted_here.png"/> <br/>
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
                    echo '<a href="/shop/search.php"><img src="/images/shopHomePageBanner.jpg"></a>';
                }else{
                    echo '<a href="/register.php"><img src="/images/shopHomePageBanner_3.jpg"></a>';
                }
                ?>
            </div>
            <div class="clear"></div>

            <div class="home-block top-ten-products">
                <div class="pb10">
                    <span class="titles">Newest Items</span> <span><a href="/shop/search.php?sort=newly"
                            class="gray">(view more)</a></span>
                </div>


                <?php if(is_array($recentProducts) && count($recentProducts) > 0): ?>
                    <?php
                    $index = 0;

                    echo "<div> <!-- 5 items block -->";

                    foreach($recentProducts as $prodData):

                        $index++;
                        // $thumbFileUrl = fn_buckys_get_item_first_image_thumb($prodData['images']);
                        $thumbFileUrl = fn_buckys_get_item_first_image_normal($prodData['images']);

                        $itemLink = '/shop/view.php?id=' . $prodData['productID'];
                        $userLink = '/profile.php?user=' . $prodData['userID'];

                        if(strlen($prodData['title']) > 100)
                            $prodData['title'] = substr($prodData['title'], 0, 100) . "...";

                        ?>
                        <div class="node <?php if($index % 5 == 0)
                            echo "nomargin";?>">
                            <div class="thumb">
                                <a href="<?php echo $itemLink;?>"> <img src="<?php echo $thumbFileUrl;?>"> </a>
                            </div>
                            <div class="tt">
                                <a href="<?php echo $itemLink;?>"><?php echo $prodData['title'];?></a>
                            </div>
                            <div class="u">
                                <a href="<?php echo $userLink;?>">
                                    <?php echo trim($prodData['firstName'] . ' ' . $prodData['lastName']);?>
                                </a>
                            </div>
                            <div class="pp">
                                <?php echo $prodData['price'];?>&nbsp;BTC
                            </div>
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

            <div class="clear"></div>
        </div>
    </section>
</section>

<!-- Go to www.addthis.com/dashboard to customize your tools 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53b910e169f3bbcf"></script>
-->
