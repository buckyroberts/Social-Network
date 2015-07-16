<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

//Getting UserData from Id
$userData = BuckysUser::getUserData($userID);

if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
    if($action == 'set-profile-photo'){
        BuckysUser::updateUserProfilePhoto($userID, $_REQUEST['photoID']);
        buckys_redirect('/photo_manage.php');
    }else if($action == 'delete-photo'){

        if(!BuckysPost::deletePost($userID, $_REQUEST['photoID']))
            buckys_redirect('/photo_manage.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);else
            buckys_redirect('/photo_manage.php', MSG_PHOTO_REMOVED, MSG_TYPE_SUCCESS);
    }else if($action == 'remove-profile-photo'){
        BuckysUser::updateUserFields($userID, ['thumbnail' => '']);
        buckys_redirect('/photo_manage.php');
    }
}

//Getting Album ID
$albumID = isset($_REQUEST['albumID']) ? $_REQUEST['albumID'] : null;

//Getting Current Page
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$totalCount = BuckysPost::getNumberOfPhotosByUserID($userID, BuckysPost::INDEPENDENT_POST_PAGE_ID, $albumID);

$pagination = new Pagination($totalCount, BuckysPost::$IMAGES_PER_PAGE_FOR_MANAGE_PHOTOS_PAGE, $page);
$page = $pagination->getCurrentPage();

$photos = BuckysPost::getPhotosByUserID($userID, $userID, BuckysPost::INDEPENDENT_POST_PAGE_ID, true, null, $albumID, BuckysPost::$IMAGES_PER_PAGE_FOR_MANAGE_PHOTOS_PAGE);

$albums = BuckysAlbum::getAlbumsByUserId($userID);

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('posting.css');
buckys_enqueue_stylesheet('info.css');

$TNB_GLOBALS['content'] = 'photo_manage';

$TNB_GLOBALS['title'] = "Manage Photos - " . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
