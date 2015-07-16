<?php

require(dirname(__FILE__) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    exit();
}

if($_POST['action'] == 'activity-notification'){
    $acount = isset($_POST['acount']) ? intval($_POST['acount']) : 15;
    $rows = BuckysActivity::getActivities($userID, $acount);
    $activities = '';
    foreach($rows as $row){
        $activities .= BuckysActivity::getActivityHTML($row, $userID);
    }
    if(count($rows) == $acount){
        $activities .= "<div class='clear'></div><a href='#' class='view-more'>view more</a>";
    }

    $ncount = isset($_POST['ncount']) ? intval($_POST['ncount']) : 15;
    $rows = BuckysActivity::getNotifications($userID, $ncount);
    $notifications = '';
    foreach($rows as $row){
        $notifications .= BuckysActivity::getActivityHTML($row, $userID);
    }
    if(count($rows) == $ncount){
        $notifications .= "<div class='clear'></div><a href='#' class='view-more'>view more</a>";
    }

    render_result_xml(['notifications' => $notifications, 'activities' => $activities]);
    exit();
}