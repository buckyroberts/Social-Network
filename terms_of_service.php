<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

buckys_enqueue_stylesheet('static.css');

$BUCKYS_GLOBALS['content'] = "terms_of_service";

$BUCKYS_GLOBALS['title'] = "Terms of Service - " . BUCKYSROOM_SITE_NAME;

require(DIR_FS_TEMPLATE . $BUCKYS_GLOBALS['template'] . "/" . $BUCKYS_GLOBALS['layout'] . ".php"); 
