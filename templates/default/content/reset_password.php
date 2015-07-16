<?php
if(!isset($TNB_GLOBALS)){
    die("Invalid Request!");
}
?>
<section id="main_section">
    <section id="wrapper">
        <div id="register-wrapper">
            <h2 class="titles">Reset Password</h2>
            <?php render_result_messages(); ?>
            <form id="resetpwdform" action="/reset_password.php" method="post">
                <div class="row">
                    <label for="password">Password:</label> <input type="password" class="input" maxlength="60"
                        name="password" id="password" autocomplete="off"/>
                </div>
                <div class="row">
                    <label for="password2">Confirm Password:</label> <input type="password" class="input" maxlength="60"
                        name="password2" id="password2" autocomplete="off"/>
                </div>
                <div class="row">
                    <label></label> <input type="submit" value="Save Password" class="redButton"/>
                </div>
                <input type="hidden" name="action" value="reset-password"/> <input type="hidden" name="token"
                    value="<?php echo $token ?>"/>
            </form>
        </div>
    </section>
</section>