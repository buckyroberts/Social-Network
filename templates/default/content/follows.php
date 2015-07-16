<?php
/**
 * Profile Detail Page
 */

if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}

$followedPages = $view['pages'];

?>
<section id="main_section" class="tinted">

    <!-- Left Side -->
    <?php buckys_get_panel('profile_left_sidebar') ?>

    <!-- 752px -->
    <section id="right_side" class="profile-contr">

        <div class="info-box" id="friends-box">
            <h3>View All Pages <a href="/profile.php?user=<?php echo $userData['userID'] ?>"
                    class="view-all">(back to profile)</a>
            </h3>
            <?php render_result_messages(); ?>
            <div class="table" id="friends-box" style="margin-bottom:5px;">
                <div class="friends-header">
                    <div class="col-1">Page</div>
                    <div class="col-2">&nbsp;</div>
                    <div class="col-3">Action</div>
                    <div class="clear"></div>
                </div>
                <?php
                foreach($followedPages as $i => $row){
                    ?>
                    <div class="tr-friend <?php echo $i == count($followedPages) - 1 ? 'noborder' : ''?> ">
                        <div class="td-friend-icon"><?php render_pagethumb_link($row, 'friendIcon'); ?></div>
                        <div class="td td-friend-info">
                            <p>
                                <a href="/page.php?pid=<?php echo $row['pageID']?>"><b><?php echo $row['title'] ?></b></a>
                            </p>

                            <p><?php echo $row['followerCount']?> follower<?php if($row['followerCount'] != 1)
                                    echo 's'; ?></p>
                        </div>
                        <div class="td td-friend-action">
                            <p><a href="/page.php?pid=<?php echo $row['pageID']?>">View Page</a></p>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php
                }
                if(count($followedPages) < 1){
                    ?>
                    <div class="tr noborder">
                        Nothing to see here.
                    </div>
                <?php
                }
                ?>
            </div>
            <?php $pagination->renderPaginate("/follows.php?user=" . $view['profileID'] . "&", count($followedPages)); ?>
        </div>

    </section>
</section>