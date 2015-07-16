<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(buckys_is_logged_in()){
    require(dirname(__FILE__) . "/home.php");
}else{
    require(dirname(__FILE__) . "/recent_activity.php");
}
