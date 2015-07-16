<?php

require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

if(isset($_POST['action']) && $_POST['action'] == 'create'){
    //Check Token
    if(!buckys_check_form_token()){
        buckys_redirect("/page_add.php", MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }

    if(!$_POST['pageName']){
        buckys_redirect("/page_add.php", MSG_PAGE_NAME_EMPTY, MSG_TYPE_ERROR);
    }

    if(!$_POST['file']){
        buckys_redirect("/page_add.php", MSG_PAGE_LOGO_EMPTY, MSG_TYPE_ERROR);
    }

    if(!isset($_POST['file']) || strpos($_POST['file'], "../") !== false || !file_exists(DIR_FS_PHOTO_TMP . $_POST['file'])){
        buckys_redirect("/page_add.php", MSG_FILE_UPLOAD_ERROR, MSG_TYPE_ERROR);
    }

    $fileParts = pathinfo($_POST['file']);
    if(!in_array(strtolower($fileParts['extension']), $TNB_GLOBALS['imageTypes'])){
        buckys_redirect("/page_add.php", MSG_INVALID_PHOTO_TYPE, MSG_TYPE_ERROR);
        return false;
    }

    $pageClass = new BuckysPage();
    if(($pageID = $pageClass->addPage($userID, $_POST))){
        buckys_add_message(MSG_PAGE_CREATED_SUCCESSFULLY, MSG_TYPE_SUCCESS);
        buckys_redirect("/page.php?pid=" . $pageID);
    }else{
        buckys_redirect("/page_add.php");
    }

}

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('uploadify.css');
buckys_enqueue_stylesheet('jquery.Jcrop.css');
buckys_enqueue_stylesheet('posting.css');
buckys_enqueue_stylesheet('page.css');

buckys_enqueue_javascript('uploadify/jquery.uploadify.js');
buckys_enqueue_javascript('jquery.Jcrop.js');
buckys_enqueue_javascript('jquery.color.js');

buckys_enqueue_javascript('add_page.js');

$TNB_GLOBALS['content'] = 'page_add';

$TNB_GLOBALS['title'] = "Create a New Page - " . TNB_SITE_NAME;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");