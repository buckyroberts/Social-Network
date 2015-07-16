<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
    die(MSG_PERMISSION_DENIED);
}

//Process Post Actions
if(isset($_POST['action'])){
    $action = $_POST['action'];
    //Approve Topics
    if($action == 'approve-topic'){

    }
}
