<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

//Getting Activity Stream
$stream = BuckysPost::getUserPostsStream($userID);

//Get Activities
$activities = BuckysActivity::getActivities($userID);
if(!$activities)
    $activities = [];

//Get Notifications
$notifications = BuckysActivity::getNotifications($userID);

//Mark the notifications to read
BuckysActivity::markReadNotifications($userID);

if(!$notifications)
    $notifications = [];

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('stream.css');
buckys_enqueue_stylesheet('posting.css');
buckys_enqueue_stylesheet('uploadify.css');
buckys_enqueue_stylesheet('jquery.Jcrop.css');

buckys_enqueue_javascript('uploadify/jquery.uploadify.js');
buckys_enqueue_javascript('jquery.Jcrop.js');
buckys_enqueue_javascript('jquery.color.js');

buckys_enqueue_javascript('posts.js');
buckys_enqueue_javascript('add_post.js');
buckys_enqueue_javascript('account.js');

//Set Content
$TNB_GLOBALS['content'] = 'account';

//Page Title
$TNB_GLOBALS['title'] = 'My Account - ' . TNB_SITE_NAME;
require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
