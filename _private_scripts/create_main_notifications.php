<?php

require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if( !($userID = buckys_is_logged_in()) )
{
    echo "Permission Denied!";
    buckys_exit();
}

if( !buckys_is_admin() )
{
    echo "Permission Denied!";
    buckys_exit();
}

//Read Rows From Main Activities
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$limit = 200;

$query = "SELECT a.*, p.poster FROM " . TABLE_MAIN_ACTIVITIES . " AS a 
          LEFT JOIN " . TABLE_POSTS . " AS p ON a.objectID=p.postID
          WHERE `objectType` = 'post' AND p.poster is not null ORDER BY activityID LIMIT " . ($page - 1) * $limit . ", $limit";
          
$rows = $db->getResultsArray($query);

if(!$rows)
{
    //Delete Forum Activities from Main Activities    
    echo "Completed";
    die();
}

foreach($rows as $row)
{   
    switch($row['activityType'])
    {
        case 'comment':            
            if($row['poster'] != $row['userID'])
                $db->insertFromArray(TABLE_MAIN_NOTIFICATIONS, array('userID' => $row['poster'], 
                                                                 'activityID' => $row['activityID'], 
                                                                 'notificationType' => BuckysActivity::NOTIFICATION_TYPE_COMMENT_TO_POST, 
                                                                 'isNew' => $row['isNew'], 
                                                                 'createdDate' => strtotime($row['createdDate'])));
            break;
        case 'like':
            $db->insertFromArray(TABLE_MAIN_NOTIFICATIONS, array('userID' => $row['poster'], 
                                                                 'activityID' => $row['activityID'], 
                                                                 'notificationType' => BuckysActivity::NOTIFICATION_TYPE_LIKE_POST, 
                                                                 'isNew' => $row['isNew'], 
                                                                 'createdDate' => strtotime($row['createdDate'])));            
            break;        
    }
}
?>
<script type="text/javascript">
    document.location.href = 'create_main_notifications.php?page=<?php echo $page + 1?>';
</script>



