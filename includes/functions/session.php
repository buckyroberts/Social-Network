<?php
/**
 * Register Custom Session Handler
 */

function _buckys_session_open($save_path, $sessionName){
    return true;
}

/**
 * @return bool
 */
function _buckys_session_close(){
    return true;
}

/**
 * @param $key
 * @return bool
 */
function _buckys_session_read($key){

    $db = new Database_Mysqli(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

    $query = $db->prepare("SELECT value FROM " . TABLE_SESSIONS . " WHERE sessionID = %s AND expiry > '" . time() . "'", $key);
    $value = $db->getRow($query);

    if(isset($value['value'])){
        return $value['value'];
    }

    return false;
}

/**
 * @param $key
 * @param $value
 * @return bool
 */
function _buckys_session_write($key, $value){

    $db = new Database_Mysqli(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

    $expiry = time() + SESSION_LIFETIME;

    $query = $db->prepare("SELECT count(*) AS total FROM " . TABLE_SESSIONS . " WHERE sessionID=%s", $key);
    $row = $db->getRow($query);

    $userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : 0;

    if($row['total'] > 0){
        //Remove old sessions that has the user id
        if($userID)
            $db->query("DELETE FROM " . TABLE_SESSIONS . " WHERE userID=" . $userID . " AND sessionID !='" . $key . "'");
        return $db->query("UPDATE " . TABLE_SESSIONS . " SET `value`='" . $value . "', `userID`='" . $userID . "', `expiry`='" . $expiry . "' WHERE sessionID='" . $key . "'");
    }else{
        return $db->query("INSERT INTO " . TABLE_SESSIONS . "(`sessionID`, `value`, `userID`, `expiry`)VALUES('" . $key . "', '" . $value . "', '" . $userID . "', '" . $expiry . "')");
    }
}

/**
 * @param $key
 * @return bool
 */
function _buckys_session_destory($key){

    $db = new Database_Mysqli(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

    $query = $db->prepare('DELETE FROM ' . TABLE_SESSIONS . ' WHERE sessionID=%s', $key);

    return $db->query($query);
}

/**
 * @param $maxlifetime
 * @return bool
 */
function _buckys_session_gc($maxlifetime){

    $db = new Database_Mysqli(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

    $db->query("DELETE FROM " . TABLE_SESSIONS . " WHERE expiry < '" . time() . "'");

    return true;
}

//Session Start Function
/**
 * @return bool
 */
function buckys_session_start(){

    $session_id = '';

    session_set_cookie_params(0, "/", BUCKYSROOM_DOMAIN, true, true);

    //Set Session Handler
    session_set_save_handler('_buckys_session_open', '_buckys_session_close', '_buckys_session_read', '_buckys_session_write', '_buckys_session_destory', '_buckys_session_gc');

    //Change the default session name 
    buckys_session_name(SESSION_NAME);

    if(isset($_COOKIE[SESSION_NAME])){
        if(preg_match('/^[a-zA-Z0-9]+$/', $_COOKIE[SESSION_NAME]) == false){
            $session_data = session_get_cookie_params();
            setcookie(SESSION_NAME, '', time() - 42000, $session_data['path'], $session_data['domain']);
        }else{
            $session_id = $_COOKIE[SESSION_NAME];
        }
    }

    // if a session ID has been passed to the site, use it
    if(buckys_not_null($session_id)){
        buckys_session_id($session_id);
    }

    //Session Start
    $session_start_state = session_start();

    if(buckys_not_null($session_id)){
        if(!isset($_SESSION['session_start_time'])){
            // If not present, do not use the current session ID
            buckys_session_recreate();
        }
    }

    // If this is a new session, place our server variable in place
    if(!isset($_SESSION['session_start_time'])){
        $_SESSION['session_start_time'] = time();
    }else{
        // if the session has been expired, recreate the session
        $curr_time = time();
        if($curr_time - $_SESSION['session_start_time'] > SESSION_LIFETIME){
            buckys_session_recreate();
            $_SESSION['session_start_time'] = time();
        }
    }

    return $session_start_state;
}

//Get or Set Current Session ID
/**
 * @param string $sessid
 * @return string
 */
function buckys_session_id($sessid = ''){
    if(!empty($sessid)){
        return session_id($sessid);
    }else{
        return session_id();
    }
}

//Get Or Set Current Session Name
/**
 * @param string $name
 * @return string
 */
function buckys_session_name($name = ''){
    if(!empty($name)){
        return session_name($name);
    }else{
        return session_name();
    }
}

//Write Session Data and Close
/**
 *
 */
function buckys_session_close(){
    session_write_close();
}

//Destory all data registered to a session
/**
 * @return bool
 */
function buckys_session_destroy(){
    $_SESSION = [];
    return session_destroy();
}

//Get or Set current session save path
/**
 * @param string $path
 * @return string
 */
function buckys_session_save_path($path = ''){
    if(!empty($path)){
        return session_save_path($path);
    }else{
        return session_save_path();
    }
}

//Recreate Session 
/**
 *
 */
function buckys_session_recreate(){
    session_regenerate_id(true);
    session_set_save_handler('_buckys_session_open', '_buckys_session_close', '_buckys_session_read', '_buckys_session_write', '_buckys_session_destory', '_buckys_session_gc');
}