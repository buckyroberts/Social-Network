<?php
require(dirname(dirname(dirname(__FILE__))) . '/includes/bootstrap.php');

/**
 * Remove trade section temp image directory clean up.
 * It will remove all files which has past 1 day after uploading
 * TODO: You should call this file once per day
 */

$tempFileList = scandir(DIR_FS_SHOP_IMG_TMP);

if(count($tempFileList) > 0){
    foreach($tempFileList as $fileName){
        if($fileName == '.' || $fileName == '..'){
            continue;
        }

        if(file_exists(DIR_FS_SHOP_IMG_TMP . $fileName)){
            if(time() - filemtime(DIR_FS_SHOP_IMG_TMP . $fileName) > 1 * 24 * 3600){
                @unlink(DIR_FS_SHOP_IMG_TMP . $fileName);
            }
        }

    }
}

exit;