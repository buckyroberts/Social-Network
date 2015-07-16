<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>
    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Delete Account</h2>
            <?php render_result_messages() ?>

            <form id="deleteaccountform" method="post" name="deleteaccountform" class="user-info"
                action="/delete_account.php">
                <p>When you delete your account all of our information, posts, pictures, trade items, forum posts, and credits will be permanently deleted.</p>

                <div class="row">
                    <label for="password">Password:</label> <span class="inputholder"><input type="password"
                            id="password" name="password" autocomplete="off" class="input"
                            value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>"/></span>

                    <div class="clear"></div>
                </div>

                <div class="row">
                    <label for="password2">Confirm Password:</label> <span class="inputholder"><input type="password"
                            id="password2" name="password2" autocomplete="off" class="input"
                            value="<?php echo isset($_POST['password2']) ? $_POST['password2'] : '' ?>"/></span>

                    <div class="clear"></div>
                </div>

                <!-- Submit Button -->
                <div class="btn-row">
                    <span class="inputholder"><input type="submit" class="redButton" value="Submit"/></span>

                    <div class="clear"></div>
                </div>
                <input type="hidden" name="action" value="delete_account"/> <input type="hidden" name="userID"
                    value="<?php echo $TNB_GLOBALS['user']['userID'] ?>"/> <input type="hidden" name="userIDHash"
                    value="<?php echo buckys_encrypt_id($TNB_GLOBALS['user']['userID']) ?>"/>
            </form>

        </section>
    </section>
</section>
<script type="text/javascript">
    jQuery('#deleteaccountform').submit(function (){
        var form = $(this);
        var isValid = true;

        if(form.find('#password').val() == ''){
            form.find('#password').addClass('input-error');
            isValid = false;
        }
        if(form.find('#password2').val() == ''){
            form.find('#password2').addClass('input-error');
            isValid = false;
        }

        if(!isValid){
            showMessage(form, 'Please complete the fields in red.', true);
        }

        if(isValid && form.find('#password').val() != form.find('#password2').val()){
            form.find('#password').addClass('input-error');
            isValid = false;
            showMessage(form, 'New password doesn\'t match.', true);
        }

        if(!isValid)
            return false;

        if(confirm('Are you sure that you want to delete your account?'))
            return true;else
            return false;
    })
</script>
