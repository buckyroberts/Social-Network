<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

//Getting Current User ID
if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
    buckys_redirect('/index.php', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

$userID = buckys_is_logged_in();

$classPublisherAd = new BuckysPublisherAds();

if(isset($_POST['action']) && $_POST['action'] == 'create-publisher-ad'){
    if(!buckys_check_form_token()){
        buckys_redirect('/ads/create_publisher_ad.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }else{
        $_POST['adType'] = TNB_AD_TYPE_CUSTOM;
        if($classPublisherAd->savePublisherAd($userID, $_POST)){

            buckys_redirect('/ads/publisher.php', $classPublisherAd->last_message);
        }else{
            buckys_redirect('/ads/create_publisher_ad.php', $classPublisherAd->last_message, MSG_TYPE_ERROR);
        }
    }
}

$classAds = new BuckysAds();
$adSizes = $classAds->getAdSizes();

buckys_enqueue_javascript('colorpicker.js');
buckys_enqueue_javascript('create_publisher_ads.js');

buckys_enqueue_stylesheet('colorpicker.css');
buckys_enqueue_stylesheet('publisher.css');

$TNB_GLOBALS['headerType'] = "ads";
$TNB_GLOBALS['content'] = "ads/create_publisher_ad";

$TNB_GLOBALS['title'] = "Create Publisher Ad - thenewboston Ads";

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
