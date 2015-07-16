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

$files = array();

//Read Directory
$dp = opendir(dirname(__FILE__));
while(($fp = readdir($dp)) !== false)
{
    if($fp != "." && $fp != ".." && $fp != "index.php")
    {
        $files[] = $fp;        
    }
}
?>
<!doctype html>
<html>
<head>
    <title>Private Scripts</title>
</head>
<body>

<?php foreach($files as $f): ?>
<p><a href="<?php echo $f?>"><?php echo $f?></a></p>
<?php endforeach; ?>

</body>
</html>
