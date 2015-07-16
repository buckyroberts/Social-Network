<?php
/***
 * Rest API Configuration File
 */

if(!defined("THENEWBOSTON_PUBLIC_API_KEY")){
    define("THENEWBOSTON_PUBLIC_API_KEY", "thenewboston-api-key-201519861216");
}

if(!defined("THENEWBOSTON_SITE_URL"))
    define("THENEWBOSTON_SITE_URL", "https://www.thenewboston.com");

function buckys_api_get_error_result($errorMessage){
    return ['STATUS' => 'ERROR', 'ERROR' => $errorMessage];
}

function buckys_api_format_date($userID, $date, $format = 'F j, Y'){
    global $TNB_GLOBALS;

    $timeOffset = 0;

    $userInfo = BuckysUser::getUserBasicInfo($userID);

    $timeOffset = $TNB_GLOBALS['timezone'][$userInfo['timezone']];

    $strDate = "";

    $now = time();
    $today = date("Y-m-d");
    $cToday = date("Y-m-d", strtotime($date));

    if($cToday == $today){
        $h = floor(($now - strtotime($date)) / 3600);
        $m = floor((($now - strtotime($date)) % 3600) / 60);
        $s = floor((($now - strtotime($date)) % 3600) % 60);
        if($s > 40)
            $m++;
        if($h > 0)
            $strDate = $h . " hour" . ($h > 1 ? "s " : " ");
        if($m > 0)
            $strDate .= $m . " minute" . ($m > 1 ? "s " : " ");

        if($strDate == ""){
            if($s == 0)
                $s = 1;
            $strDate .= $s . " second" . ($s > 1 ? "s " : " ");
        }

        $strDate .= "ago";
    }else{
        $strDate = date($format, strtotime($date) + $timeOffset * 60 * 60);
        //        $strDate = date("F j, Y h:i A", strtotime($date));
    }

    return $strDate;
}