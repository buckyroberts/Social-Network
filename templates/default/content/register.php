<?php
if(!isset($TNB_GLOBALS)){
	die("Invalid Request!");
}
?>
<section id="main_section">
	<section id="wrapper">
		<?php
		// For custom banner image
		if(isset($_GET['for']) && $_GET['for'] == 'usc'){
			echo '<img src="/images/register/usc.jpg" style="margin:10px 0px 10px 10px;display:block;">';
		}
		?>
		<div id="register-wrapper">
			<?php render_result_messages(); ?>
			<div id="new-account">
				<h2 class="titles">Why join <?php echo TNB_SITE_NAME ?>?</h2>

				<div style="margin:5px 10px;font-size:14px;font-family:Lato-Lig;">
					&#x2713; &nbsp;Unlimited access to all videos
					<br/> &#x2713; &nbsp;Become part of the best community on the web!
					<br/> &#x2713; &nbsp;Only accepting new members for a limited time
				</div>
				<!-- Invite Code
				<div style="margin:10px 10px 0px;padding:5px;font-size:15px;font-family:Lato-Lig;">Due to an increasing amount of new users, <?php echo TNB_SITE_NAME ?> is now invitation only. Please contact any member for an Invite Code.</div>
				-->
				<form name="newaccount" method="post" action="" id="newaccount">
					<div class="row">
						<label>First Name:</label> <input type="text" name="firstName" id="firstName" maxlength="30"
						                                  value="" autocomplete="off" class="input"/>
					</div>
					<div class="row">
						<label>Last Name:</label> <input type="text" name="lastName" id="lastName" maxlength="60"
						                                 value="" autocomplete="off" class="input"/>
					</div>
					<div class="row">
						<label>E-mail:</label> <input type="text" name="email" id="email" maxlength="60" value=""
						                              autocomplete="off" class="input"/>
					</div>
					<div class="row">
						<label>Password:</label> <input type="password" name="password" id="password" autocomplete="off"
						                                maxlength="20" value="" autocomplete="off" class="input"/>
					</div>
					<div class="row">
						<label>Confirm Password:</label> <input type="password" name="password2" id="password2"
						                                        autocomplete="off" maxlength="20" value=""
						                                        autocomplete="off" class="input"/>
					</div>
					<div class="row checkbox-row">
						<label><input type="checkbox" name="agree_terms" id="agree_terms" value="1"/> I accept the <a
								href="/terms_of_service.php" target="_blank">Terms and Conditions</a>.</label>
					</div>

					<!-- Do not display the CAPTCHA in developer mode -->
					<?php if(!DEVELOPER_MODE){ ?>
						<div class="row captcha-row">
							<?php echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY, null, true); ?>
							<div class="clear"></div>
						</div>
					<?php } ?>

					<div class="row"><label></label> <input class="redButton" value="Register" type="submit"/>
					</div>
					<?php render_loading_wrapper(); ?>
				</form>
			</div>
			<div id="login-wrap">
				<h2 class="titles">Login</h2>

				<form id="loginform" action="/login.php"
				      method="post" <?php echo $showForgotPwdForm ? 'style="display: none"' : '' ?>>
					<div class="row">
						<label for="email">E-mail:</label> <input type="text" class="input" maxlength="60" name="email"
						                                          id="email"/>
					</div>
					<div class="row">
						<label for="password">Password:</label> <input type="password" class="input" maxlength="20"
						                                               name="password" id="password"
						                                               autocomplete="off"/>
					</div>
					<div class="row" style="padding:3px 0;">
						<label></label> <a href="/register.php#forgotpwdform"
						                   class="goto-forgotpwdform">Forgot password?</a>
					</div>
					<div class="row">
						<label></label> <input type="submit" value="Log In" class="redButton" name="login_submit">
					</div>
					<?php if($returnUrl){ ?>
						<input type="hidden" name="return" value="<?php echo $returnUrl ?>"/>
					<?php } ?>
				</form>
				<form id="forgotpwdform" action="/register.php"
				      method="post" <?php echo !$showForgotPwdForm ? 'style="display: none"' : '' ?>>
					<div class="row">
						<label for="email">E-mail:</label> <input type="text" class="input" maxlength="60" name="email"
						                                          id="email"/>
					</div>
					<div class="row" style="padding:3px 0px;">
						<label></label> <a href="/register.php#loginform" class="goto-loginform">Login</a>
					</div>
					<div class="row">
						<label></label> <input type="submit" value="Reset Password" class="redButton"/>
					</div>
					<input type="hidden" name="action" value="reset-password"/>
					<?php
					render_form_token();
					?>
				</form>
			</div>
			<div class="clear"></div>
		</div>
	</section>
</section>