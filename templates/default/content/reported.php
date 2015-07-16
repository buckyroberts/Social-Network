<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">
                Moderator Panel
            </h2>

            <form method="post" id="reportedform" action="/reported.php" style="padding-top:0px;">
                <?php render_result_messages() ?>
                <?php
                if(count($objects) == 0){
                    ?>
                    <div class="tr noborder">
                        Nothing to see here.
                    </div>
                <?php
                }else{
                    ?>
                    <?php $pagination->renderPaginate('/reported.php?', count($objects)); ?>
                    <div class="table">
                        <div class="thead">
                            <div class="td td-chk"><input type="checkbox" id="chk_all" name="objectID[]"/></div>
                            <div class="td td-user">Reported User</div>
                            <div class="td td-content">Item</div>
                            <div class="td td-reporter">Reported By</div>
                            <div class="td td-date">Date</div>
                            <div class="clear"></div>
                        </div>
                        <?php
                        foreach($objects as $i => $row){
                            ?>
                            <div class="tr <?php echo $i == count($objects) - 1 ? 'noborder' : ''?>">
                                <div class="td td-chk">
                                    <input type="checkbox" id="chk<?php echo $row['messageID']?>" name="reportID[]"
                                        value="<?php echo $row['reportID']?>"
                                        data-acl='<?php echo $row['user_acl_id']?>'/>
                                </div>
                                <div class="td td-user">
                                    <a href="/profile.php?user=<?php echo $row['ownerID']?>">
                                        <?php echo $row['ownerName']; ?>
                                    </a>
                                </div>
                                <div class="td td-content">
                                    <?php
                                    switch($row['objectType']){
                                        case 'post':
                                            echo '<a href="/posts.php?user=' . $row['ownerID'] . '&post=' . $row['objectID'] . '">Post - ' . $row['objectID'] . '</a>';
                                            break;
                                        case 'comment':
                                            $tPost = BuckysComment::getPost($row['objectID']);
                                            echo '<a href="/posts.php?user=' . $tPost['poster'] . '&post=' . $tPost['postID'] . '">Comment - ' . $row['objectID'] . '</a>';
                                            break;
                                        case 'video_comment':
                                            echo '<a href="/videos.php?video=' . BuckysVideo::getVideoIDByCommentID($row['objectID']) . '">Video Comment - ' . $row['objectID'] . '</a>';
                                            break;
                                        case 'topic':
                                            echo '<a href="/forum/topic.php?id=' . $row['objectID'] . '">Forum Topic - ' . $row['objectID'] . '</a>';
                                            break;
                                        case 'message':
                                            echo '<a href="/messages_read.php?message=' . $row['objectID'] . '">Message - ' . $row['objectID'] . '</a>';
                                            break;
                                        case 'reply':
                                            echo '<a href="/forum/topic.php?id=' . BuckysForumReply::getForumID($row['objectID']) . '">Forum Reply - ' . $row['objectID'] . '</a>';
                                            break;
                                        case 'trade_item':
                                            echo '<a href="/trade/view.php?id=' . $row['objectID'] . '">Trade Item - ' . $row['objectID'] . '</a>';
                                            break;
                                        case 'shop_item':
                                            echo '<a href="/shop/view.php?id=' . $row['objectID'] . '">Shop Product - ' . $row['objectID'] . '</a>';
                                            break;

                                    }
                                    ?>

                                </div>
                                <div class="td td-reporter">
                                    <a href="/profile.php?user=<?php echo $row['reporterID']?>">
                                        <?php echo $row['reporterName']; ?>
                                    </a>
                                </div>
                                <div class="td td-date">
                                    <?php echo buckys_format_date($row['reportedDate']); ?>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="btn-row">
                        <input type="button" class="redButton" value="Approve Selected" id="approve-objects"/> <input
                            type="button" class="redButton" value="Delete Selected" id="delete-objects"/> <input
                            type="button" class="redButton" value="Ban Users" id="ban-users"/>
                    </div>
                    <input type="hidden" name="action" value=""/>
                <?php } ?>
            </form>
        </section>
    </section>
</section>