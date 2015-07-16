<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Inbox</h2>

            <form method="post" id="messagelistform" action="/messages_inbox.php" class="user-info">
                <?php render_result_messages() ?>
                <?php
                if(count($messages) == 0){
                    ?>
                    <div class="tr noborder">
                        Nothing to see here.
                    </div>
                <?php
                }else{
                    ?>
                    <div class="table" style="margin-bottom:5px;">
                        <div class="thead">
                            <div class="td td-chk"><input type="checkbox" id="chk_all"/></div>
                            <div class="td td-from">From</div>
                            <div class="td td-subject">Subject</div>
                            <div class="td td-date">Date</div>
                            <div class="clear"></div>
                        </div>
                        <?php
                        foreach($messages as $i => $row){
                            ?>
                            <div
                                class="tr <?php echo $i == count($messages) - 1 ? 'noborder' : ''?> <?php echo $row['status'] == 'unread' ? 'tr-unread' : ''?>">
                                <div class="td td-chk">
                                    <input type="checkbox" id="chk<?php echo $row['messageID']?>" name="messageID[]"
                                        value="<?php echo $row['messageID']?>"/>
                                </div>
                                <div class="td td-from">
                                    <a href="/profile.php?user=<?php echo $row['sender']?>"><?php echo $row['senderName']?></a>
                                </div>
                                <div class="td td-subject">
                                    <a href="/messages_read.php?message=<?php echo $row['messageID']?>"><?php echo $row['subject']?></a>
                                </div>
                                <div
                                    class="td td-date"><?php echo buckys_format_date($row['created_date'], "F j, Y h:i A")?></div>
                                <div class="clear"></div>
                            </div>
                        <?php
                        }
                        if(count($messages) == 0){
                            ?>
                            <div class="tr noborder">
                                Nothing to see here.
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php $pagination->renderPaginate('/messages_inbox.php?', count($messages)); ?>
                    <div class="btn-row" style="margin-top:0px; margin-left:8px;">
                        <input type="button" class="redButton" value="Delete" id="delete-messages"/></div>
                    <input type="hidden" name="action" value="delete_messages"/>
                    <input type="hidden" name="userID" value="<?php echo $userID?>"/>
                <?php } ?>
            </form>
        </section>
    </section>
</section>