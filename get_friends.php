<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

//If the user is not logged in, exit;
if(!($userID = buckys_is_logged_in())){
    echo MSG_INVALID_REQUEST;
    exit;
}

$friends = BuckysFriend::searchFriends($userID, $_REQUEST['term']);

$result = [];

foreach($friends as $row){
    $result[] = ["id" => $row['userID'], 'label' => $row['fullName'], 'value' => $row['fullName']];
}

echo json_encode($result);

exit;