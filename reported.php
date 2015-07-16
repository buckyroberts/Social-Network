<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
if(!buckys_check_user_acl(USER_ACL_MODERATOR)){
    buckys_redirect('/index.php', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

if(isset($_REQUEST['action'])){
    if($_REQUEST['action'] == 'delete-objects'){
        BuckysReport::deleteObjects($_REQUEST['reportID']);
        buckys_add_message(MSG_REPORTED_OBJECT_REMOVED);
    }else if($_REQUEST['action'] == 'approve-objects'){
        BuckysReport::approveObjects($_REQUEST['reportID']);
        buckys_add_message(MSG_REPORTED_OBJECT_APPROVED);
    }else if($_REQUEST['action'] == 'ban-users'){
        $return = BuckysReport::banUsers($_REQUEST['reportID']);
        if($return > 0)
            buckys_add_message(MSG_BAN_USERS);
    }
    buckys_redirect('/reported.php');
    exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$totalCount = BuckysReport::getReportedObjectCount();

//Init Pagination Class
$pagination = new Pagination($totalCount, BuckysReport::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$objects = BuckysReport::getReportedObject($page, BuckysReport::$COUNT_PER_PAGE);

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('moderator.css');

buckys_enqueue_javascript('reported.js');

$TNB_GLOBALS['content'] = 'reported';

//Reported Object Type Label
$reportLabel = ['post' => ['Post', 'Posts'], 'comment' => ['Comment', 'Comments'], 'message' => ['Message', 'Messages'], 'topic' => ['Topic', 'Topics'], 'reply' => ['Reply', 'Replies']];

$TNB_GLOBALS['title'] = "Moderator Panel";

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
