<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}


$offerMade = $view['offers'];

?>


<section id="main_section">

    <?php buckys_get_panel('trade_top_search'); ?>

    <?php buckys_get_panel('trade_main_nav'); ?>
    <section id="right_side" class="floatright">

        <span class="small-titles">Offers Declined</span><br/>

        <div style="margin-top:10px;margin-bottom:10px;">

            <?php if($view['type'] == 'byme'): ?>
                <a href="/trade/offer_declined.php">Declined By Them</a> &middot;
                <span style="color:#C0392B;font-weight:bold;">Declined by Me</span>
            <?php else : ?>
                <span style="color:#C0392B;font-weight:bold;">Declined by Them</span> &middot;
                <a href="/trade/offer_declined.php?type=byme">Declined by Me</a>
            <?php endif; ?>

        </div>
        <div class="offer-received offer-declined">
            <input type="hidden" id="offer_declined_type" value="<?php echo $view['type'] == 'byme' ? 1 : 0; ?>">
            <?php if(isset($offerMade) && count($offerMade) > 0) : ?>

                <div class="top-header-cont">
                    <div class="n0"><input type="checkbox" class="select-all-offers" id="select_all_offers"></div>
                    <div class="n1" style="padding-left:70px;width:273px;">My Item</div>
                    <div class="n2" style="width:272px;">Their Item</div>
                    <div class="n3">Date Declined</div>
                    <div class="clear"></div>
                </div>


                <?php
                foreach($offerMade as $offerData) :


                    // $targetItemImage = fn_buckys_get_item_first_image_thumb($offerData['targetImages']);
                    // $offeredItemImage = fn_buckys_get_item_first_image_thumb($offerData['offeredImages']);
                    $targetItemImage = fn_buckys_get_item_first_image_normal($offerData['targetImages']);
                    $offeredItemImage = fn_buckys_get_item_first_image_normal($offerData['offeredImages']);

                    $sendMessageLink = '/messages_compose.php?to=' . $offerData['offeredUserID'];

                    $dateOffered = date('n/j/y H:i', strtotime($offerData['offerCreatedDate']));

                    $targetItemLink = '/trade/view.php?id=' . $offerData['targetItemID'];
                    $offeredItemLink = '/trade/view.php?id=' . $offerData['offeredItemID'];





                    ?>
                    <?php if($view['type'] != 'byme') : ?>

                    <div class="node">

                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="chk">
                                    <input type="checkbox" id="chk_offer_row_<?php echo $offerData['offerID']; ?>"
                                        class="chk-offer-row">
                                </td>
                                <td class="my">
                                    <div class="image">
                                        <a href="<?php echo $offeredItemLink; ?>"><img
                                                src="<?php echo $offeredItemImage; ?>"></a>
                                    </div>
                                    <div class="desc">
                                        <div class="t">
                                            <a href="<?php echo $offeredItemLink; ?>"><?php echo $offerData['offeredTitle']; ?></a>
                                        </div>
                                        <!-- <div class="st"><?php echo $offerData['offeredSubtitle']; ?></div> -->
                                        <div class="i-num">Item Number: <?php echo $offerData['offeredItemID']; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                </td>
                                <td class="their">
                                    <div class="image">
                                        <a href="<?php echo $targetItemLink; ?>"><img
                                                src="<?php echo $targetItemImage; ?>"></a>
                                    </div>
                                    <div class="desc">
                                        <div class="t">
                                            <a href="<?php echo $targetItemLink; ?>"><?php echo $offerData['targetTitle']; ?></a>
                                        </div>
                                        <!-- <div class="st"><?php echo $offerData['targetSubtitle']; ?></div> -->
                                        <div class="i-num">Item Number: <?php echo $offerData['targetItemID']; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                </td>
                                <td class="act bold" style="color:#555555;width:125px;">
                                    <?php echo date('F d, Y', strtotime($offerData['offerUpdatedDate'])); ?>
                                </td>
                            </tr>
                        </table>

                    </div>



                <?php else : ?>


                    <div class="node">

                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="chk">
                                    <input type="checkbox" id="chk_offer_row_<?php echo $offerData['offerID']; ?>"
                                        class="chk-offer-row">
                                </td>
                                <td class="my">
                                    <div class="image">
                                        <a href="<?php echo $targetItemLink; ?>"><img
                                                src="<?php echo $targetItemImage; ?>"></a>
                                    </div>
                                    <div class="desc">
                                        <div class="t">
                                            <a href="<?php echo $targetItemLink; ?>"><?php echo $offerData['targetTitle']; ?></a>
                                        </div>
                                        <!-- <div class="st"><?php echo $offerData['targetSubtitle']; ?></div> -->
                                        <div class="i-num">Item Number: <?php echo $offerData['targetItemID']; ?></div>
                                    </div>
                                    <div class="clear"></div>

                                </td>
                                <td class="their">

                                    <div class="image">
                                        <a href="<?php echo $offeredItemLink; ?>"><img
                                                src="<?php echo $offeredItemImage; ?>"></a>
                                    </div>
                                    <div class="desc">
                                        <div class="t">
                                            <a href="<?php echo $offeredItemLink; ?>"><?php echo $offerData['offeredTitle']; ?></a>
                                        </div>
                                        <!-- <div class="st"><?php echo $offerData['offeredSubtitle']; ?></div> -->
                                        <div class="i-num">Item Number: <?php echo $offerData['offeredItemID']; ?></div>
                                    </div>
                                    <div class="clear"></div>

                                </td>
                                <td class="act bold" style="color:#555555;width:125px;">
                                    <?php echo date('F d, Y', strtotime($offerData['offerUpdatedDate'])); ?>
                                </td>
                            </tr>
                        </table>

                    </div>
                <?php endif;?>

                <?php endforeach; ?>

                <div class="remove-btn-cont">
                    <input type="button" class="red-btn" value="Remove" id="remove_declined_offers">
                </div>

                <?php buckys_get_panel('common_pagination'); ?>

            <?php else: ?>

                <div class="no-trade-data"> - No data available -</div>

            <?php endif; ?>

        </div>

        <div class="clear"></div>

    </section>
</section>
