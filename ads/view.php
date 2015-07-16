<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

//Getting Current User ID
if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
    buckys_redirect('/index.php', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

$userID = buckys_is_logged_in();

$classAds = new BuckysAds();

//Add Funds
if(isset($_POST['action']) && $_POST['action'] == 'add-funds'){

    if(!buckys_check_form_token()){
        buckys_redirect('/ads/advertiser.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }

    $adID = buckys_escape_query_integer($_POST['id']);

    $adDetail = $classAds->getAdById($adID);

    if(!$adDetail || ($adDetail['ownerID'] != $userID && buckys_check_user_acl(USER_ACL_MODERATOR))){
        buckys_redirect('/ads/advertiser.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }

    $result = $classAds->addFunds($userID, $adID, $_POST['amount']);

    buckys_add_message($classAds->last_message, $result ? MSG_TYPE_SUCCESS : MSG_TYPE_ERROR);
}

buckys_enqueue_stylesheet('publisher.css');

$adID = buckys_escape_query_integer($_GET['id']);

$adDetail = $classAds->getAdById($adID);

if(!$adDetail || ($adDetail['ownerID'] != $userID && buckys_check_user_acl(USER_ACL_MODERATOR))){
    buckys_redirect('/ads/advertiser.php');
}

$TNB_GLOBALS['headerType'] = "ads";
$TNB_GLOBALS['content'] = "ads/view";

buckys_enqueue_javascript('jquery.number.js');

$TNB_GLOBALS['title'] = "View Ad - thenewboston Ads";

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
