<?php
/**
 * Display Temp Images that u
 */
require(dirname(__FILE__) . '/includes/bootstrap.php');

if(!buckys_check_user_acl(USER_ACL_REGISTERED)){
    header("HTTP/1.0 404 Not Found");
    exit;
}

$img = $_GET['image'];

if(!$img || !file_exists(DIR_FS_TMP . $img)){
    header("HTTP/1.0 404 Not Found");
    exit;
}

//Getting File Type
$info = getimagesize(DIR_FS_TMP . $img);

if($info){
    header("Content-type: " . $info['mime']);
    readfile(DIR_FS_TMP . $img);
}else{
    header("HTTP/1.0 404 Not Found");
    exit;
}