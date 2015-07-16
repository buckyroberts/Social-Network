<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!($userID = buckys_is_logged_in())){
    buckys_redirect('/index.php', MSG_NOT_LOGGED_IN_USER, MSG_TYPE_ERROR);
}

$productID = buckys_escape_query_integer($_GET['id']);

$shopProductClass = new BuckysShopProduct();

if(!$shopProductClass->isPurchased($userID, $productID)){
    buckys_redirect('/shop/purchase.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

$productData = $shopProductClass->getProductById($productID);
if(!$productData || !$productData['isDownloadable']){
    buckys_redirect('/shop/purchase.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

if(!file_exists(DIR_FS_SHOP_PRODUCTS . $productData['fileName'])){
    buckys_redirect('/shop/purchase.php', MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
}

$filename = preg_replace("/[^a-zA-Z0-9\._-\s]/", '', $productData['title']);
$filename = str_replace(" ", '-', $filename);

//Download Zip File
header("Expires: Mon, 26 Nov 1962 00:00:00 GMT");
header("Last-Modified: " . gmdate("D,d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-Type: Application/zip");
header("Content-disposition: attachment; filename=" . $filename . ".zip");

$fp = fopen(DIR_FS_SHOP_PRODUCTS . $productData['fileName'], "r");
while(!feof($fp)){
    $buffer = fread($fp, 1024 * 1024 * 3);
    echo $buffer;
    ob_flush();
    flush();
}
fclose($fp);