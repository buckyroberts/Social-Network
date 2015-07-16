<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

header("content-type: application/javascript");

//Create Form Token
$formToken = buckys_get_form_token();
echo 'document.write(\'<iframe width="\' + buckysroom_ad_width +\'" height="\' + buckysroom_ad_height +\'" src="//' . TNB_DOMAIN . '/buckys_ad.php?ad=\' + buckysroom_ad_token + \'&' . $formToken . '=1" style="padding:0;margin: 0; border: none"></iframe>\');';
