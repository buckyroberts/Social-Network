<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

buckys_enqueue_stylesheet('static.css');

$BUCKYS_GLOBALS['content'] = "faq";

$BUCKYS_GLOBALS['title'] = "FAQ - " . BUCKYSROOM_SITE_NAME;

require(DIR_FS_TEMPLATE . $BUCKYS_GLOBALS['template'] . "/" . $BUCKYS_GLOBALS['layout'] . ".php"); 
