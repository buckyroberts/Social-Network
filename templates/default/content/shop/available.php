<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>

<script type="text/javascript">
    var current_img_files = []; //TODO: you should set this when edit item.
</script>

<section id="main_section">

    <?php buckys_get_panel('shop_top_search'); ?>

    <?php buckys_get_panel('shop_main_nav'); ?>
    <section id="right_side" class="floatright">

        <span class="titles"><?php echo $view['pagetitle']; ?></span><br/>
        <?php render_result_messages(); ?>
        <div class="shop-available-list">
            <?php echo buckys_get_messages(); ?>
            <?php if(isset($view['products']) && count($view['products']) > 0) : ?>

                <div class="top-header-cont" style="color: #999999;">
                    <div class="n1">&nbsp;</div>
                    <div class="n2">Item</div>
                    <div class="n3" style="color:#999999;">Price</div>
                    <div class="n4">Time Left</div>
                    <div class="n5">Actions</div>
                    <div class="clear"></div>
                </div>


                <?php
                foreach($view['products'] as $prodData) :

                    $thumbFileUrl = fn_buckys_get_item_first_image_thumb($prodData['images']);

                    if($view['type'] == 'expired')
                        $timeLeftStr = 'Expired';else
                        $timeLeftStr = fn_buckys_get_item_time_left($prodData['expiryDate']);

                    $editLink = '/shop/edititem.php?id=' . $prodData['productID'];
                    $relistLink = '/shop/edititem.php?id=' . $prodData['productID'] . '&type=relist';

                    $viewLink = '/shop/view.php?id=' . $prodData['productID'];

                    ?>

                    <div class="node">
                        <div class="n1"><a href="<?php echo $viewLink;?>"><img src="<?php echo $thumbFileUrl;?>"/></a>
                        </div>
                        <div class="n2">
                            <a href="<?php echo $viewLink;?>"><?php echo $prodData['title'];?></a>

                            <div class="subtitle"><?php echo $prodData['subtitle'];?></div>
                            <!--
							<br />
                            <div class="itemnum">Item Number: <?php echo $prodData['productID'];?></div>
							-->
                        </div>
                        <div class="n3">
                            <?php echo fn_buckys_get_btc_price_formated($prodData['price']);?> BTC
                        </div>
                        <div class="n4 red-bold">
                            <div class="timeleft">
                                <?php echo $timeLeftStr;?>
                            </div>
                        </div>
                        <div class="n5">
                            <div class="actionpart">
                                <a href="javascript:void(0)"
                                    onclick="deleteShopProduct(<?php echo $prodData['productID'];?>);">Delete Item</a>
                                <?php if($view['type'] != 'expired') : ?>
                                    <a href="<?php echo $editLink; ?>">Edit Item</a>
                                <?php else: ?>
                                    <a href="<?php echo $relistLink; ?>">Relist Item</a>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>

                <?php endforeach; ?>

                <?php buckys_get_panel('common_pagination'); ?>

            <?php else: ?>

                <div class="no-shop-data"> - No data available -</div>

            <?php endif; ?>

        </div>

        <div class="clear"></div>

    </section>
</section>
