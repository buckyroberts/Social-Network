<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Trash</h2>

            <form method="post" id="messagelistform" action="/messages_trash.php" class="user-info">
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
                    <div class="table" id="trash-table" style="margin-bottom:5px;">
                        <div class="thead">
                            <div class="td td-chk"><input type="checkbox" id="chk_all"/></div>
                            <div class="td td-from">From</div>
                            <div class="td td-to">To</div>
                            <div class="td td-subject">Subject</div>
                            <div class="td td-date">Date</div>
                            <div class="clear"></div>
                        </div>
                        <?php
                        foreach($messages as $i => $row){
                            ?>
                            <div class="tr <?php echo $i == count($messages) - 1 ? 'noborder' : ''?>">
                                <div class="td td-chk">
                                    <input type="checkbox" id="chk<?php echo $row['messageID']?>" name="messageID[]"
                                        value="<?php echo $row['messageID']?>"/>
                                </div>
                                <?php if($row['sender'] == $userID){ ?>
                                    <div class="td td-from">
                                        <a href="/profile.php?user=<?php echo $row['sender'] ?>"><?php echo $userData['firstName'] . " " . $userData['lastName'] ?></a>
                                    </div>
                                    <div class="td td-to">
                                        <a href="/profile.php?user=<?php echo $row['receiver'] ?>"><?php echo $row['userName'] ?></a>
                                    </div>
                                <?php }else{ ?>
                                    <div class="td td-from">
                                        <a href="/profile.php?user=<?php echo $row['sender'] ?>"><?php echo $row['userName'] ?></a>
                                    </div>
                                    <div class="td td-to">
                                        <a href="/profile.php?user=<?php echo $row['receiver'] ?>"><?php echo $userData['firstName'] . " " . $userData['lastName'] ?></a>
                                    </div>
                                <?php } ?>
                                <div class="td td-subject">
                                    <a href="/messages_read.php?message=<?php echo $row['messageID']?>"><?php echo $row['subject']?></a>
                                </div>
                                <div
                                    class="td td-date"><?php echo date("F j, Y h:i A", strtotime($row['created_date']))?></div>
                                <div class="clear"></div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php $pagination->renderPaginate('/messages_trash.php?', count($messages)); ?>
                    <div class="btn-row" style="margin-top:0px; margin-left:8px;">
                        <input type="button" class="redButton" value="Delete Forever" id="delete-messages"/></div>
                    <input type="hidden" name="action" value="delete_messages"/>
                    <input type="hidden" name="userID" value="<?php echo $userID?>"/>
                <?php } ?>
            </form>
        </section>
    </section>
</section>