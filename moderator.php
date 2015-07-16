<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
    buckys_redirect('/register.php');
}

//Choose Moderator
if(isset($_GET['action'])){
    if($_GET['action'] == 'delete-candidate'){
        if(!buckys_check_id_encrypted($_GET['id'], $_GET['idHash'])){
            buckys_redirect('/moderator.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        BuckysModerator::deleteCandidate($userID, $_GET['id']);
        buckys_redirect('/moderator.php');
    }

    if($_GET['action'] == 'delete-moderator'){
        //Confirm that the user is administrator
        if(!buckys_check_user_acl(USER_ACL_ADMINISTRATOR)){
            buckys_redirect('/moderator.php', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
        }

        if(!buckys_check_id_encrypted($_GET['id'], $_GET['idHash'])){
            buckys_redirect('/moderator.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        BuckysModerator::deleteModerator($_GET['id']);
        buckys_redirect('/moderator.php');
    }
    if($_GET['action'] == 'reset-voting'){
        //Confirm that the user is administrator
        if(!buckys_check_user_acl(USER_ACL_ADMINISTRATOR)){
            buckys_redirect('/moderator.php', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
        }

        BuckysModerator::resetVotes();
        buckys_redirect('/moderator.php');
    }

}

//Process Actions
if(isset($_POST['action'])){
    if($_POST['action'] == 'apply_candidate'){
        if(isset($_POST['candidate_id'])){
            BuckysModerator::updateCandidate($_POST['candidate_id'], $userID, $_POST['moderator_text']);
            buckys_redirect('/moderator.php', MSG_UPDATE_CANDIDATE_SUCCESSFULLY);
        }else{
            $newID = BuckysModerator::applyCandidate($userID, $_POST['moderator_text']);
            buckys_redirect('/moderator.php', MSG_APPLY_JOB_SUCCESSFULLY);
        }

    }
    if($_POST['action'] == 'thumb-up' || $_POST['action'] == 'thumb-down'){
        if(!$_POST['candidateID'] || !$_POST['candidateIDHash'] || !buckys_check_id_encrypted($_POST['candidateID'], $_POST['candidateIDHash'])){
            $data = ['status' => 'error', 'message' => MSG_INVALID_REQUEST];
        }else{
            $result = BuckysModerator::voteCandidate($userID, $_POST['candidateID'], $_POST['action'] == 'thumb-up' ? true : false);
            if(is_int($result)){
                $data = ['status' => 'success', 'message' => MSG_THANKS_YOUR_VOTE, 'votes' => ($result > 0 ? "+" : "") . $result];
            }else{
                $data = ['status' => 'error', 'message' => $result];
            }
        }

        render_result_xml($data);
        exit;
    }
    if($_POST['action'] == 'add-moderator'){
        //Confirm that the user is administrator
        if(!buckys_check_user_acl(USER_ACL_ADMINISTRATOR)){
            buckys_redirect('/moderator.php', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
        }

        //Check the url parameters is correct 
        if(!isset($_POST['new_moderator_id'])){
            buckys_redirect('/moderator.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
        }

        BuckysModerator::addModerator($_POST['new_moderator_id']);
        buckys_redirect('/moderator.php');
    }
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$totalCount = BuckysModerator::getCandidatesCount();

//Getting Current Moderator
$currentModerators = BuckysModerator::getModerators();

//Init Pagination Class
$pagination = new Pagination($totalCount, BuckysModerator::$CANDIDATES_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$candidates = BuckysModerator::getCandidates($page);

//Getting My Candidate
$myCandidate = BuckysModerator::getCandidate($userID);

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('moderator.css');

buckys_enqueue_javascript('moderator.js');

$TNB_GLOBALS['content'] = 'moderator';

$TNB_GLOBALS['title'] = "Moderator - " . TNB_SITE_NAME;

//if logged user can see all resources of the current user

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
