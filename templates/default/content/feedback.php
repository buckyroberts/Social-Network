<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}


$feedbackList = $view['feedback'];
$userIns = new BuckysUser();

if(!$view['myRatingInfo'])
    $view['myRatingInfo'] = [];

?>

<section id="main_section">

    <?php buckys_get_panel('trade_top_search'); ?>

    <section id="feedback-left-panel">
        <?php
        $myInfo = $userIns->getUserBasicInfo($view['myID']);
        $myData = BuckysUser::getUserData($view['myID']);

        $totalRating = 'No';
        $positiveRating = '';

        if($view['myRatingInfo']['totalRating'] != '' && $view['myRatingInfo']['totalRating'] > 0){
            $totalRating = $view['myRatingInfo']['totalRating'];
            if(is_numeric($view['myRatingInfo']['positiveRating'])){
                $positiveRating = number_format($view['myRatingInfo']['positiveRating'] / $totalRating * 100, 2, '.', '') . '% Positive';
            }
        }


        ?>
        <div class="titles">
            <?php echo trim($myInfo['firstName'] . ' ' . $myInfo['lastName']); ?>
        </div>
        <div class="feedback-user-img" style="margin:5px 0px;">
            <?php render_profile_link($myData, 'mainProfilePic'); ?>
        </div>
        <div>
            <?php
            if(is_numeric($totalRating)){
                echo sprintf('<a href="%s" class="rating">(%d ratings)</a> %s', '/feedback.php?user=' . $view['myID'], $totalRating, $positiveRating);
            }else{
                echo sprintf('(%s ratings)', $totalRating);
            }
            ?>
        </div>
    </section>
    <section id="feedback-right-panel">

        <span class="titles">Feedback</span><br/>

        <div style="margin-top:10px;margin-bottom:10px;">
            <?php if($view['type'] != 'received'): ?>
                <a href="/feedback.php?user=<?php echo $view['myID']; ?>">Received</a> &middot;
                <span style="color:#C0392B;font-weight:bold;">Given</span>
            <?php else : ?>
                <span style="color:#C0392B;font-weight:bold;">Received</span> &middot;
                <a href="/feedback.php?user=<?php echo $view['myID']; ?>&type=given">Given</a>
            <?php endif; ?>

        </div>
        <div class="trade-available-list">
            <?php if(isset($feedbackList) && count($feedbackList) > 0) : ?>

                <table cellpadding="0" cellspacing="0" class="feedback-table">
                    <thead>
                    <th width="440" style="padding-left:45px;">Feedback</th>
                    <th width="230"><?php if($view['type'] == 'received')
                            echo 'From';else echo 'To'; ?></th>
                    <th width="100">Date</th>
                    </thead>
                    <tbody>

                    <?php
                    foreach($feedbackList as $feedbackData) :

                        $feedbackText = $feedbackData['comment'];
                        $feedbackScore = $feedbackData['score'];
                        $itemTitle = $feedbackData['tradeItemTitle'];
                        if($feedbackData['activityType'] == BuckysFeedback::ACTIVITY_TYPE_SHOP){
                            $itemTitle = $feedbackData['productTitle'];
                        }
                        $feedbackDate = $feedbackData['createdDate'];

                        $theirID = '';
                        $theirTotalRating = '';
                        $theirPositiveRating = '';

                        if($view['type'] == 'received'){

                            $theirID = $feedbackData['writerID'];
                            $theirTotalRating = $feedbackData['writerRating'];
                            $theirPositiveRating = $feedbackData['writerPositiveRating'];

                        }else{
                            $theirID = $feedbackData['receiverID'];
                            $theirTotalRating = $feedbackData['receiverRating'];
                            $theirPositiveRating = $feedbackData['receiverPositiveRating'];
                        }

                        $feedbackDate = date('F j, Y', strtotime($feedbackDate));

                        $totalRating = 'No';
                        $positiveRating = '';

                        if($theirTotalRating != '' && $theirTotalRating > 0){
                            $totalRating = $theirTotalRating;
                            if(is_numeric($theirPositiveRating)){
                                $positiveRating = number_format($theirPositiveRating / $totalRating * 100, 2, '.', '') . '% Positive';
                            }
                        }

                        $theirInfo = $userIns->getUserBasicInfo($theirID);


                        ?>
                        <tr>
                            <td>
                                <div class="<?php if($feedbackScore > 0)
                                    echo 'feedback-positive';else echo 'feedback-negative';?>"></div>
                                <div class="f-text">
                                    <p><?php echo $feedbackText;?></p>

                                    <div class="i-title"><?php echo $itemTitle;?></div>
                                </div>
                                <div class="clear"></div>
                            </td>
                            <td>

                                <div class="f-user-image">
                                    <a href="/profile.php?user=<?php echo $theirID;?>" class="profileLink"> <img
                                            src="<?php echo BuckysUser::getProfileIcon($theirID)?>" class="postIcons"/>
                                    </a>
                                </div>
                                <div class="f-user-desc">
                                    <a href="/profile.php?user=<?php echo $theirID;?>" class="profileLink">
                                        <span><?php echo trim($theirInfo['firstName'] . ' ' . $theirInfo['lastName']);?></span>
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

                            </td>
                            <td>
                                <?php echo $feedbackDate;?>
                            </td>
                        </tr>


                    <?php endforeach; ?>
                    </tbody>
                </table>

                <?php buckys_get_panel('common_pagination'); ?>

            <?php else: ?>

                <div class="no-trade-data"> - No data available -</div>

            <?php endif; ?>

        </div>

        <div class="clear"></div>

    </section>
</section>
