<?php

require(dirname(__FILE__) . '/includes/bootstrap.php');

if(!buckys_check_form_token('get')){
    header("HTTP/1.0 404 Not Found");
    exit;
}

$adKey = $_GET['key'];
$url = base64_decode($_GET['url']);

//Increase clicks
$query = $db->prepare("UPDATE " . TABLE_ADS . " SET `clicks`=`clicks` + 1 WHERE `adKey`=%s", $adKey);
$db->query($query);

header("Location: " . $url);