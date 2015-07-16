<?php
//Include Config file
require_once(dirname(dirname(dirname(__FILE__))) . "/includes/config.php");

//Auto load classes
function __autoload($className){
    if(file_exists(DIR_FS_CLASSES . "class." . $className . ".php"))
        include DIR_FS_CLASSES . "class." . $className . ".php";
}

require_once(DIR_FS_INCLUDES . "messages.php");
require_once(DIR_FS_INCLUDES . "tables.php");

$db = new Database_Mysqli(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

require_once(DIR_FS_FUNCTIONS . "session.php");
require_once(DIR_FS_FUNCTIONS . "general.php");
require_once(DIR_FS_FUNCTIONS . "acl.php");

//Include Site Configuration File
require_once(dirname(__FILE__) . "/config.php");
require_once(dirname(__FILE__) . "/class.api.php");

if(!array_key_exists('HTTP_ORIGIN', $_SERVER)){
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

//Define User Acl Constants
BuckysUserAcl::defineAclConstants();

try{
    $buckysApi = new BuckysAPI($_REQUEST);
    $buckysApi->processAction();
}catch(Exception $e){
    echo json_encode(['error' => $e->getMessage()]);
}


