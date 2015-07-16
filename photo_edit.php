<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

//Getting UserData from Id
$userData = BuckysUser::getUserData($userID);

//If Photo ID is empty, goto photo management page
if(!isset($_REQUEST['photoID']))
    buckys_redirect('/photo_manage.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);

$photoId = $_REQUEST['photoID'];
$photo = BuckysPost::getPostById($photoId);

//Getting User Albums
$albums = BuckysAlbum::getAlbumsByUserId($userID);

//Getting Photo Albums
$photoAlbums = BuckysAlbum::getAlbumsByPostId($photoId);

if(!$photoAlbums)
    $photoAlbums = [];

//If photo id is not correct or the owner is not the current user, goto photo management page
if(!$photo || $photo['poster'] != $userID)
    buckys_redirect('/photo_manage.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);

if(isset($_POST['action'])){
    //Create New Album
    if($_POST['action'] == 'save-photo'){
        if($photo['poster'] != $userID){
            buckys_redirect('/photo_manage.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        //Update Photo Caption and Privacy
        BuckysPost::updatePhoto($userID, $_POST);

        //Change user profile image
        if($_POST['photo_visibility'] == 2){
            if(!$photo['is_profile']){
                BuckysPost::createProfileImage($photo, $_POST);
            }
            //Update profile image with old one                
            BuckysUser::updateUserFields($userID, ['thumbnail' => $photo['image']]);

        }else if($userData['thumbnail'] == $photo['image']){ //If it was a profile image and now it is not, remove it from the profile image
            BuckysUser::updateUserFields($userID, ['thumbnail' => '']);
        }

        //Save Album
        if(isset($_POST['album']) && $_POST['album'] != '' && isset($albums[$_POST['album']])){
            BuckysAlbum::addPhotoToAlbum($_POST['album'], $photo['postID']);
        }
        buckys_redirect('/photo_edit.php?photoID=' . $photo['postID'], MSG_PHOTO_UPDATED, MSG_TYPE_SUCCESS);
        exit;
    }
}

$set_profile = isset($_GET['set_profile']) ? $_GET['set_profile'] : null;

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('posting.css');
buckys_enqueue_stylesheet('jquery.Jcrop.css');

buckys_enqueue_javascript('jquery.Jcrop.js');
buckys_enqueue_javascript('jquery.color.js');
buckys_enqueue_javascript('edit_photo.js');

$TNB_GLOBALS['content'] = 'photo_edit';

$TNB_GLOBALS['title'] = "Edit Photo - " . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
