<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!buckys_check_user_acl(USER_ACL_ADMINISTRATOR) && !BuckysModerator::isModerator($TNB_GLOBALS['user']['userID'])){
    buckys_redirect('/forum', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

//Process Post Actions
if(isset($_POST['action'])){
    $action = $_POST['action'];
    //Approve Topics
    if($action == 'approve-reply'){
        //Getting Ids
        $replyIds = isset($_POST['rid']) ? $_POST['rid'] : null;
        if(!$replyIds)
            buckys_redirect('/forum/pending_topcis.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);

        $result = BuckysForumReply::approvePendingReplies($replyIds);
        if($result === true)
            buckys_redirect('/forum/pending_replies.php', MSG_REPLY_APPROVED_SUCCESSFULLY);else
            buckys_redirect('/forum/pending_replies.php', $result, MSG_TYPE_ERROR);
    }else if($action == 'delete-reply'){ // Delete Pending Topics
        //Getting Ids
        $replyIds = isset($_POST['rid']) ? $_POST['rid'] : null;
        if(!$replyIds)
            buckys_redirect('/forum/pending_topcis.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);

        $result = BuckysForumReply::deletePendingReplies($replyIds);
        if($result === true)
            buckys_redirect('/forum/pending_replies.php', MSG_REPLY_REMOVED_SUCCESSFULLY);else
            buckys_redirect('/forum/pending_replies.php', $result, MSG_TYPE_ERROR);
    }

}

//Getting Pending Topics
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$total = BuckysForumReply::getTotalNumOfReplies(null, 'pending');

$pagination = new Pagination($total, BuckysForumTopic::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$replies = BuckysForumReply::getReplies(null, 'pending', $page);

buckys_enqueue_stylesheet('sceditor/themes/default.css');
buckys_enqueue_stylesheet('forum.css');
buckys_enqueue_stylesheet('publisher.css');

$TNB_GLOBALS['headerType'] = 'forum';
$TNB_GLOBALS['content'] = 'forum/pending_replies';
$TNB_GLOBALS['title'] = 'Pending Replies - thenewboston Forum';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");

