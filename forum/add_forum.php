<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/forum', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

if(isset($_POST['action']) && $_POST['action'] == 'save'){
    //Check forum token
    if(!buckys_check_form_token()){
        buckys_redirect('/forum/add_forum.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }

    $categoryID = isset($_POST['id']) ? $_POST['id'] : null;

    if($categoryID){
        $category = BuckysForumCategory::getCategory($categoryID);
        if(!$category || (!buckys_is_admin() && !buckys_is_moderator() && !buckys_is_forum_admin($category['categoryID']) && !buckys_is_forum_moderator($category['categoryID']))){
            buckys_redirect('/forum', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
        }
    }

    $categoryID = BuckysForumCategory::saveCategory($categoryID, $_POST['category-name'], $_POST['description']);

    if(!$categoryID){
        buckys_redirect('/forum');
    }

    if(isset($_POST['categoryFile']) && file_exists(DIR_FS_PHOTO_TMP . $_POST['categoryFile'])){
        //Move Category Log to the forum Log Directory
        list($width, $height, $type, $attr) = getimagesize(DIR_FS_PHOTO_TMP . $_POST['categoryFile']);
        $ratio = floatval($width / $_POST['width']);

        BuckysForumCategory::saveForumImage($categoryID, $_POST['categoryFile'], $_POST['x1'] * $ratio, $_POST['y1'] * $ratio, ($_POST['x2'] - $_POST['x1']) * $ratio);
    }

    //Save Forum Links
    BuckysForumCategory::removeAllLinks($categoryID);
    if(isset($_POST['link_title'])){
        foreach($_POST['link_title'] AS $i => $link_title){
            $link_url = $_POST['link_url'][$i];
            if(!$link_url || !$link_title){
                continue;
            }

            BuckysForumCategory::saveCategoryLink($categoryID, $link_title, $link_url);
        }
    }

    buckys_redirect("/forum/category.php?id=" . $categoryID, MSG_FORUM_SAVED, MSG_TYPE_SUCCESS);
}

$categoryID = isset($_GET['id']) ? $_GET['id'] : null;

if($categoryID != null){
    $category = BuckysForumCategory::getCategory($categoryID);
    //Check Permission
    if(!$category || (!buckys_is_admin() && !buckys_is_moderator() && !buckys_is_forum_admin($category['categoryID']) && !buckys_is_forum_moderator($category['categoryID']))){
        buckys_redirect('/forum', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
    }
}

buckys_enqueue_stylesheet('sceditor/themes/default.css');
buckys_enqueue_stylesheet('forum.css');
buckys_enqueue_stylesheet('posting.css');
buckys_enqueue_stylesheet('publisher.css');
buckys_enqueue_stylesheet('uploadify.css');
buckys_enqueue_stylesheet('jquery.Jcrop.css');

buckys_enqueue_javascript('sceditor/jquery.sceditor.bbcode.js');
buckys_enqueue_javascript('uploadify/jquery.uploadify.js');
buckys_enqueue_javascript('jquery.Jcrop.js');
buckys_enqueue_javascript('edit_forum.js');

$TNB_GLOBALS['headerType'] = 'forum';
$TNB_GLOBALS['content'] = 'forum/edit_category';

if(!$categoryID){
    $TNB_GLOBALS['title'] = 'Create a New Forum - thenewboston Forum';
}else{
    $TNB_GLOBALS['title'] = 'Edit Forum - thenewboston Forum';
}

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");








