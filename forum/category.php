<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

$categoryID = isset($_GET['id']) ? $_GET['id'] : 0;

if(isset($_REQUEST['action'])){
    if($_REQUEST['action'] == 'follow' || $_REQUEST['action'] == 'unfollow'){
        if(!($userID = buckys_is_logged_in()) && buckys_check_form_token('request')){
            buckys_redirect(isset($_REQUEST['return']) ? base64_decode($_REQUEST['return']) : '/forum', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        $category = BuckysForumCategory::getCategory($categoryID);

        if(!$category || ($_REQUEST['action'] == 'follow' && BuckysForumFollower::isFollow($category['categoryID'], $userID)) || ($_REQUEST['action'] == 'unfollow' && !BuckysForumFollower::isFollow($category['categoryID'], $userID)) || $category['creatorID'] == $userID){
            buckys_redirect(isset($_REQUEST['return']) ? base64_decode($_REQUEST['return']) : '/forum', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        if($_REQUEST['action'] == 'follow'){
            BuckysForumFollower::followForum($userID, $categoryID);
            buckys_add_message(MSG_FOLLOW_FORUM_SUCCESS);
        }else{
            BuckysForumFollower::unfollowForum($userID, $categoryID);
            buckys_add_message(MSG_UNFOLLOW_FORUM_SUCCESS);
        }
        buckys_redirect(isset($_REQUEST['return']) ? base64_decode($_REQUEST['return']) : '/forum');
    }
}

$category = BuckysForumCategory::getCategory($categoryID);
if(!$category){
    buckys_redirect('/forum');
}

//Getting Topics by category id
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : 'recent';
switch($orderby){
    case 'recent':
        $orderbyString = 'lastReplyDate DESC';
        break;
    case 'rating':
        $orderbyString = 't.votes DESC';
        break;
    case 'replies':
        $orderbyString = 't.replies DESC';
        break;
}

$total = BuckysForumTopic::getTotalNumOfTopics('publish', $category['categoryID']);

$pagination = new Pagination($total, BuckysForumTopic::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$topics = BuckysForumTopic::getTopics($page, 'publish', $category['categoryID'], $orderbyString, BuckysForumTopic::$COUNT_PER_PAGE);

$hierarchical = BuckysForumCategory::getCategoryHierarchical($category['categoryID']);

//Mark Forum Notifications to read
if(buckys_check_user_acl(USER_ACL_REGISTERED))
    BuckysForumNotification::makeNotificationsToRead($TNB_GLOBALS['user']['userID'], $category['categoryID']);

buckys_enqueue_javascript('jquery-migrate-1.2.0.js');

buckys_enqueue_stylesheet('forum.css');
buckys_enqueue_stylesheet('publisher.css');

$TNB_GLOBALS['headerType'] = 'forum';
$TNB_GLOBALS['content'] = 'forum/category';
$TNB_GLOBALS['title'] = $category['categoryName'] . ' - thenewboston Forum';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");


