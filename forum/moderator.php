<?php

require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/forum', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

//Check Category ID
$categoryID = isset($_REQUEST['id']) ? buckys_escape_query_integer($_REQUEST['id']) : 0;
if(!$categoryID || !($category = BuckysForumCategory::getCategory($categoryID))){
    buckys_redirect('/forum', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

if(isset($_REQUEST['action'])){
    if($_REQUEST['action'] == 'apply-moderate'){
        //Check forum token
        if(!buckys_check_form_token('request')){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        //Admin, Site Moderator, Category Admin and Category Moderator can't apply
        if(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']) || buckys_is_forum_moderator($category['categoryID'])){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        //Check if already applied
        if(BuckysForumModerator::isAppliedToModerate($category['categoryID'])){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_ALREADY_APPLIED_TO_MODERATE, MSG_TYPE_ERROR);
        }

        if(BuckysForumModerator::applyToModerate($category['categoryID'], $userID)){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_APPLY_TO_MODERATE_SUCCESS);
        }else{
            buckys_redirect('/forum/category.php?id=' . $categoryID, $db->getLastError(), MSG_TYPE_ERROR);
        }

    }else if($_REQUEST['action'] == 'Accept'){
        //Check forum token
        if(!buckys_check_form_token('request')){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }
        //Admin, Site Moderator, Category Admin and Category Moderator can't apply
        if(!(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']))){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
        }

        $applicants = isset($_POST['applicant']) ? $_POST['applicant'] : null;
        if(!$applicants){
            buckys_add_message(MSG_NO_APPLICANTS_SELECTED, MSG_TYPE_ERROR);
        }else{
            BuckysForumModerator::approveApplicants($categoryID, $applicants);
            buckys_redirect("/forum/moderator.php?id=" . $categoryID, MSG_APPLICANTS_APPROVED);
        }
    }else if($_REQUEST['action'] == 'Decline'){
        //Check forum token
        if(!buckys_check_form_token('request')){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }
        //Admin, Site Moderator, Category Admin and Category Moderator can't apply
        if(!(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']))){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
        }

        $applicants = isset($_POST['applicant']) ? $_POST['applicant'] : null;
        if(!$applicants){
            buckys_add_message(MSG_NO_APPLICANTS_SELECTED, MSG_TYPE_ERROR);
        }else{
            BuckysForumModerator::declineApplicants($categoryID, $applicants);
            buckys_redirect("/forum/moderator.php?id=" . $categoryID, MSG_APPLICANTS_DECLINED);
        }
    }else if($_REQUEST['action'] == 'delete-moderator'){
        //Check forum token
        if(!buckys_check_form_token('request')){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }
        //Admin, Site Moderator, Category Admin and Category Moderator can't apply
        if(!(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']))){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
        }

        $moderator = buckys_escape_query_integer($_REQUEST['moderator']);
        if($category['creatorID'] == $moderator){
            buckys_redirect('/forum/moderator.php?id=' . $categoryID, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
        }

        BuckysForumModerator::deleteModerator($categoryID, $moderator);
        buckys_redirect("/forum/moderator.php?id=" . $categoryID, MSG_MODERATOR_REMOVED);
    }else if($_REQUEST['action'] == 'Delete'){
        //Check forum token
        if(!buckys_check_form_token('request')){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        //Admin, Site Moderator, Category Admin and Category Moderator can't apply
        if(!(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']) || buckys_is_forum_moderator($category['categoryID']))){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
        }
        BuckysReport::deleteObjects($_REQUEST['reportID']);
        buckys_redirect("/forum/moderator.php?id=" . $categoryID, MSG_REPORTED_OBJECT_REMOVED);
    }else if($_REQUEST['action'] == 'Approve'){
        //Check forum token
        if(!buckys_check_form_token('request')){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        //Admin, Site Moderator, Category Admin and Category Moderator can't apply
        if(!(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']) || buckys_is_forum_moderator($category['categoryID']))){
            buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
        }
        BuckysReport::approveObjects($_REQUEST['reportID']);
        buckys_redirect("/forum/moderator.php?id=" . $categoryID, MSG_REPORTED_OBJECT_APPROVED);
    }else if($_REQUEST['action'] == 'block-user'){
        $return = isset($_REQUEST['return']) ? base64_decode($_REQUEST['return']) : ('/forum/category.php?id=' . $categoryID);
        //Check forum token
        if(!buckys_check_form_token('request')){
            buckys_redirect($return, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        //Admin, Site Moderator, Category Admin and Category Moderator can't be blocked
        if(!(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']) || buckys_is_forum_moderator($category['categoryID']))){
            buckys_redirect($return, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
        }

        $blockedUserID = buckys_escape_query_integer($_REQUEST['userID']);

        if($blockedUserID == $userID){
            buckys_redirect($return, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        BuckysForumModerator::blockUser($blockedUserID, $category['categoryID']);

        buckys_redirect($return, MSG_BLOCK_USER_SUCCESS);
    }else if($_REQUEST['action'] == 'unblock-users'){
        $return = isset($_REQUEST['return']) ? base64_decode($_REQUEST['return']) : ('/forum/moderator.php?id=' . $categoryID);
        //Check forum token
        if(!buckys_check_form_token('request')){
            buckys_redirect($return, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        //Admin, Site Moderator, Category Admin and Category Moderator can't apply
        if(!(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']) || buckys_is_forum_moderator($category['categoryID']))){
            buckys_redirect($return, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
        }

        $blockedUsers = isset($_REQUEST['blocked_user']) ? $_REQUEST['blocked_user'] : null;

        if(!$blockedUsers){
            buckys_redirect($return, MSG_NO_USER_SELECTED, MSG_TYPE_ERROR);
        }

        foreach($blockedUsers as $bUser){
            BuckysForumModerator::unBlockUser($bUser, $category['categoryID']);
        }

        buckys_redirect($return, MSG_UNBLOCK_USER_SUCCESS);
    }else if($_REQUEST['action'] == 'delete-forum'){
        $return = isset($_REQUEST['return']) ? base64_decode($_REQUEST['return']) : ('/forum/moderator.php?id=' . $categoryID);
        //Check forum token
        if(!buckys_check_form_token('request')){
            buckys_redirect($return, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        //Admin, Site Moderator, Category Admin and Category Moderator can't apply
        if(!(buckys_is_admin() || buckys_is_forum_admin($category['categoryID']))){
            buckys_redirect($return, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
        }

        //Check Password
        $userData = BuckysUser::getUserData($userID);
        if(!buckys_validate_password($_REQUEST['pwd'], $userData['password'])){
            buckys_redirect($return, MSG_CURRENT_PASSWORD_NOT_CORRECT, MSG_TYPE_ERROR);
        }

        BuckysForumCategory::deleteCategory($category['categoryID']);
        buckys_redirect("/forum", MSG_REMOVE_FORUM_SUCCESS);
    }
}

//Admin, Site Moderator, Category Admin and Category Moderator can't apply
if(!(buckys_is_admin() || buckys_is_moderator() || buckys_is_forum_admin($category['categoryID']) || buckys_is_forum_moderator($category['categoryID']))){
    buckys_redirect('/forum/category.php?id=' . $categoryID, MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

//Getting Reported Posts
$reported_posts = BuckysForumModerator::getReportedArticles($categoryID);

//Getting Applicants
$applicants = BuckysForumModerator::getApplicants($categoryID);

$blockedUsers = BuckysForumModerator::getBlockedUsers($categoryID);

buckys_enqueue_stylesheet('sceditor/themes/default.css');
buckys_enqueue_stylesheet('forum.css');

$TNB_GLOBALS['headerType'] = 'forum';
$TNB_GLOBALS['content'] = 'forum/moderator';

$TNB_GLOBALS['title'] = $category['categoryName'] . ' Moderator Panel - thenewboston Forum';

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");








