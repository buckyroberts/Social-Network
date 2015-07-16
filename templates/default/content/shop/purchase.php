<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}


$purchaseList = $view['purchase'];

?>


<section id="main_section">

    <?php buckys_get_panel('shop_top_search'); ?>

    <?php buckys_get_panel('shop_main_nav'); ?>
    <section id="right_side" class="floatright">

        <span class="titles"><?php echo $view['subtitle']; ?></span><br/>

        <div class="order-history">

            <?php echo buckys_get_messages(); ?>

            <?php if(isset($purchaseList) && count($purchaseList) > 0) : ?>

                <div class="top-header-cont">
                    <div class="n1">Item</div>
                    <div class="n2">Price</div>
                    <div class="n3">Order Details</div>
                    <div class="n4">Actions</div>
                    <div class="clear"></div>
                </div>


                <?php
                foreach($purchaseList as $data) :

                    $prodImage = fn_buckys_get_item_first_image_thumb($data['images']);
                    $sendMessageLink = '/messages_compose.php?to=' . $data['sellerID'];

                    $prodViewLink = '/shop/view.php?id=' . $data['productID'];


                    ?>

                    <div class="node">

                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="n1">
                                    <div class="image">
                                        <a href="<?php echo $prodViewLink;?>"><img src="<?php echo $prodImage;?>"></a>
                                    </div>
                                    <div class="desc">
                                        <div class="t">
                                            <a href="<?php echo $prodViewLink;?>"><?php echo $data['title'];?></a></div>
                                        <?php if(!$data['isDownloadable']): ?>
                                            <div class="grey-text">
                                                Tracking Number: <?php
                                                if($data['trackingNo'] != ''){
                                                    echo sprintf('<span class="blue">%s</span>', $data['trackingNo']);
                                                }else{
                                                    echo 'None';
                                                }

                                                ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="grey-text">Feedback Given:
                                            <?php
                                            $score = $data['score'];
                                            if(is_numeric($score)){
                                                if($score > 0)
                                                    echo '<div class="feedback-positive"></div>';else if($score < 0)
                                                    echo '<div class="feedback-negative"></div>';
                                            }else{
                                                echo 'None';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </td>
                                <td class="n2">
                                    <?php echo $data['price'] . ' BTC';?>
                                </td>
                                <td class="n3">
                                    <div>
                                        <span
                                            class="grey-text">Date: </span><?php echo date('F j, Y', strtotime($data['createdDate']));?>
                                    </div>
                                    <div>
                                        <span
                                            class="grey-text">Order ID: </span><?php echo sprintf("%08d", $data['orderID'])?>
                                    </div>
                                    <div><span class="grey-text">Total: </span><?php echo $data['totalPrice']?> BTC
                                    </div>
                                </td>
                                <td class="n4">
                                    <div class="action-group">
                                        <?php if($data['score'] == ''): ?>
                                            <input type="hidden" class="orderID" value="<?php echo $data['orderID'] ?>">
                                            <div>
                                                <a href="javascript:void(0)"
                                                    class="leave_feedback_btn">Leave Feedback</a>
                                            </div>
                                        <?php endif;?>
                                        <div><a href="<?php echo $sendMessageLink;?>">Send Message</a></div>
                                        <?php if($view['type'] != 'archived'): ?>
                                            <div>
                                                <a href="/shop/process.php?action=archiveOrder&id=<?php echo $data['orderID'] ?>">Move to Archive</a>
                                            </div>
                                        <?php endif;?>
                                        <?php if($data['isDownloadable']) : ?>
                                            <div>
                                                <a href="/shop/download.php?id=<?php echo $data['productID'] ?>"
                                                    target="_blank">Download</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        </table>

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
