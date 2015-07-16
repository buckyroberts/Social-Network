<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

//Getting Current User ID
if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
    buckys_redirect('/register.php');
}

$classPublisherAds = new BuckysPublisherAds();

//Fix Ads
if(buckys_check_user_acl(USER_ACL_ADMINISTRATOR) && isset($_GET['fix_users_ads'])){
    $users = $db->getResultsArray("SELECT * FROM " . TABLE_USERS . " WHERE `status` != '0'");
    foreach($users as $urow){
        $classPublisherAds->createDefaultPublisherAds($urow['userID']);
    }
    die("completed!");
}

if(isset($_GET['action']) && $_GET['action'] == 'delete-ad'){
    if(!buckys_check_form_token('get')){
        buckys_redirect('/ads/publisher.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }

    //Getting Publisher Ad
    $adDetail = $classPublisherAds->getAdById($_GET['id']);

    if(!$adDetail){
        buckys_redirect('/ads/publisher.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }else if($adDetail['publisherID'] != $userID || $adDetail['adType'] == TNB_AD_TYPE_FORUM || $adDetail['adType'] == TNB_AD_TYPE_FORUM){
        buckys_redirect('/ads/publisher.php', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
    }else{
        $classPublisherAds->deleteAd($adDetail['id']);
        buckys_redirect('/ads/publisher.php', MSG_AD_PUBLISHER_AD_REMOVED);
    }
}

$userID = buckys_is_logged_in();

$page = isset($_GET['page']) ? buckys_escape_query_integer($_GET['page']) : 1;
$status = isset($_GET['status']) ? buckys_escape_query_string($_GET['status']) : 'active';

$activeAdsCount = $classPublisherAds->getPublisherAdsCount($userID, 'active');
$deletedAdsCount = $classPublisherAds->getPublisherAdsCount($userID, 'deleted');

switch($status){
    case 'active':
        $totalCount = $activeAdsCount;
        break;
    case 'deleted':
        $totalCount = $deletedAdsCount;
        break;
}

$pagination = new Pagination($totalCount, BuckysAds::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$userAds = $classPublisherAds->getPublisherAds($userID, $status, $page, BuckysPublisherAds::$COUNT_PER_PAGE);

$userBalance = $classPublisherAds->getUserBalance($userID);

buckys_enqueue_stylesheet('publisher.css');

$TNB_GLOBALS['headerType'] = "ads";
$TNB_GLOBALS['content'] = "ads/publisher";

$TNB_GLOBALS['title'] = "Publisher Panel - thenewboston Ads";

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
