<?php
/**
 * Footer
 */
?>
    <div id="main_footer">
        <?php if(!$userID){ ?>
            <a href="/register.php" class="headerLinks">Register</a> |
            <a href="/register.php?forgotpwd=1" class="headerLinks">Forgot Password</a> <?php } ?>
    </div>
<?php
buckys_get_panel('footer_panel');
?>