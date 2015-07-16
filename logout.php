<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

unset($_SESSION['userID']);

setcookie('COOKIE_KEEP_ME_NAME1', null, time() - 1000, "/", TNB_DOMAIN);
setcookie('COOKIE_KEEP_ME_NAME2', null, time() - 1000, "/", TNB_DOMAIN);
setcookie('COOKIE_KEEP_ME_NAME3', null, time() - 1000, "/", TNB_DOMAIN);

buckys_session_destroy();

buckys_redirect('/index.php');