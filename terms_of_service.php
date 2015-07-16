<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

buckys_enqueue_stylesheet('static.css');

$TNB_GLOBALS['content'] = "terms_of_service";

$TNB_GLOBALS['title'] = "Terms of Service - " . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
