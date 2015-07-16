<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
if(!buckys_check_user_acl(USER_ACL_ADMINISTRATOR)){
    buckys_redirect('/index.php', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

if(isset($_REQUEST['action'])){
    if($_REQUEST['action'] == 'unban'){

        BuckysBanUser::unbanUsers($_REQUEST['bannedID']);
        buckys_redirect('/banned_users.php', MSG_UNBAN_USERS);
    }else if($_REQUEST['action'] == 'delete'){
        BuckysBanUser::deleteUsers($_REQUEST['bannedID']);
        buckys_redirect('/banned_users.php', MSG_DELETE_USERS);
    }else if($_REQUEST['action'] == 'deletebyid'){

        if(!isset($_REQUEST['userID']) || !BuckysUser::checkUserID($_REQUEST['userID'], false)){
            buckys_redirect('/index.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        BuckysUser::deleteUserAccount($_REQUEST['userID']);
        buckys_redirect('/index.php', MSG_DELETE_USERS);
    }
    exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$totalCount = BuckysBanUser::getBannedUsersCount();

//Init Pagination Class
$pagination = new Pagination($totalCount, BuckysBanUser::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$users = BuckysBanUser::getBannedUsers($page, BuckysBanUser::$COUNT_PER_PAGE);

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('moderator.css');

buckys_enqueue_javascript('banned_users.js');

$TNB_GLOBALS['content'] = 'banned_users';
$TNB_GLOBALS['title'] = "Manage Banned Users - " . TNB_SITE_NAME;
require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
