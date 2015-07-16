<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
if(!buckys_check_user_acl(USER_ACL_MODERATOR)){
    buckys_redirect('/index.php', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

$classAds = new BuckysAds();

if(isset($_REQUEST['action'])){
    if(!buckys_check_form_token()){
        buckys_redirect('/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }
    if($_REQUEST['action'] == 'reject-ads'){
        $classAds->rejectAds($_REQUEST['adID']);
        buckys_redirect('/manage_ads.php', MSG_AD_ADS_REJECTED);
    }else if($_REQUEST['action'] == 'approve-ads'){
        $classAds->approveAds($_REQUEST['adID']);
        buckys_redirect('/manage_ads.php', MSG_AD_ADS_APPROVED);
    }
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$totalCount = $classAds->getPendingAdsCount();

//Init Pagination Class
$pagination = new Pagination($totalCount, BuckysAds::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$objects = $classAds->getPendingAds($page, BuckysAds::$COUNT_PER_PAGE);

buckys_enqueue_javascript('manage_ads.js');

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('moderator.css');
buckys_enqueue_stylesheet('publisher.css');

$TNB_GLOBALS['content'] = 'manage_ads';

$TNB_GLOBALS['title'] = "Moderator Panel";

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
