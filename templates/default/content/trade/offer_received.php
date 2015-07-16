<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}


$offerReceived = $view['offers'];

?>


<section id="main_section">

    <?php buckys_get_panel('trade_top_search'); ?>

    <?php buckys_get_panel('trade_main_nav'); ?>
    <section id="right_side" class="floatright">

        <span class="small-titles">Offers Received</span><br/>

        <div class="offer-received">
            <?php if(isset($offerReceived) && count($offerReceived) > 0) : ?>

                <div class="top-header-cont">
                    <div class="n1">My Item</div>
                    <div class="n2">Their Item</div>
                    <div class="n3">Actions</div>
                    <div class="clear"></div>
                </div>


                <?php
                foreach($offerReceived as $offerData) :

                    $userIns = new BuckysUser();
                    $offerData['basicInfo'] = $userIns->getUserBasicInfo($offerData['offeredUserID']);

                    // $myItemImage = fn_buckys_get_item_first_image_thumb($offerData['targetImages']);
                    // $offeredItemImage = fn_buckys_get_item_first_image_thumb($offerData['offeredImages']);
                    $myItemImage = fn_buckys_get_item_first_image_normal($offerData['targetImages']);
                    $offeredItemImage = fn_buckys_get_item_first_image_normal($offerData['offeredImages']);

                    $sendMessageLink = '/messages_compose.php?to=' . $offerData['offeredUserID'];
                    $theirID = $offerData['offeredUserID'];

                    $dateOffered = date('n/j/y H:i', strtotime($offerData['offerCreatedDate']));

                    $strTimeLeft = '';
                    if(strtotime($offerData['targetExpiryDate']) > strtotime($offerData['offeredExpiryDate'])){
                        $strTimeLeft = fn_buckys_get_item_time_left($offerData['offeredExpiryDate']);
                    }else{
                        $strTimeLeft = fn_buckys_get_item_time_left($offerData['targetExpiryDate']);
                    }

                    $targetItemLink = '/trade/view.php?id=' . $offerData['targetItemID'];
                    $offeredItemLink = '/trade/view.php?id=' . $offerData['offeredItemID'];

                    $totalRating = 'No';
                    $positiveRating = '';

                    if(isset($offerData['totalRating']) && $offerData['totalRating'] > 0){
                        $totalRating = $offerData['totalRating'];
                        if(is_numeric($offerData['positiveRating'])){
                            $positiveRating = number_format($offerData['positiveRating'] / $offerData['totalRating'] * 100, 2, '.', '') . '% Positive';
                        }
                    }


                    ?>

                    <div class="node">

                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="my">
                                    <div class="image">
                                        <a href="<?php echo $targetItemLink;?>"><img
                                                src="<?php echo $myItemImage;?>"></a>
                                    </div>
                                    <div class="desc">
                                        <div class="t">
                                            <a href="<?php echo $targetItemLink;?>"><?php echo $offerData['targetTitle'];?></a>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </td>
                                <td class="their">
                                    <div class="image">
                                        <a href="<?php echo $offeredItemLink;?>"><img
                                                src="<?php echo $offeredItemImage;?>"></a>
                                    </div>
                                    <div class="desc">
                                        <div class="t">
                                            <a href="<?php echo $offeredItemLink;?>"><?php echo $offerData['offeredTitle'];?></a>
                                            <br/>

                                            <div>
                                                <span
                                                    style="color: #999999;">Item Location: <?php echo $offerData['offeredLocationTitle'];?></span>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="f-user" style="margin-top:10px;">
                                                <div class="f-user-desc">
                                                    <a href="/profile.php?user=<?php echo $offerData['offeredUserID'];?>"
                                                        class="profileLink">
                                                        <span><?php echo trim($offerData['basicInfo']['firstName'] . ' ' . $offerData['basicInfo']['lastName']);?></span>
                                                    </a> <br/>
                                                    <?php
                                                    if(is_numeric($totalRating)){
                                                        echo sprintf('<a href="%s" class="rating">(%d ratings)</a> %s', '/feedback.php?user=' . $theirID, $totalRating, $positiveRating);
                                                    }else{
                                                        echo sprintf('(%s ratings)', $totalRating);
                                                    }
                                                    ?>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </td>
                                <td class="act">
                                    <div>
                                        <a href="javascript:void(0)"
                                            onclick="acceptOffer(<?php echo $offerData['offerID']?>)">Accept Offer</a>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)"
                                            onclick="declineOffer(<?php echo $offerData['offerID']?>)">Decline Offer</a>
                                    </div>
                                    <div><a href="<?php echo $sendMessageLink;?>">Send Message</a></div>
                                    <div style="margin-top:10px;">Offer Expires: <span
                                            class="red"><?php echo $strTimeLeft;?></span></div>
                                </td>
                            </tr>
                        </table>

                        <div class="clear"></div>

                    </div>

                <?php endforeach; ?>

                <?php buckys_get_panel('common_pagination'); ?>

            <?php else: ?>

                <div class="no-trade-data"> - No data available -</div>

            <?php endif; ?>

        </div>

        <div class="clear"></div>

    </section>
</section>
