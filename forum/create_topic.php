<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/register.php');
}

if(isset($_POST['action'])){
    if($_POST['action'] == 'create-topic'){
        $result = BuckysForumTopic::createTopic($_POST);
        if(!$result){
            buckys_redirect("/forum/create_topic.php", $result, MSG_TYPE_ERROR);

        }else{
            $return = isset($_POST['return']) ? base64_decode($_POST['return']) : "/forum/topic.php?id=" . $result;
            buckys_redirect($return);
        }
    }
}
$curCatID = isset($_GET['category']) ? $_GET['category'] : 0;

if(!$curCatID || !($category = BuckysForumCategory::getCategory($curCatID))){
    buckys_redirect("/forum", MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

if(BuckysForumModerator::isBlocked($userID, $category['categoryID'])){
    buckys_redirect("/forum/category.php?id=" . $category['categoryID'], MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

$categories = BuckysForumCategory::getAllCategories();

buckys_enqueue_stylesheet('sceditor/themes/default.css');
buckys_enqueue_stylesheet('forum.css');
buckys_enqueue_stylesheet('publisher.css');
buckys_enqueue_stylesheet('uploadify.css');

buckys_enqueue_javascript('sceditor/jquery.sceditor.bbcode.js');
buckys_enqueue_javascript('uploadify/jquery.uploadify.js');

$view['action_type'] = 'create';

$TNB_GLOBALS['headerType'] = 'forum';
$TNB_GLOBALS['content'] = 'forum/create_topic';
$TNB_GLOBALS['title'] = 'Start a New Topic - thenewboston Forum';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");

