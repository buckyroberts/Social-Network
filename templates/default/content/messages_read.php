<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Read Message</h2>

            <div class="prev-next-links">
                <?php if($prevID){ ?>
                    <a href="/messages_read.php?message=<?php echo $prevID ?>" class="prev-message">Prev</a>
                <?php } ?>
                <?php if($nextID){ ?>
                    <a href="/messages_read.php?message=<?php echo $nextID ?>" class="next-message">Next</a>
                <?php } ?>

            </div>
            <form method="post" id="messagedetailform" action="/messages_read.php" class="user-info">
                <?php render_result_messages() ?>
                <div class="message-detail">
                    <div class="row">
                        <label>To: </label> <a
                            href="/profile.php?user=<?php echo $message['receiver'] ?>"><?php echo $message['receiverName'] ?></a>

                        <div class="clear"></div>
                    </div>
                    <div class="row">
                        <label>From: </label> <a
                            href="/profile.php?user=<?php echo $message['sender'] ?>"><?php echo $message['senderName'] ?></a>

                        <div class="clear"></div>
                    </div>
                    <div class="row">
                        <label>Date Sent: </label>
                        <span><?php echo date("F j, Y", strtotime($message['created_date'])) ?></span>

                        <div class="clear"></div>
                    </div>
                    <div class="row">
                        <label>Subject: </label> <span><b><?php echo $message['subject'] ?></b></span>
                        <?php
                        if($userID != $message['sender'] && !$message['reportID']){ ?>
                            <a href="/report_object.php" data-type="message"
                                data-id="<?php echo $message['messageID']?>"
                                data-idHash="<?php echo buckys_encrypt_id($message['messageID'])?>"
                                class="report-link">Report</a>
                        <?php } ?>
                        <?php if(buckys_check_user_acl(USER_ACL_MODERATOR) && $message['reportID']): ?>
                            <span class="moderator-action-links">
                                <a href="/reported.php?action=approve-objects&reportID=<?php echo $message['reportID'] ?>">Approve Message</a>
                                &middot;
                                <a href="/reported.php?action=delete-objects&reportID=<?php echo $message['reportID'] ?>">Delete Message</a>
                            </span>
                        <?php endif; ?>
                        <div class="clear"></div>
                    </div>
                    <div class="row message-body">
                        <?php echo render_enter_to_br($message['body']); ?>
                    </div>
                </div>
                <?php if($msgType != 'reported'): ?>
                    <div class="btn-row">
                        <?php if($message['sender'] != $userID){ ?>
                            <input type="button" class="redButton" value="Reply" id="reply-message"
                                data-id="<?php echo $message['messageID'] ?>" style="margin-right:5px;"/>
                        <?php } ?>
                        <?php if($message['is_trash']){ ?>
                            <input type="button" class="redButton" value="Delete Forever" id="delete-forever"/>
                        <?php }else{ ?>
                            <input type="button" class="redButton" value="Delete" id="delete-message"/>
                        <?php } ?>
                    </div>
                <?php endif; ?>
                <input type="hidden" name="action" id="action" value=""/> <input type="hidden" name="userID"
                    value="<?php echo $userID ?>"/> <input type="hidden" name="senderID"
                    value="<?php echo $message['sender'] ?>"/> <input type="hidden" name="messageID"
                    value="<?php echo $message['messageID'] ?>"/>
            </form>
        </section>
    </section>
</section>