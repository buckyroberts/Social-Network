<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

//Getting Current User ID
if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
    buckys_redirect('/index.php', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

$userID = buckys_is_logged_in();

$classPublisherAd = new BuckysPublisherAds();

buckys_enqueue_stylesheet('publisher.css');

$adID = buckys_escape_query_integer($_GET['id']);

$adDetail = $classPublisherAd->getAdById($adID);

if(!$adDetail || ($adDetail['publisherID'] != $userID && buckys_check_user_acl(USER_ACL_MODERATOR))){
    buckys_redirect('/ads/publisher.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

$classAds = new BuckysAds();

$sizeDetail = $classAds->getAdSizeById($adDetail['size']);

$TNB_GLOBALS['headerType'] = "ads";
$TNB_GLOBALS['content'] = "ads/publisher_ad_view";

$TNB_GLOBALS['title'] = "View Ad Details - thenewboston Ads";

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
