<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//Getting Current User ID
if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
    buckys_redirect('/index.php', MSG_PERMISSION_DENIED, MSG_TYPE_ERROR);
}

if(isset($_POST['action']) && $_POST['action'] == 'get-users'){
    $users = BuckysUser::searchUsers($_REQUEST['term'], $userID);
    $result = [];

    foreach($users as $row){
        $result[] = ["id" => $row['userID'], 'label' => $row['fullName'], 'value' => $row['fullName'], 'hash' => buckys_encrypt_id($row['userID'])];
    }

    echo json_encode($result);
    buckys_exit();

}

if(isset($_POST['action']) && $_POST['action'] == 'send-money'){
    if(!isset($_POST['receiverID']) || !isset($_POST['receiverIDHash']) || !isset($_POST['amount']) || !buckys_check_id_encrypted($_POST['receiverID'], $_POST['receiverIDHash'])){
        buckys_redirect('/credits.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }
    $result = BuckysTransaction::sendCredits($_POST['receiverID'], $_POST['amount']);

    if($result === true){
        buckys_redirect('/credits.php', MSG_SENT_CREDITS_SUCCESSFULLY);
    }else{
        buckys_redirect('/credits.php', $result, MSG_TYPE_ERROR);
    }
    exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$totalCount = BuckysTransaction::getNumOfCreditActivities($userID);

//Init Pagination Class
$pagination = new Pagination($totalCount, BuckysTransaction::$COUNT_PER_PAGE, $page);
$page = $pagination->getCurrentPage();

$activities = BuckysTransaction::getCreditActivities($TNB_GLOBALS['user']['userID'], $page);

buckys_enqueue_stylesheet('account.css');
buckys_enqueue_stylesheet('credits.css');

buckys_enqueue_javascript('credits.js');
buckys_enqueue_javascript('payment.js');

$TNB_GLOBALS['content'] = 'credits';

$TNB_GLOBALS['title'] = "Credits - " . TNB_SITE_NAME;
$TNB_GLOBALS['payerID'] = $userID;

require(DIR_FS_TEMPLATE . $TNB_GLOBALS['template'] . "/" . $TNB_GLOBALS['layout'] . ".php");
