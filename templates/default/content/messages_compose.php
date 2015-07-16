<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}

?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>

    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Compose Messages</h2>

            <form method="post" id="composeform" action="/messages_compose.php">
                <?php render_result_messages() ?>
                <div class="row">
                    <label>To: </label>
                    <span class="inputholder" id="receiverholder">
                        <input type="text" name="receiver" id="receiver" class="input" value=""/>
                        <?php if(isset($receiver) && $receiver['userID']){ ?>
                            <span class="name"><?php echo $receiver['firstName'] . " " . $receiver['lastName'] ?>
                                <a href="#">x</a><input type="hidden" name="to[]" class="receiver-ids"
                                    value="<?php echo $receiver['userID'] ?>"/></span>
                        <?php } ?>
                    </span>

                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>Subject: </label>
                    <span class="inputholder">
                        <input type="text" name="subject" id="subject" class="input"
                            value="<?php echo isset($replyTo) ? "Re: " . $replyTo['subject'] : (isset($_POST['subject']) ? $_POST['subject'] : "") ?>"/>
                    </span>

                    <div class="clear"></div>
                </div>
                <div class="row">
                    <label>&nbsp; </label>
                    <span class="textareaholder">
                        <textarea name="body" id="body" class="textarea"
                            maxlength="5000"><?php echo isset($_POST['body']) ? $_POST['body'] : "" ?></textarea>
                    </span>

                    <div class="clear"></div>
                </div>
                <div class="btn-row">
                    <input type="submit" id="send_message" name="send_message" class="redButton" value="Send"/></div>

                <input type="hidden" name="action" value="compose_message"/> <input type="hidden" name="userID"
                    value="<?php echo $userID ?>"/>
                <?php
                render_form_token();
                ?>
                <?php render_loading_wrapper(); ?>
            </form>
        </section>
    </section>
</section>