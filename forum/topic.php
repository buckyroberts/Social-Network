<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(isset($_POST['action'])){
    if($_POST['action'] == 'thumb-up' || $_POST['action'] == 'thumb-down'){
        if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
            $data = ['status' => 'error', 'message' => MSG_PLEASE_LOGIN_TO_CAST_VOTE];
        }else{
            if(!$_POST['objectID'] || !$_POST['objectIDHash'] || !$_POST['objectType'] || !buckys_check_id_encrypted($_POST['objectID'], $_POST['objectIDHash'])){
                $data = ['status' => 'error', 'message' => MSG_INVALID_REQUEST];
            }else{
                if($_POST['objectType'] == 'topic')
                    $result = BuckysForumTopic::voteTopic($TNB_GLOBALS['user']['userID'], $_POST['objectID'], $_POST['action'] == 'thumb-up' ? 1 : -1);else
                    $result = BuckysForumReply::voteReply($TNB_GLOBALS['user']['userID'], $_POST['objectID'], $_POST['action'] == 'thumb-up' ? 1 : -1);
                if(is_int($result)){
                    $data = ['status' => 'success', 'message' => MSG_THANKS_YOUR_VOTE, 'votes' => ($result > 0 ? "+" : "") . $result];
                }else{
                    $data = ['status' => 'error', 'message' => $result];
                }
            }
        }
        render_result_xml($data);
        exit;
    }
}else if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    //Delete this topic

    $userID = buckys_is_logged_in();

    $topicID = isset($_GET['id']) ? get_secure_integer($_GET['id']) : null;

    if(isset($topicID)){
        $forumTopicIns = new BuckysForumTopic();
        $forumData = $forumTopicIns->getTopic($topicID);

        if(isset($forumData) && $forumData['creatorID'] == $userID){
            //then you can delete this one.
            $forumTopicIns->deleteTopic($topicID);

            buckys_redirect('/forum', MSG_TOPIC_REMOVED_SUCCESSFULLY, MSG_TYPE_SUCCESS);

        }else{
            //You don't have permission
            buckys_redirect('/forum/topic.php?id=' . $topicID, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);

        }

    }

}else if(isset($_GET['action']) && $_GET['action'] == 'move-topic'){

    //Delete this topic
    if(!buckys_check_user_acl(USER_ACL_MODERATOR)){
        buckys_redirect('/forum', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
    }
    $userID = buckys_is_logged_in();

    $topicID = isset($_GET['id']) ? buckys_escape_query_integer($_GET['id']) : null;

    $catID = isset($_GET['category']) ? buckys_escape_query_integer($_GET['category']) : null;

    if(!$topicID){
        buckys_redirect('/forum', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }

    if(!$catID || !($category = BuckysForumCategory::getCategory($catID))){
        buckys_redirect('/forum/topic.php?id=' . $topicID, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }

    $forumTopicIns = new BuckysForumTopic();
    $forumTopicIns->moveTopic($topicID, $catID);

    buckys_redirect('/forum/topic.php?id=' . $topicID, MSG_TOPIC_MOVED_SUCCESSFULLY);
}

$topicID = isset($_GET['id']) ? buckys_escape_query_integer($_GET['id']) : 0;

$topic = BuckysForumTopic::getTopic($topicID);

if(!$topic)
    buckys_redirect('/forum');

$category = BuckysForumCategory::getCategory($topic['categoryID']);

//If the topic is not published(pending or suspended), only forum moderator and administrator can see this
if($topic['status'] != 'publish' && !buckys_is_moderator() && $TNB_GLOBALS['user']['userID'] != $topic['creatorID'])
    buckys_redirect('/forum');

$orderBy = isset($_GET['orderby']) ? buckys_escape_query_string($_GET['orderby']) : 'oldest';

//Getting Replies
$page = isset($_GET['page']) ? buckys_escape_query_integer($_GET['page']) : 1;
$total = BuckysForumReply::getTotalNumOfReplies($topic['topicID'], 'publish');

$pagination = new Pagination($total, BuckysForumReply::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$replies = BuckysForumReply::getReplies($topic['topicID'], 'publish', $page, $orderBy);

$hierarchical = BuckysForumCategory::getCategoryHierarchical($topic['categoryID']);

//Mark Forum Notifications to read
if(buckys_check_user_acl(USER_ACL_REGISTERED))
    BuckysForumNotification::makeNotificationsToRead($TNB_GLOBALS['user']['userID'], null, $topic['topicID']);

if(buckys_check_user_acl(USER_ACL_MODERATOR)){
    $reportID = BuckysReport::isReported($topicID, 'topic');
    $categories = BuckysForumCategory::getAllCategories();
}

buckys_enqueue_javascript('sceditor/jquery.sceditor.bbcode.js');
buckys_enqueue_javascript('uploadify/jquery.uploadify.js');

buckys_enqueue_javascript('highlight.pack.js');
buckys_enqueue_javascript('forum.js');

buckys_enqueue_stylesheet('sceditor/themes/default.css');
buckys_enqueue_stylesheet('obsidian.css');
buckys_enqueue_stylesheet('forum.css');
buckys_enqueue_stylesheet('publisher.css');
buckys_enqueue_stylesheet('uploadify.css');

$TNB_GLOBALS['headerType'] = 'forum';
$TNB_GLOBALS['content'] = 'forum/topic';
$TNB_GLOBALS['title'] = $topic['topicTitle'] . ' - thenewboston Forum';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");

