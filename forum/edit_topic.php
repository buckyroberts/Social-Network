<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
    buckys_redirect('/forum', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

//======= Check if permission allowed ===========//
$permissionAllowed = false;
$forumTopicIns = new BuckysForumTopic();
$userID = buckys_is_logged_in();

$topicID = isset($_REQUEST['id']) ? get_secure_integer($_REQUEST['id']) : null;
if(isset($topicID)){
    $forumData = $forumTopicIns->getTopic($topicID);

    if(isset($forumData) && $forumData['creatorID'] == $userID){
        $permissionAllowed = true;
    }
}

if($permissionAllowed == false){
    buckys_redirect("/forum/topic.php?id=" . $topicID, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

if(isset($_POST['action'])){
    if($_POST['action'] == 'edit-topic'){

        $result = $forumTopicIns->editTopic($_POST);
        if($result === true){
            buckys_redirect("/forum/topic.php?id=" . $topicID, MSG_TOPIC_POSTED_SUCCESSFULLY, MSG_TYPE_SUCCESS);
        }else{
            buckys_redirect("/forum/edit_topic.php?id=" . $topicID, $result, MSG_TYPE_ERROR);
        }
    }
}

$categoryID = $forumData['categoryID'];
$category = BuckysForumCategory::getCategory($categoryID);

$categories = BuckysForumCategory::getAllCategories();

buckys_enqueue_stylesheet('sceditor/themes/default.css');
buckys_enqueue_stylesheet('forum.css');
buckys_enqueue_stylesheet('publisher.css');
buckys_enqueue_stylesheet('uploadify.css');

buckys_enqueue_javascript('sceditor/jquery.sceditor.bbcode.js');
buckys_enqueue_javascript('uploadify/jquery.uploadify.js');

$view['action_type'] = 'edit';
$view['forum_data'] = $forumData;

$TNB_GLOBALS['headerType'] = 'forum';
$TNB_GLOBALS['content'] = 'forum/create_topic';
$TNB_GLOBALS['title'] = 'Edit Topic - thenewboston Forum';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");

