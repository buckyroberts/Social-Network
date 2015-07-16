<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!buckys_check_user_acl(USER_ACL_ADMINISTRATOR) && !BuckysModerator::isModerator($TNB_GLOBALS['user']['userID'])){
    buckys_redirect('/forum', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

//Process Post Actions
if(isset($_POST['action'])){
    $action = $_POST['action'];
    //Approve Topics
    if($action == 'approve-topic'){
        //Getting Ids
        $topicIds = isset($_POST['tid']) ? $_POST['tid'] : null;
        if(!$topicIds)
            buckys_redirect('/forum/pending_topcis.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);

        $result = BuckysForumTopic::approvePendingTopics($topicIds);
        if($result === true)
            buckys_redirect('/forum/pending_topics.php', MSG_TOPIC_APPROVED_SUCCESSFULLY);else
            buckys_redirect('/forum/pending_topics.php', $result, MSG_TYPE_ERROR);
    }else if($action == 'delete-topic'){ // Delete Pending Topics
        //Getting Ids
        $topicIds = isset($_POST['tid']) ? $_POST['tid'] : null;
        if(!$topicIds)
            buckys_redirect('/forum/pending_topcis.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);

        $result = BuckysForumTopic::deletePendingTopics($topicIds);
        if($result === true)
            buckys_redirect('/forum/pending_topics.php', MSG_TOPIC_REMOVED_SUCCESSFULLY);else
            buckys_redirect('/forum/pending_topics.php', $result, MSG_TYPE_ERROR);
    }

}

//Getting Pending Topics
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$total = BuckysForumTopic::getTotalNumOfTopics('pending');

$pagination = new Pagination($total, BuckysForumTopic::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$topics = BuckysForumTopic::getTopics($page, 'pending', null, null, BuckysForumTopic::$COUNT_PER_PAGE);

buckys_enqueue_javascript('jquery-migrate-1.2.0.js');

buckys_enqueue_stylesheet('forum.css');
buckys_enqueue_stylesheet('publisher.css');

$TNB_GLOBALS['headerType'] = 'forum';
$TNB_GLOBALS['content'] = 'forum/pending_topics';
$TNB_GLOBALS['title'] = 'Pending Topics - thenewboston Forum';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");

