<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

$albumID = isset($_REQUEST['albumID']) ? $_REQUEST['albumID'] : '';

if(!$albumID || !BuckysAlbum::checkAlbumOwner($albumID, $userID)){
    buckys_redirect("/photo_albums.php", MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

//Getting UserData from Id
$userData = BuckysUser::getUserData($profileID);

//Getting Album
$album = BuckysAlbum::getAlbum($albumID);

//Getting Photos
$myphotos = BuckysPost::getPhotosByUserID($userID, $userID, BuckysPost::INDEPENDENT_POST_PAGE_ID, true);

$albumPhotos = BuckysAlbum::getPhotos($albumID);

//Getting Album Photos

if(isset($_POST['action'])){
    //Create New Album
    if($_POST['action'] == 'save-album'){
        //If the album title is empty, throw error
        //If the album title is empty, throw error
        if(trim($_POST['album_name']) == ''){
            buckys_redirect('/photo_album_edit.php?albumID=' . $_POST['albumID'], MSG_ALBUM_TITLE_EMPTY, MSG_TYPE_ERROR);
        }
        BuckysAlbum::updateAlbum($_POST['albumID'], trim($_POST['album_name']), $_POST['visibility'], $_POST['photos']);
        buckys_redirect("/photo_album_edit.php?albumID=" . $_POST['albumID'], MSG_ALBUM_UPDATED);
    }else if($_POST['action'] == 'remove-from-album' || $_POST['action'] == 'add-to-album'){
        $photoID = $_POST['photoID'];
        $photo = BuckysPost::getPostById($photoID);

        //Check Photo Owner
        if($photo['poster'] != $userID){
            echo MSG_INVALID_REQUEST;
            exit;
        }
        if($_POST['action'] == 'remove-from-album')
            BuckysAlbum::removePhotoFromAlbum($albumID, $photoID); //Remove
        else
            BuckysAlbum::addPhotoToAlbum($albumID, $photoID); //Add
        echo 'success';
        exit;
    }
}

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('posting.css');

buckys_enqueue_javascript('album.js');

$TNB_GLOBALS['content'] = 'photo_album_edit';

$TNB_GLOBALS['title'] = "Edit Photo Album - " . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
