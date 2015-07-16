<?php
/**
 * Friends Page
 */

if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section" class="tinted">

    <!-- Left Side -->
    <?php buckys_get_panel('profile_left_sidebar') ?>

    <!-- 752px -->
    <section id="right_side">
        <div class="info-box" id="friends-box">
            <h3>View All Friends <a href="/profile.php?user=<?php echo $userData['userID'] ?>"
                    class="view-all">(back to profile)</a>
            </h3>
            <?php render_result_messages(); ?>
            <div class="table" id="friends-box" style="margin-bottom:5px;">
                <div class="friends-header">
                    <div class="col-1">Friend</div>
                    <div class="col-2">&nbsp;</div>
                    <div class="col-3">Action</div>
                    <div class="clear"></div>
                </div>
                <?php
                foreach($friends as $i => $row){
                    ?>
                    <div class="tr-friend <?php echo $i == count($friends) - 1 ? 'noborder' : ''?> ">
                        <div class="td-friend-icon"><?php render_profile_link($row, 'friendIcon'); ?></div>
                        <div class="td td-friend-info">
                            <p>
                                <a href="/profile.php?user=<?php echo $row['userID']?>"><b><?php echo $row['fullName'] ?></b></a>
                            </p>

                            <p><?php echo $row['gender']?></p>

                            <p><?php echo $row['birthdate'] != '0000-00-00' ? date('F j, Y', strtotime($row['birthdate'])) : ""?></p>
                        </div>
                        <div class="td td-friend-action">
                            <p>
                                <?php
                                if(($userID = buckys_is_logged_in())):

                                    if(($fid = BuckysFriend::isFriend($userID, $row['userID']))){
                                        ?>
                                        <a href="/myfriends.php?action=unfriend&friendID=<?php echo $row['userID']?><?php echo buckys_get_token_param()?>&return=<?php echo base64_encode("/profile.php?user=" . $row['userID']) ?>"
                                            data-type="buckys-ajax-link">Unfriend</a>
                                        <br/>
                                    <?php
                                    }else{
                                        //Check Friend Request
                                        if(($fid = BuckysFriend::isSentFriendRequest($userID, $row['userID']))){
                                            ?>
                                            <a href="/myfriends.php?action=delete&friendID=<?php echo $row['userID']?><?php echo buckys_get_token_param()?>&return=<?php echo base64_encode("/profile.php?user=" . $row['userID']) ?>"
                                                data-type="buckys-ajax-link">Delete Friend Request</a>
                                            <br/>
                                        <?php
                                        }else if(($fid = BuckysFriend::isSentFriendRequest($row['userID'], $userID))){
                                            ?>
                                            <a href="/myfriends.php?action=accept&friendID=<?php echo $row['userID'] ?><?php echo buckys_get_token_param() ?>&return=<?php echo base64_encode("/profile.php?user=" . $row['userID']) ?>"
                                                data-type="buckys-ajax-link">Approve Friend Request</a>
                                            <br/>
                                            <a href="/myfriends.php?action=decline&friendID=<?php echo $row['userID'] ?><?php echo buckys_get_token_param() ?>&return=<?php echo base64_encode("/profile.php?user=" . $row['userID']) ?>"
                                                data-type="buckys-ajax-link">Decline Friend Request</a>
                                            <br/>
                                        <?php
                                        }else{
                                            ?>
                                            <a href="/myfriends.php?action=request&friendID=<?php echo $row['userID'] ?><?php echo buckys_get_token_param() ?>&friendIDHash=<?php echo buckys_encrypt_id($row['userID']) ?>&return=<?php echo base64_encode("/profile.php?user=" . $row['userID']) ?>"
                                                data-type="buckys-ajax-link">Send Friend Request</a>
                                            <br/>
                                        <?php
                                        }
                                    }

                                endif;
                                ?>
                            </p>
                            <?php if(buckys_not_null($userID)){ ?>
                                <p><a href="/messages_compose.php?to=<?php echo $row['userID'] ?>">Send Message</a></p>
                            <?php } ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php
                }
                if(count($friends) < 1){
                    ?>
                    <div class="tr noborder">
                        Nothing to see here.
                    </div>
                <?php
                }
                ?>
            </div>
            <?php $pagination->renderPaginate("/friends.php?user=" . $profileID . "&", count($friends)); ?>
        </div>

    </section>
</section>