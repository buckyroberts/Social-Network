<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

//Getting UserData from Id
$userData = BuckysUser::getUserData($profileID);

//Getting Albums
$albums = BuckysAlbum::getAlbumsByUserId($userID);

if(isset($_POST['action'])){

    //Create New Album
    if($_POST['action'] == 'create-album'){

        //If the album title is empty, throw error
        if(trim($_POST['new_album_name']) == ''){
            buckys_redirect('/photo_albums.php', MSG_ALBUM_TITLE_EMPTY, MSG_TYPE_ERROR);
        }
        $newId = BuckysAlbum::createAlbum($userID, trim($_POST['new_album_name']), $_POST['visibility']);
        buckys_redirect('/photo_albums.php');
    }else if($_POST['action'] == 'delete-album'){
        if(BuckysAlbum::deleteAlbum($_POST['albumID'], $userID)){
            echo 'success';
        }else{
            echo 'error';
        }
        exit;
    }
}

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('posting.css');
buckys_enqueue_javascript('album.js');

$TNB_GLOBALS['content'] = 'photo_albums';
$TNB_GLOBALS['title'] = "Photo Albums - " . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");