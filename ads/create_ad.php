<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

//Getting Current User ID
if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
    buckys_redirect('/index.php', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

$userID = buckys_is_logged_in();

$adClass = new BuckysAds();

if(isset($_POST['action']) && $_POST['action'] == 'create-ad'){
    if(!buckys_check_form_token()){
        buckys_redirect('/ads/create_ad.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }else{
        if($adClass->saveAd($userID, $_POST)){
            buckys_redirect('/ads/advertiser.php?status=pending', $adClass->last_message);
        }else{
            buckys_redirect('/ads/create_ad.php?type=' . $_POST['type'], $adClass->last_message, MSG_TYPE_ERROR);
        }
    }
}

$adSizes = $adClass->getAdSizes();

$adType = isset($_GET['type']) && $_GET['type'] == 'Image' ? 'Image' : 'Text';

buckys_enqueue_stylesheet('publisher.css');
buckys_enqueue_stylesheet('uploadify.css');

buckys_enqueue_javascript('uploadify/jquery.uploadify.js');
buckys_enqueue_javascript('jquery.number.js');
buckys_enqueue_javascript('create_ad.js');

$TNB_GLOBALS['headerType'] = "ads";
$TNB_GLOBALS['content'] = "ads/create_ad";

$TNB_GLOBALS['title'] = "Create New Ad - thenewboston Ads";

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
