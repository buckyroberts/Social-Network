<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}


$tradeList = $view['trades'];

?>


<section id="main_section">

    <?php buckys_get_panel('trade_top_search'); ?>

    <?php buckys_get_panel('trade_main_nav'); ?>
    <section id="right_side" class="floatright">

        <span class="small-titles"><?php echo $view['pagetitle']; ?></span><br/>

        <div class="offer-received trade-completed-panel">
            <?php if(isset($tradeList) && count($tradeList) > 0) : ?>

                <div class="top-header-cont">
                    <div class="n1">My Item</div>
                    <div class="n2">Their Item</div>
                    <div class="n3">Actions</div>
                    <div class="clear"></div>
                </div>


                <?php
                foreach($tradeList as $tradeData) :

                    $myPrefix = '';
                    $theirPrefix = '';

                    if($tradeData['sellerID'] == $view['myID']){
                        //I'm seller for this tradeData
                        $myPrefix = 'seller';
                        $theirPrefix = 'buyer';
                    }else{
                        //I'm buyer for this tradeData
                        $myPrefix = 'buyer';
                        $theirPrefix = 'seller';
                    }

                    $userIns = new BuckysUser();
                    $tradeData['theirBasicInfo'] = $userIns->getUserBasicInfo($tradeData[$theirPrefix . 'ID']);

                    $myTrackingNumber = $tradeData[$myPrefix . 'TrackingNo'];
                    $theirTrackingNumber = $tradeData[$theirPrefix . 'TrackingNo'];

                    // $myItemImage = fn_buckys_get_item_first_image_thumb($tradeData[$myPrefix . 'ItemImages']);
                    // $theirItemImage = fn_buckys_get_item_first_image_thumb($tradeData[$theirPrefix . 'ItemImages']);
                    $myItemImage = fn_buckys_get_item_first_image_normal($tradeData[$myPrefix . 'ItemImages']);
                    $theirItemImage = fn_buckys_get_item_first_image_normal($tradeData[$theirPrefix . 'ItemImages']);

                    $sendMessageLink = '/messages_compose.php?to=' . $tradeData[$theirPrefix . 'ID'];

                    $dateCreated = date('n/j/y', strtotime($tradeData['tradeCreatedDate']));

                    $myItemLink = '/trade/view.php?id=' . $tradeData[$myPrefix . 'ItemID'];
                    $theirItemLink = '/trade/view.php?id=' . $tradeData[$theirPrefix . 'ItemID'];

                    $totalRating = 'No';
                    $positiveRating = '';

                    if(isset($tradeData[$theirPrefix . 'TotalRating']) && $tradeData[$theirPrefix . 'TotalRating'] > 0){
                        $totalRating = $tradeData[$theirPrefix . 'TotalRating'];
                        if(is_numeric($tradeData[$theirPrefix . 'PositiveRating'])){
                            $positiveRating = number_format($tradeData[$theirPrefix . 'PositiveRating'] / $tradeData[$theirPrefix . 'TotalRating'] * 100, 2, '.', '') . '% Positive';
                        }
                    }

                    $theirID = $tradeData[$theirPrefix . 'ID'];

                    ?>

                    <div class="node">

                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="my">
                                    <div class="image">
                                        <a href="<?php echo $myItemLink;?>"><img src="<?php echo $myItemImage;?>"></a>
                                    </div>
                                    <div class="desc">
                                        <div class="t">
                                            <a href="<?php echo $myItemLink;?>"><?php echo $tradeData[$myPrefix . 'ItemTitle'];?></a>

                                            <div style="color:#999999;margin-top:10px;">Feedback Received:
                                                <?php
                                                $score = $tradeData[$myPrefix . 'FeedbackScore'];
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

                                        <div id="my_shipping_info_<?php echo $tradeData['tradeID']?>"
                                            class="row-shipping-info">
                                            <strong>My Shipping Information:</strong>
                                            <?php
                                            if($tradeData[$myPrefix . 'ShCountryID'] > 0){
                                                echo sprintf("<div>%s</div>", $tradeData[$myPrefix . 'ShFullName']);
                                                echo sprintf("<div>%s</div>", $tradeData[$myPrefix . 'ShAddress']);
                                                echo sprintf("<div>%s</div>", $tradeData[$myPrefix . 'ShAddress2']);
                                                //echo sprintf("<div>%s</div>", $tradeData[$myPrefix . 'ShAddress'] . ' ' . $tradeData[$myPrefix . 'ShAddress2']);
                                                echo sprintf("<div>%s, %s</div>", $tradeData[$myPrefix . 'ShCity'], $tradeData[$myPrefix . 'ShState']);
                                                echo sprintf("<div>%s</div>", $tradeData[$myPrefix . 'ShZip']);
                                                echo sprintf("<div>%s</div>", fn_buckys_get_country_name($tradeData[$myPrefix . 'ShCountryID']));
                                            }else{
                                                echo '<p>You have not filled out your shipping information. Please fill out them by click <a href="/shipping_info.php">here</a>.</p>';
                                            }
                                            ?>
                                            <div style="margin-top:10px;color:#999999;">Tracking Number: <span
                                                    style="color:#006699;"
                                                    id="my_tracking_number_<?php echo $tradeData['tradeID']?>"><?php echo $myTrackingNumber != '' ? $myTrackingNumber : 'None';?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </td>
                                <td class="their">
                                    <div class="image">
                                        <a href="<?php echo $theirItemLink;?>"><img src="<?php echo $theirItemImage;?>"></a>
                                    </div>
                                    <div class="desc">
                                        <div class="t">
                                            <a href="<?php echo $theirItemLink;?>"><?php echo $tradeData[$theirPrefix . 'ItemTitle'];?></a>

                                            <div style="color:#999999;margin-top:10px;">Feedback Given:
                                                <?php
                                                $score = $tradeData[$theirPrefix . 'FeedbackScore'];
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

                                        <!--
										<div class="f-user" style="margin:10px 0px;">
											<div class="f-user-image">
												<a href="/profile.php?user=<?php echo $tradeData[$theirPrefix . 'ID'];?>" class="profileLink">
													<img src="<?php echo BuckysUser::getProfileIcon($tradeData[$theirPrefix . 'ID'])?>" class="postIcons" />                                    
												</a>
											</div>
											<div class="f-user-desc">
												<a href="/profile.php?user=<?php echo $tradeData[$theirPrefix . 'ID'];?>" class="profileLink">
													<span><?php echo trim($tradeData['theirBasicInfo']['firstName'] . ' ' . $tradeData['theirBasicInfo']['lastName']);?></span>
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
										-->

                                        <div id="their_shipping_info_<?php echo $tradeData['tradeID']?>"
                                            class="row-shipping-info">
                                            <div class="clear"></div>
                                            <strong>Their Shipping Information:</strong>
                                            <?php
                                            if($tradeData[$theirPrefix . 'ShCountryID'] > 0){
                                                echo sprintf("<div>%s</div>", $tradeData[$theirPrefix . 'ShFullName']);
                                                echo sprintf("<div>%s</div>", $tradeData[$theirPrefix . 'ShAddress']);
                                                echo sprintf("<div>%s</div>", $tradeData[$theirPrefix . 'ShAddress2']);
                                                echo sprintf("<div>%s, %s</div>", $tradeData[$theirPrefix . 'ShCity'], $tradeData[$theirPrefix . 'ShState']);
                                                echo sprintf("<div>%s</div>", $tradeData[$theirPrefix . 'ShZip']);
                                                echo sprintf("<div>%s</div>", fn_buckys_get_country_name($tradeData[$theirPrefix . 'ShCountryID']));
                                            }else{
                                                echo '<p>User has not filled out their shipping information. Please message user for address.</p>';
                                            }
                                            ?>
                                            <div style="margin-top:10px;color:#999999;">Tracking Number: <span
                                                    style="color:#006699;"
                                                    id="my_tracking_number_<?php echo $tradeData['tradeID']?>"><?php echo $theirTrackingNumber != '' ? $theirTrackingNumber : 'None';?></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="clear"></div>
                                </td>
                                <td class="act">
                                    <div class="action-group">
                                        <input type="hidden" class="tradeID" value="<?php echo $tradeData['tradeID']?>">
                                        <?php if(empty($tradeData[$theirPrefix . 'FeedbackScore']) || $tradeData[$theirPrefix . 'FeedbackScore'] == 0) : ?>
                                            <div>
                                                <a href="javascript:void(0)"
                                                    class="leave_feedback_btn">Leave Feedback</a>
                                            </div>
                                        <?php endif;?>
                                        <div>
                                            <a href="javascript:void(0)"
                                                class="leave_tracking_number_btn"><?php if($tradeData[$myPrefix . 'TrackingNo'] != '')
                                                    echo "Edit";else echo 'Leave';?> Tracking Number</a></div>
                                        <div><a href="<?php echo $sendMessageLink;?>">Send Message</a></div>
                                        <div>
                                            <a href="javascript:void(0)"
                                                class="view_shipping_info_btn">View Shipping Info</a>
                                        </div>
                                        <div style="margin-top:10px;">Trade ID: <span
                                                style="color:#333333;"><?php echo $tradeData['tradeID'];?></span>
                                        </div>
                                        <div>Trade Date: <span style="color:#333333;"><?php echo $dateCreated;?></span>
                                        </div>
                                    </div>
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
