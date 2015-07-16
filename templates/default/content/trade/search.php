<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}


//buckys_trade_search_url($view['param']['q'], $view['param']['cat'], $view['param']['loc'], $view['param']['sort']);


?>

<section id="main_section">

    <?php buckys_get_panel('trade_top_search'); ?>


    <aside id="main_aside" class="trade-left-panel trade-search-left-panel">
        <div class="block-s">

            <?php
            $outputHtml = '';
            foreach($view['categoryList'] as $catData){
                if($catData['count'] > 0){
                    if($view['param']['cat'] == '' || strtolower($view['param']['cat']) == strtolower($catData['name']))
                        $outputHtml .= sprintf('<li><a href="%s">%s</a> <span>(%d)</span> </li>', buckys_trade_search_url($view['param']['q'], $catData['name'], $view['param']['loc'], $view['param']['sort'], $view['param']['user']), $catData['name'], $catData['count']);
                }
            }

            if($outputHtml != ''){

                ?>
                <span style="color:#666666;font-weight:bold;line-height:16px;">Categories</span>
                <ul class="left-cat-list">
                    <?php echo $outputHtml; ?>
                </ul>
            <?php
            }
            ?>

        </div>

        <div class="block-s">
            <span style="color:#666666">Item Location</span> <select id="trade_search_location">
                <option value="">Anywhere</option>
                <?php
                if(count($view['countryList']) > 0){
                    foreach($view['countryList'] as $countryData){

                        $selected = '';
                        if(strtolower($view['param']['loc']) == strtolower($countryData['country_title'])){
                            $selected = 'selected="selected"';
                        }

                        echo sprintf('<option value="%s" %s>%s</option>', $countryData['country_title'], $selected, $countryData['country_title']);
                    }
                }
                ?>
            </select>
        </div>

        <div>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- BuckysRoom 120x600 Color -->
            <ins class="adsbygoogle"
                style="display:inline-block;width:120px;height:600px"
                data-ad-client="ca-pub-4964222180668069"
                data-ad-slot="8509100290"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <div style="margin-top:20px;">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- BuckysRoom 120x600 Color -->
            <ins class="adsbygoogle"
                style="display:inline-block;width:120px;height:600px"
                data-ad-client="ca-pub-4964222180668069"
                data-ad-slot="8509100290"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <!-- Begin DigiCert site seal HTML and JavaScript -->
        <div style="margin-top:20px;width:120px">
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
        </div>
        <!-- End DigiCert site seal HTML and JavaScript -->
    </aside>

    <section id="right_side" class="floatright trade-search-result" style="border-left:none;">

        <div class="trade-item-list">
            <div class="breadcrumb">
                <a href="/trade/search.php">All Categories</a>
                <?php
                if($view['param']['cat'] != '')
                    echo sprintf(' &gt <a href="%s">%s</a>', buckys_trade_search_url('', $view['param']['cat'], '', $view['param']['sort'], $view['param']['user']), $view['param']['cat']);
                ?>

                <?php
                if($view['param']['loc'] != '')
                    echo sprintf(' &gt <a href="%s">%s</a>', buckys_trade_search_url('', $view['param']['cat'], $view['param']['loc'], $view['param']['sort'], $view['param']['user']), $view['param']['loc']);
                ?>

                <?php
                if($view['param']['q'] != '')
                    echo sprintf(' &gt %s', $view['param']['q']);
                ?>

            </div>

            <div class="sort-box">
                <div class="l">
                    <div
                        class="total-record-p"><?php echo sprintf('Showing %d - %d of %s Results', $TNB_GLOBALS['commonPagination']['startIndex'], $TNB_GLOBALS['commonPagination']['endIndex'], number_format($TNB_GLOBALS['commonPagination']['totalRecords'])) ?></div>
                </div>
                <div class="r">
                    <select id="trade_search_sort">
                        <?php
                        $sortOptionList = ['best' => 'Best Match', 'endsoon' => 'Time: ending soonest', 'newly' => 'Time: newly listed', 'offersmost' => 'Offers: most to least', 'offersleast' => 'Offers: least to most'];


                        foreach($sortOptionList as $key => $val){
                            $selected = '';
                            if($view['param']['sort'] == $key)
                                $selected = 'selected="selected"';
                            echo sprintf('<option value="%s" %s>%s</option>', $key, $selected, $val);
                        }


                        ?>
                    </select> <label>Sort by </label>

                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="trade-search-result-list">
                <?php
                if(isset($view['items']) && count($view['items']) > 0) :
                    ?>

                    <?php
                    $firstNodeFlag = true;
                    foreach($view['items'] as $itemData) :
                        // BuckyThumbChanges
                        // $thumbFileUrl = fn_buckys_get_item_first_image_thumb($itemData['images']);
                        $thumbFileUrl = fn_buckys_get_item_first_image_normal($itemData['images']);
                        $timeLeftStr = fn_buckys_get_item_time_left($itemData['expiryDate']);

                        $viewLink = '/trade/view.php?id=' . $itemData['itemID'];

                        $totalRating = 'No';
                        $positiveRating = '';

                        if(isset($itemData['totalRating']) && $itemData['totalRating'] > 0){
                            $totalRating = $itemData['totalRating'];
                            if(is_numeric($itemData['positiveRating'])){
                                $positiveRating = number_format($itemData['positiveRating'] / $itemData['totalRating'] * 100, 2, '.', '') . '% Positive';
                            }
                        }

                        $theirID = $itemData['userID'];




                        ?>
                        <div class="node <?php if($firstNodeFlag){
                            $firstNodeFlag = false;
                            echo 'first';
                        }?>">
                            <div class="item-img">
                                <!-- BuckyThumbChanges -->
                                <a href="<?php echo $viewLink;?>"> <img src="<?php echo $thumbFileUrl;?>"
                                        style="max-width:150px; max-height:150px;"/> </a>
                            </div>
                            <div class="item-desc">
                                <a href="<?php echo $viewLink;?>" class="item-name"><?php echo $itemData['title']?></a>

                                <div><?php echo $itemData['subtitle']?></div>
                                <div class="btm">
                                    <div>
                                        <a class="uname"
                                            href="/profile.php?user=<?php echo $theirID;?>"><?php echo trim($itemData['firstName'] . ' ' . $itemData['lastName']);?></a>
                                    </div>

                                    <div style="color:#999999;font-size:11px;">
                                        <?php
                                        if(is_numeric($totalRating)){
                                            echo sprintf('<a href="%s" class="rating">(%d ratings)</a> %s', '/feedback.php?user=' . $theirID, $totalRating, $positiveRating);
                                        }else{
                                            echo sprintf('(%s ratings)', $totalRating);
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="item-offer">
                                <?php if($itemData['offer'] > 0) : ?>
                                    <span><?php echo $itemData['offer']; ?> Offers</span>
                                <?php else : ?>
                                    <span>No Offers</span>
                                <?php endif;?>
                            </div>
                            <div class="item-time-left">
                                <?php echo $timeLeftStr;?> left
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php endforeach;?>


                <?php else: ?>

                    <div class="no-trade-data"> - No data available -</div>

                <?php endif; ?>

            </div>
            <?php if(isset($view['items']) && count($view['items']) > 0) : ?>
                <?php buckys_get_panel('common_pagination'); ?>
            <?php endif; ?>

        </div>

        <div class="clear"></div>

    </section>
</section>

<!-- Go to www.addthis.com/dashboard to customize your tools 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53b910e169f3bbcf"></script>
-->