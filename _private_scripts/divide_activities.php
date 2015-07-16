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

$query = "SELECT * FROM " . TABLE_MAIN_ACTIVITIES . " WHERE `objectType` = 'forum' ORDER BY activityID LIMIT " . ($page - 1) * $limit . ", $limit";
$rows = $db->getResultsArray($query);

if(!$rows)
{
    //Delete Forum Activities from Main Activities
    $db->query("DELETE FROM " . TABLE_MAIN_ACTIVITIES . " WHERE `objectType` = 'forum'");
    echo "Completed";
    die();
}

foreach($rows as $row)
{    
    $row['activityID'] = null;
    unset($row['activityID']);
    
    $db->insertFromArray(TABLE_FORUM_ACTIVITIES, $row);
}
?>
<script type="text/javascript">
    document.location.href = 'divide_activities.php?page=<?php echo $page + 1?>';
</script>



