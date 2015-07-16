<?php

/**
 * Manage Tracker Table
 */
class BuckysTracker {

    //Add current track
    /**
     * @param string $action
     */
    public static function addTrack($action = 'login'){
        global $db;

        $userID = buckys_is_logged_in();
        $ip = $_SERVER['REMOTE_ADDR'];
        $time = time();

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        if($ip != '127.0.0.1'){
            $db->insertFromArray(TABLE_TRACKER, ['userID' => !$userID ? 0 : $userID, 'ipAddr' => $ip, 'trackedTime' => $time, 'action' => $action]);
        }

        return;
    }

    /**
     * @return one
     */
    public static function getLoginAttemps(){
        global $db;

        $ip = $_SERVER['REMOTE_ADDR'];

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        $time = time() - MAX_LOGIN_ATTEMPT_PERIOD;
        $query = "SELECT COUNT(1) FROM " . TABLE_TRACKER . " WHERE ipAddr='$ip' AND trackedTime > '$time'";
        $count = $db->getVar($query);

        return $count;
    }

    /**
     *
     */
    public static function clearLoginAttemps(){
        global $db;

        $ip = $_SERVER['REMOTE_ADDR'];

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        $time = time() - MAX_LOGIN_ATTEMPT_PERIOD;
        $query = "DELETE FROM " . TABLE_TRACKER . " WHERE ipAddr='$ip'";
        //$query = "DELETE FROM " . TABLE_TRACKER . " WHERE ipAddr='$ip' AND trackedTime > '$time'";

        $db->query($query);

        return;
    }
}
