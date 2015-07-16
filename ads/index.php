<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

//Getting Current User ID
/*
if( !buckys_check_user_acl(USER_ACL_REGISTERED) )
{
    buckys_redirect('/index.php', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}
*/

$userID = buckys_is_logged_in();

buckys_enqueue_stylesheet('publisher.css');

$TNB_GLOBALS['headerType'] = "ads";
$TNB_GLOBALS['content'] = "ads/index";

$TNB_GLOBALS['title'] = "thenewboston Ads - Bitcoin Advertising Network";

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
