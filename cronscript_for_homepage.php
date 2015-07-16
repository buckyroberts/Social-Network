<?php

require(dirname(__FILE__) . '/includes/bootstrap.php');

$periods = ['today', 'this-week', 'this-month', 'all'];
$types = ['image', 'text', 'video'];
$counts = ['image' => 12, 'text' => 10, 'video' => 8];
$base_values = ['image' => 1.01, 'text' => 1.01, 'video' => 1.01];

foreach($types as $type){
    $result = [];
    foreach($periods as $period){

        $tResult = BuckysPost::getTopPostsForHomepage($period, $type, $base_values[$type], 1, $counts[$type] - count($result));

        $result = array_merge($result, $tResult);
        if(count($result) >= $counts[$type])
            break;
    }
    //Delete Old Data From DB
    $db->query("DELETE FROM " . TABLE_STATS_POST . " WHERE postType='" . $type . "'");
    //Insert New Data To DB
    foreach($result as $idx => $row){
        $db->insertFromArray(TABLE_STATS_POST, ['postID' => $row['postID'], 'postType' => $type, 'sortOrder' => $idx + 1, 'createdDate' => date('Y-m-d H:i:s')]);
    }

}