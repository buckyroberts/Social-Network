<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}

$itemData = $view['item'];


/*Get images*/
$imageList = [];
if($itemData['images'] != '')
    $imageList = explode("|", $itemData['images']);

$imageThumbList = []; // it will save image & thumb list

if(count($imageList) > 0){

    foreach($imageList as $imgData){

        $thumbPathInfo = pathinfo($imgData);
        $thumbFileName = $thumbPathInfo['dirname'] . "/" . $thumbPathInfo['filename'] . TRADE_ITEM_IMAGE_THUMB_SUFFIX . "." . $thumbPathInfo['extension'];

        $tmpData['image'] = $imgData;
        $tmpData['thumb'] = $thumbFileName;

        $imageThumbList[] = $tmpData;
    }

}else{
    $imageThumbList[0]['image'] = '/images/trade/no-image.jpg';
    $imageThumbList[0]['thumb'] = '/images/trade/no-image-thumb.jpg';
}


$totalRating = 'No';
$positiveRating = '';

if(isset($itemData['totalRating']) && $itemData['totalRating'] > 0){
    $totalRating = $itemData['totalRating'];
    if(is_numeric($itemData['positiveRating'])){
        $positiveRating = number_format($itemData['positiveRating'] / $itemData['totalRating'] * 100, 2, '.', '') . '% Positive';
    }
}

$sendMessageLink = '/register.php';
if(isset($view['myID']) && is_numeric($view['myID']))
    $sendMessageLink = '/messages_compose.php?to=' . $itemData['userID'];

$theirID = $itemData['userID'];

?>

<script type="text/javascript">
    var currentOfferProductCount = <?php echo count($view['availableItems']);?>;
</script>

<section id="main_section">

    <?php buckys_get_panel('trade_top_search'); ?>

    <section class="trade-full-panel">

        <div class="trade-view-images">
            <div class="m">
                <img id="trade_view_main_image" src="<?php echo $imageThumbList[0]['image']; ?>"/>
            </div>

            <div class="d">mouse over images to zoom</div>

            <div class="thumb">
                <ul>
                    <?php
                    for($idx = 0; $idx < count($imageThumbList); $idx++){
                        echo sprintf('<li class="%s"><table cellpadding="0" cellspacing="0"><tr><td><img src="%s" /><img src="%s" class="large"/></td></tr></table></li>', $idx == 0 ? 'first sel' : '', $imageThumbList[$idx]['thumb'], $imageThumbList[$idx]['image']);
                    }
                    ?>
                </ul>
                <div class="clear"></div>
            </div>

        </div>

        <div class="trade-view-info">
            <div><span class="titles">Item Information</span></div>

            <div class="i-name"><?php echo $itemData['title']; ?></div>
            <div class="i-subtitle"><?php echo $itemData['subtitle']; ?></div>
            <div class="i-info">
                <dl>
                    <!--
                    <dt>Item Number:</dt>
                    <dd> </dd>
                    
                    <dt>Offers:</dt>
                    <dd> </dd>
                    
                    
                    <dt>Category:</dt>
                    <dd> </dd>
                    
                    <dt>Item Location:</dt>
                    <dd> </dd>
                    
                    <dt>Time Left:</dt>
                    <dd class="red"> </dd>
                    -->
                    <dt>
                        Item Number: <br/> Offers: <br/> Category: <br/> Item Location: <br/> Time Left:
                    </dt>
                    <dd>
                        <?php echo $itemData['itemID'] ?> <br/>
                        <?php echo $itemData['offer'] ?> <br/> <a
                            href="/trade/search.php?cat=<?php echo urlencode($itemData['categoryName']); ?>"><?php echo $itemData['categoryName'] ?></a><br/>
                        <?php echo $itemData['locationName'] ?> <br/> <span
                            style="color:#C0392B;"><?php echo fn_buckys_get_item_time_left($itemData['expiryDate']) ?></span>
                    </dd>

                </dl>
                <div class="clear"></div>
            </div>

            <div class="action-cont">
                <div><span class="titles">Action</span></div>

                <?php if($itemData['status'] != BuckysTradeItem::STATUS_ITEM_TRADED) : ?>
                    <?php if($view['myID'] != $itemData['userID']): ?>
                        <?php if(isset($view['myID']) && is_numeric($view['myID'])): ?>
                            <?php if($view['offerDisabled'] == false) : ?>
                                <a href="javascript:void(0)" class="make-an-offer blue-btn">Make an Offer</a>  <br/>
                            <?php endif; ?>
                        <?php else : ?>
                            <a href="/register.php" class="blue-btn">Make an Offer</a>  <br/>
                        <?php endif; ?>


                    <?php else : ?>

                        <?php //if ($itemData['isExpired'] == true) : ?>
                        <?php if(fn_buckys_get_item_time_left($itemData['expiryDate']) == '0') : ?>
                            <a href="javascript:void(0)"
                                onclick="deleteTradeItem(<?php echo $itemData['itemID']; ?>);">Delete</a>
                            <br/>
                            <a href="/trade/edititem.php?id=<?php echo $itemData['itemID']; ?>&type=relist">Relist Item</a>
                            <br/>
                        <?php else: ?>
                            <a href="/trade/edititem.php?id=<?php echo $itemData['itemID']; ?>">Edit</a> <br/>
                            <a href="javascript:void(0)"
                                onclick="deleteTradeItem(<?php echo $itemData['itemID']; ?>);">Delete</a>
                            <br/>
                            <a href="/trade/offer_received.php?targetID=<?php echo $itemData['itemID']; ?>">View Offers</a>
                            <br/>
                        <?php endif; ?>

                    <?php endif; ?>
                <?php else: ?>
                    <div class="">This item has been traded.</div>
                <?php endif; ?>
            </div>

        </div>

        <div class="trade-view-owner">
            <div><span class="titles">Owner Information</span></div>
            <a href="/profile.php?user=<?php echo $itemData['userID']; ?>" class="profileLink"> <img
                    src="<?php echo BuckysUser::getProfileIcon($itemData['userID']) ?>" class="postIcons"/> <span
                    style="font-weight:bold;"><?php echo trim($itemData['userInfo']['firstName'] . ' ' . $itemData['userInfo']['lastName']); ?></span>
            </a>

            <div>
                <?php
                if(is_numeric($totalRating)){
                    echo sprintf('<a href="%s" class="rating">(%d ratings)</a> %s', '/feedback.php?user=' . $theirID, $totalRating, $positiveRating);
                }else{
                    echo sprintf('(%s ratings)', $totalRating);
                }
                ?>
            </div>
            <div class="clear"></div>
            <div class="action-cont">
                <a href="/trade/search.php?user=<?php echo $itemData['userID'] ?>">See Other Items</a> <br/>
                <?php if($view['myID'] != $itemData['userID']): ?>
                    <a href="<?php echo $sendMessageLink ?>">Send Message</a> <br/>
                <?php endif; ?>
                <?php
                if($itemData['status'] != BuckysTradeItem::STATUS_ITEM_TRADED)
                    render_report_link($itemData['itemID'], 'trade_item', $itemData['userID'], $userID, $itemData['reportID'])
                ?>
            </div>

        </div>

        <?php if($view['offerDisabled'] == false) : ?>
            <div class="make-offer-panel">
                <div><span class="titles">Select an Item to Offer:</span></div>
                <div class="inner-p needmask">
                    <input type="hidden" name="targetItemID" id="targetItemID"
                        value="<?php echo $itemData['itemID'] ?>">
                    <ul id="offer_available_items">
                        <?php
                        if(count($view['availableItems']) > 0){
                            foreach($view['availableItems'] as $anItemData) :
                                $thumbImagePath = fn_buckys_get_item_first_image_normal($anItemData['images']);
                                $itemUrl = '/trade/view.php?id=' . $anItemData['itemID'];
                                ?>
                                <li>
                                    <div class="rad">
                                        <input type="hidden" name="" value="<?php echo $anItemData['itemID']?>"> <input
                                            type="radio" name="available_item">
                                    </div>
                                    <div class="image">
                                        <img src="<?php echo $thumbImagePath;?>">
                                    </div>
                                    <div class="desc">
                                        <div class="t"><?php echo $anItemData['title']?></div>
                                        <div class="st"><?php echo $anItemData['subtitle']?></div>
                                        <div class="item-no">Item Number: <?php echo $anItemData['itemID']?></div>
                                    </div>
                                    <div class="clear"></div>
                                </li>
                            <?php
                            endforeach;

                        }

                        ?>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div>
                    <input type="button" id="make_an_offer_btn" class="blue-btn" value="Offer Item"/> <input
                        type="button" id="cancel_an_offer_btn" class="light-gray-btn" value="Cancel"/>
                </div>
            </div>
        <?php endif; ?>

        <div class="clear"></div>

        <div class="trade-view-description">
            <div><span class="titles">Description:</span></div>
            <div class="d">
                <?php echo render_enter_to_br($itemData['description']); ?>
            </div>

            <div><span class="titles">Items Wanted:</span></div>
            <div class="d">
                <?php echo $itemData['itemWanted']; ?>
            </div>
        </div>

        <div>
            <br/><br/>
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

<!-- Go to www.addthis.com/dashboard to customize your tools 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53b910e169f3bbcf"></script>
-->
