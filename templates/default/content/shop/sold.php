<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}


$soldList = $view['sold'];

?>


<section id="main_section">

    <?php buckys_get_panel('shop_top_search'); ?>

    <?php buckys_get_panel('shop_main_nav'); ?>
    <section id="right_side" class="floatright">

        <span class="titles">My Sold Items</span><br/>

        <div class="order-history">

            <?php echo buckys_get_messages(); ?>

            <?php if(isset($soldList) && count($soldList) > 0) : ?>

                <div class="top-header-cont">
                    <div class="n1">Item</div>
                    <div class="n2">Price</div>
                    <div class="n3">Order Details</div>
                    <div class="n4">Actions</div>
                    <div class="clear"></div>
                </div>


                <?php
                foreach($soldList as $data) :

                    $prodImage = fn_buckys_get_item_first_image_thumb($data['images']);
                    $sendMessageLink = '/messages_compose.php?to=' . $data['buyerID'];

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
                                                    echo sprintf('<span class="blue" id="my_tracking_number_%d">%s</span>', $data['orderID'], $data['trackingNo']);
                                                }else{
                                                    echo sprintf('<span id="my_tracking_number_%d">None</span>', $data['orderID']);
                                                }

                                                ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="grey-text">Feedback Received:
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

                                        <?php if(!$data['isDownloadable']): ?>
                                            <div id="shipping_info_<?php echo $data['orderID'] ?>"
                                                class="row-shipping-info">
                                                <strong>Their Shipping Information:</strong>

                                                <div>
                                                    <?php

                                                    $countryData = BuckysCountry::getCountryById($data['countryID']);

                                                    $shippingAddressVal = '<div>' . $data['fullName'] . '</div>' . '<div>' . $data['address'] . '</div>' . '<div>' . $data['address2'] . '</div>' . '<div>' . $data['city'] . ', ' . $data['state'] . '</div>' . '<div>' . $data['zip'] . '</div>' . '<div>' . $countryData["country_title"] . '</div>';
                                                    ?>

                                                    <?php echo $shippingAddressVal; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
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
                                        <div><a href="<?php echo $sendMessageLink;?>">Send Message</a></div>
                                        <?php if(!$data['isDownloadable']): ?>
                                            <div>
                                                <a href="javascript:void(0)"
                                                    class="view_shipping_info_btn">View Shipping Info</a>
                                            </div>


                                            <input type="hidden" class="orderID" value="<?php echo $data['orderID'] ?>">
                                            <div>
                                                <a href="javascript:void(0)"
                                                    class="leave_tracking_number_btn"><?php if($data['trackingNo'] == '')
                                                        echo 'Leave';else echo 'Edit'; ?> Tracking Number</a></div>
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
