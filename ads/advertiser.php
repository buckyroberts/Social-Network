<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

//Getting Current User ID
if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
    buckys_redirect('/register.php');
}

$classAds = new BuckysAds();

$userID = buckys_is_logged_in();

$page = isset($_GET['page']) ? buckys_escape_query_integer($_GET['page']) : 1;
$status = isset($_GET['status']) ? buckys_escape_query_string($_GET['status']) : 'active';

$activeAdsCount = $classAds->getUserAdsCount($userID, 'active');
$pendingAdsCount = $classAds->getUserAdsCount($userID, 'pending');
$expiredAdsCount = $classAds->getUserAdsCount($userID, 'expired');

switch($status){
    case 'active':
        $totalCount = $activeAdsCount;
        break;
    case 'pending':
        $totalCount = $pendingAdsCount;
        break;
    case 'expired':
        $totalCount = $expiredAdsCount;
        break;

}

$pagination = new Pagination($totalCount, BuckysAds::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$userAds = $classAds->getUserAds($userID, $status, $page, BuckysAds::$COUNT_PER_PAGE);

buckys_enqueue_stylesheet('publisher.css');

$TNB_GLOBALS['headerType'] = "ads";
$TNB_GLOBALS['content'] = "ads/advertiser";

$TNB_GLOBALS['title'] = "Advertiser Account - thenewboston Ads";

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
