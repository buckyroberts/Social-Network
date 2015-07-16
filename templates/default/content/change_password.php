<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <?php buckys_get_panel('account_links'); ?>
    <section id="right_side">
        <section id="right_side_padding" class="user-info-section">
            <h2 class="titles">Change Password</h2>
            <?php render_result_messages() ?>
            <form id="changepwdform" method="post" name="changepwdform" class="user-info" action="/change_password.php">
                <div class="row">
                    <label for="currentPassword">Current Password:</label> <span class="inputholder"><input
                            type="password" id="currentPassword" name="currentPassword" autocomplete="off" class="input"
                            value="<?php echo isset($_POST['currentPassword']) ? $_POST['currentPassword'] : '' ?>"/></span>

                    <div class="clear"></div>
                </div>

                <div class="row">
                    <label for="newPassword">New Password:</label>
                        <span class="inputholder"><input type="password" id="newPassword" name="newPassword"
                                autocomplete="off" class="input"
                                value="<?php echo isset($_POST['newPassword']) ? $_POST['newPassword'] : '' ?>"/>
                        <br/>(8 more characters, At least 1 more number)
                        </span>

                    <div class="clear"></div>
                </div>

                <div class="row">
                    <label for="newPassword2">Confirm New Password:</label> <span class="inputholder"><input
                            type="password" id="newPassword2" name="newPassword2" autocomplete="off" class="input"
                            value="<?php echo isset($_POST['newPassword2']) ? $_POST['newPassword2'] : '' ?>"/></span>

                    <div class="clear"></div>
                </div>

                <!-- Submit Button -->
                <div class="btn-row">
                    <span class="inputholder"><input type="submit" id="submit" name="submit" class="redButton"
                            value="Submit"/></span>

                    <div class="clear"></div>
                </div>
                <input type="hidden" name="action" value="change_password"/> <input type="hidden" name="userID"
                    value="<?php echo $TNB_GLOBALS['user']['userID'] ?>"/> <input type="hidden" name="userIDHash"
                    value="<?php echo buckys_encrypt_id($TNB_GLOBALS['user']['userID']) ?>"/>
            </form>

        </section>
    </section>
</section>
<script type="text/javascript">
    jQuery('#changepwdform').submit(function (){
        var form = $(this);
        var isValid = true;

        if(form.find('#currentPassword').val() == ''){
            form.find('#currentPassword').addClass('input-error');
            isValid = false;
        }
        if(form.find('#newPassword').val() == ''){
            form.find('#newPassword').addClass('input-error');
            isValid = false;
        }
        if(form.find('#newPassword2').val() == ''){
            form.find('#newPassword2').addClass('input-error');
            isValid = false;
        }

        if(!isValid){
            showMessage(form, 'Please complete the fields in red.', true);
        }

        if(isValid && form.find('#newPassword').val() != form.find('#newPassword2').val()){
            form.find('#newPassword').addClass('input-error');
            showMessage(form, 'New password doesn\'t match.', true);
            return false;
        }


        //Validate Password Strength
        if(!validatePasswordStrength(form.find('#newPassword').val())){
            showMessage(form, 'New password should be more than 8 characters and include at least 1 number.', true);
            form.find('#newPassword').addClass('input-error');
            return false;
        }

        return isValid;
    })
</script>
