<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>

<script type="text/javascript">
    var current_img_files = []; //TODO: you should set this when edit item.
</script>

<section id="main_section">

    <?php buckys_get_panel('trade_top_search'); ?>

    <?php buckys_get_panel('trade_main_nav'); ?>
    <section id="right_side" class="floatright">

        <span class="small-titles"><?php echo $view['pagetitle']; ?></span><br/>
        <?php render_result_messages(); ?>
        <div class="trade-available-list">
            <?php echo buckys_get_messages(); ?>
            <?php if(isset($view['items']) && count($view['items']) > 0) : ?>

                <div class="top-header-cont" style="color: #999999;">
                    <div class="n1">&nbsp;</div>
                    <div class="n2">Item</div>
                    <div class="n3">Offers</div>
                    <div class="n4">Time Left</div>
                    <div class="n5">Actions</div>
                    <div class="clear"></div>
                </div>


                <?php
                foreach($view['items'] as $itemData) :

                    // $thumbFileUrl = fn_buckys_get_item_first_image_thumb($itemData['images']);
                    $thumbFileUrl = fn_buckys_get_item_first_image_normal($itemData['images']);

                    if($view['type'] == 'expired')
                        $timeLeftStr = 'Expired';else
                        $timeLeftStr = fn_buckys_get_item_time_left($itemData['expiryDate']);

                    $editLink = '/trade/edititem.php?id=' . $itemData['itemID'];
                    $relistLink = '/trade/edititem.php?id=' . $itemData['itemID'] . '&type=relist';
                    $offerViewLink = '/trade/offer_received.php?targetID=' . $itemData['itemID'];

                    $viewLink = '/trade/view.php?id=' . $itemData['itemID'];

                    ?>

                    <div class="node">
                        <div class="n1"><a href="<?php echo $viewLink;?>"><img src="<?php echo $thumbFileUrl;?>"/></a>
                        </div>
                        <div class="n2">
                            <a href="<?php echo $viewLink;?>"><?php echo $itemData['title'];?></a>

                            <div class="subtitle"><?php echo $itemData['subtitle'];?></div>
                            <!--
							<br />
                            <div class="itemnum">Item Number: <?php echo $itemData['itemID'];?></div>
							-->
                        </div>
                        <div class="n3">
                            <?php if($itemData['offer'] > 0) : ?>
                                <a href="<?php echo $offerViewLink ?>"> <?php echo $itemData['offer'] ?> (view)</a>
                            <?php else : ?>
                                0
                            <?php endif;?>
                        </div>
                        <div class="n4 red-bold">
                            <div class="timeleft">
                                <?php echo $timeLeftStr;?>
                            </div>
                        </div>
                        <div class="n5">
                            <div class="actionpart">
                                <?php if($view['type'] != 'expired') : ?>
                                    <a href="javascript:void(0)"
                                        onclick="deleteTradeItem(<?php echo $itemData['itemID']; ?>);">Delete Item</a>
                                    <a href="<?php echo $editLink; ?>">Edit Item</a>
                                    <?php if($itemData['offer'] > 0) : ?>
                                        <a href="<?php echo $offerViewLink ?>">View Offers</a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <a href="javascript:void(0)"
                                        onclick="deleteTradeItem(<?php echo $itemData['itemID']; ?>);">Delete Item</a>
                                    <a href="<?php echo $relistLink; ?>">Relist Item</a>
                                <?php endif;?>
                            </div>
                        </div>
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
