<?php
require(dirname(__FILE__) . '/includes/bootstrap.php');

$reportTypes = [];
foreach($TNB_GLOBALS['reportObjectTypes'] as $arr)
    $reportTypes = array_merge($arr, $reportTypes);

if(!($userID = buckys_is_logged_in())){
    echo MSG_INVALID_REQUEST;
    exit;
}

$type = isset($_REQUEST['type']) ? strtolower($_REQUEST['type']) : null;

if(!in_array($type, $reportTypes)){
    echo MSG_INVALID_REQUEST;
    exit;
}

if(isset($_POST['action'])){
    if($_POST['action'] == 'report'){
        if(!isset($_POST['id']) || !isset($_POST['idHash']) || !buckys_check_id_encrypted($_POST['id'], $_POST['idHash'])){
            $data = ['status' => 'error', 'message' => MSG_INVALID_REQUEST];
        }else{
            $result = BuckysReport::reportObject($userID, $_POST['id'], $type);
            if($result === true)
                $data = ['status' => 'success', 'message' => MSG_THANKS_YOUR_REPORT];else
                $data = ['status' => 'error', 'message' => $result];
        }
        render_result_xml($data);
        exit;
    }
}

