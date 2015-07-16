<?php
/**
 * Add/Delete Comments
 */

require(dirname(__FILE__) . '/includes/bootstrap.php');

$userID = buckys_is_logged_in();

if(isset($_POST['action'])){

    //Save Comment
    if($_POST['action'] == 'save-comment'){
        if(!buckys_check_form_token('request')){
            echo MSG_INVALID_REQUEST;
            exit;
        }

        if(!$userID){
            echo MSG_INVALID_REQUEST;
            exit;
        }
        $postID = $_POST['postID'];
        $comment = $_POST['comment'];

        $image = isset($_POST['file']) ? $_POST['file'] : null;

        //If comment is empty, show error
        if(trim($comment) == '' && !$image){
            echo MSG_COMMENT_EMPTY;
            exit;
        }
        //if Post Id was not set, show error
        if(!$postID){
            echo MSG_INVALID_REQUEST;
            exit;
        }

        //Check the post id is correct
        if(!BuckysPost::checkPostID($postID)){
            echo MSG_POST_NOT_EXIST;
            exit;
        }

        $post = BuckysPost::getPostById($postID);
        if($post['visibility'] == 0 && $userID != $post['poster'] && !BuckysFriend::isFriend($userID, $post['poster'])){
            //Only Friends can leave comments to private post
            echo MSG_INVALID_REQUEST;
            exit;
        }

        if(!BuckysUsersDailyActivity::checkUserDailyLimit($userID, "comments")){
            echo sprintf(MSG_DAILY_COMMENTS_LIMIT_EXCEED_ERROR, USER_DAILY_LIMIT_COMMENTS);
            exit;
        }

        //If error, show it
        if(!($commentID = BuckysComment::saveComments($userID, $postID, $comment, $image))){
            echo $db->getLastError();
            exit;
        }else{
            //Show Results
            header('Content-type: application/xml');

            $newComment = BuckysComment::getComment($commentID);
            $newCount = BuckysComment::getPostCommentsCount($postID);

            render_result_xml(['newcomment' => render_single_comment($newComment, $userID, true), 'count' => $newCount > 1 ? ($newCount . " comments") : ($newCount . " comment")]);
            exit;
        }
    }

    //Getting More Comments
    if($_POST['action'] == 'get-comments'){
        $postID = $_POST['postID'];
        $lastDate = $_POST['last'];
        $comments = BuckysComment::getPostComments($postID, $lastDate);
        //Show Results
        header('Content-type: application/xml');
        $commentsHTML = '';
        foreach($comments as $comment){
            $commentsHTML .= render_single_comment($comment, $userID, true);
            $lastDate = $comment['posted_date'];
        }
        $result = ['comment' => $commentsHTML];

        render_result_xml(['comment' => $commentsHTML, 'lastdate' => $lastDate, 'hasmore' => ($commentsHTML != '' && BuckysComment::hasMoreComments($postID, $lastDate)) ? 'yes' : 'no']);
    }
}else if($_GET['action']){
    //Delete Post
    if($_GET['action'] == 'delete-comment'){
        if(!$userID){
            echo MSG_INVALID_REQUEST;
            exit;
        }
        $postID = $_GET['postID'];
        $commentID = $_GET['commentID'];
        $cUserID = $_GET['userID'];

        if(!buckys_check_form_token('request') || !BuckysComment::deleteComment($userID, $commentID)){
            echo 'Invalid Request';
        }else{
            header('content-type: application/xml');
            $newCount = BuckysComment::getPostCommentsCount($postID);

            render_result_xml(['commentcount' => $newCount > 1 ? ($newCount . " comments") : ($newCount . " comment")]);
        }
        exit;
    }
}