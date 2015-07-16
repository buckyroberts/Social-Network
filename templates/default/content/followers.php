<?php
/**
 * Follower Page
 */

if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}


$pageData = $view['pageData'];
$followers = $view['followers'];

?>
<section id="main_section" class="tinted">

    <!-- Left Side -->
    <?php buckys_get_panel('page_left_sidebar'); ?>

    <!-- 752px -->
    <section id="right_side">
        <div class="info-box" id="friends-box">
            <h3>View All Members <a href="/page.php?pid=<?php echo $pageData['pageID'] ?>"
                    class="view-all">(back to page)</a></h3>
            <?php render_result_messages(); ?>
            <div class="table" id="friends-box" style="margin-bottom:5px;">
                <div class="friends-header">
                    <div class="col-1">Member</div>
                    <div class="col-2">&nbsp;</div>
                    <div class="col-3">Action</div>
                    <div class="clear"></div>
                </div>
                <?php
                foreach($followers as $i => $row){
                    ?>
                    <div class="tr-friend <?php echo $i == count($followers) - 1 ? 'noborder' : ''?> ">
                        <div class="td-friend-icon"><?php render_profile_link($row, 'friendIcon'); ?></div>
                        <div class="td td-friend-info">
                            <p>
                                <a href="/profile.php?user=<?php echo $row['userID']?>"><b><?php echo $row['fullName'] ?></b></a>
                            </p>

                            <p><?php echo $row['gender']?></p>

                            <p><?php echo $row['birthdate'] != '0000-00-00' ? date('F j, Y', strtotime($row['birthdate'])) : ""?></p>
                        </div>
                        <div class="td td-friend-action">
                            <p><a href="/profile.php?user=<?php echo $row['userID']?>">View Profile</a></p>
                            <?php if(buckys_not_null($userID)){ ?>
                                <p><a href="/messages_compose.php?to=<?php echo $row['userID'] ?>">Send Message</a></p>
                            <?php } ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php
                }
                if(count($followers) < 1){
                    ?>
                    <div class="tr noborder">
                        Nothing to see here.
                    </div>
                <?php
                }
                ?>
            </div>
            <?php $pagination->renderPaginate("/followers.php?pid=" . $pageData['pageID'] . "&", count($followers)); ?>
        </div>

    </section>
</section>