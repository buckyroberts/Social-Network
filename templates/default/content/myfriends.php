<?php
/**
 * My Friends Page
 */

if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>
    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">
                <?php
                switch($type){
                    case 'pending':
                        echo 'Pending Approval';
                        break;
                    case 'requested':
                        echo 'Friend Requests';
                        break;
                    case 'all':
                    default:
                        echo 'All Friends';
                        break;
                }
                ?>
            </h2>

            <form name="myfriendsform" id="myfriendsform" method="post" action="/myfriends.php">
                <?php render_result_messages(); ?>
                <?php
                if(count($friends) < 1){
                    ?>
                    <div class="tr noborder">
                        Nothing to see here.
                    </div>
                <?php
                }else{ ?>
                    <?php //$pagination->renderPaginate("/myfriends.php?type=" . $type . "&", count($friends));
                    ?>
                    <div class="table" id="friends-box">
                        <div class="thead">
                            <div class="td td-chk" style="padding-top:3px;"><input type="checkbox" id="chk_all"/></div>
                            <div class="td-friend-icon" style="padding:3px 0px; color:#999999;">Friend</div>
                            <div class="td td-friend-info"></div>
                            <div class="td td-friend-action">Action</div>
                            <div class="clear"></div>
                        </div>
                        <?php
                        foreach($friends as $i => $row){
                            ?>
                            <div class="tr <?php echo $i == count($friends) - 1 ? 'noborder' : ''?> "
                                style="padding:10px 5px;">
                                <div class="td td-chk">
                                    <input type="checkbox" name="friendID[]" value="<?php echo $row['userID']?>"/></div>
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
                                <span class="friend-actions">
                                <?php

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

                                ?>
                                </span>
                                    </p>

                                    <p><a href="/messages_compose.php?to=<?php echo $row['userID']?>">Send Message</a>
                                    </p>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div style="width:500px; float:right;">
                        <?php $pagination->renderPaginate("/myfriends.php?type=" . $type . "&", count($friends)); ?>
                    </div>
                    <div class="btn-row">
                    <span class="inputholder">  
                    <?php if($type == 'all'){ ?>
                        <input type="button" id="unfriend" class="redButton" value="Unfriend"/>
                    <?php }else if($type == 'pending'){ ?>
                        <input type="button" id="delete-request" class="redButton" value="Delete Request"/>
                    <?php }else if($type == 'requested'){ ?>
                        <input type="button" id="accept-request" class="redButton" value="Approve"
                            style="margin-right:5px;"/>
                        <input type="button" id="decline-request" class="redButton" value="Decline"/>
                    <?php } ?>
                    </span>

                        <div class="clear"></div>
                    </div>
                    <input type="hidden" name="action" id="action" value=""/>
                    <input type="hidden" name="type" id="type" value="<?php echo $type?>"/>
                <?php } ?>
                <br/> <br/>
                <?php render_form_token(); ?>
            </form>
        </section>
    </section>
</section>
