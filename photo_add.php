<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

if(isset($_POST['action']) && $_POST['action'] == 'create-photo'){
    //Add Photo
    if($newID = BuckysPost::savePhoto($userID, $_POST)){
        buckys_redirect('/photo_edit.php?photoID=' . $newID);
    }else{
        buckys_redirect('/photo_add.php');
    }

}

//Getting UserData from Id
$userData = BuckysUser::getUserData($userID);

//Getting User Albums
$albums = BuckysAlbum::getAlbumsByUserId($userID);

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('posting.css');
buckys_enqueue_stylesheet('uploadify.css');
buckys_enqueue_stylesheet('jquery.Jcrop.css');

buckys_enqueue_javascript('uploadify/jquery.uploadify.js');
buckys_enqueue_javascript('jquery.Jcrop.js');
buckys_enqueue_javascript('jquery.color.js');
buckys_enqueue_javascript('add_photo.js');

$TNB_GLOBALS['content'] = 'photo_add';

$TNB_GLOBALS['title'] = "Add Photo - " . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
