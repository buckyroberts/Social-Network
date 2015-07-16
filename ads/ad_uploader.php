<?php
/**
 * Upload Photo Using Jquery uploadify plugin
 */
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

if(!empty($_FILES)){
    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetPath = DIR_FS_TMP; // temp files
    if(!is_dir($targetPath)){
        mkdir($targetPath, 0777);
        //Create Index.html to prevent directory listing issue
        $fp = fopen($targetPath . "/index.html", "w");
        fclose($fp);
    }

    // Validate the file type
    $fileParts = pathinfo($_FILES['Filedata']['name']);

    //Check the file extension
    if(in_array(strtolower($fileParts['extension']), $TNB_GLOBALS['imageTypes'])){

        //Check Image Size
        list($width, $height, $type, $attr) = getimagesize($tempFile);
        //Check Size
        $adClass = new BuckysAds();
        $size = $adClass->getAdSizeById($_REQUEST['size']);

        $offset = abs($width - $size['width']) + abs($height - $size['height']);
        if($offset > 4){
            echo json_encode(['success' => 0, 'msg' => MSG_INVALID_PHOTO_SIZE]);
            exit;
        }

        if(!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_JPEG2000, IMAGETYPE_PNG])){
            echo json_encode(['success' => 0, 'msg' => MSG_INVALID_PHOTO_TYPE]);
            exit;
        }

        if($width > MAX_IMAGE_WIDTH || $height > MAX_IMAGE_HEIGHT){
            echo json_encode(['success' => 0, 'msg' => MSG_PHOTO_MAX_SIZE_ERROR]);
        }else{
            $targetFileName = md5(session_id() . 'ad') . "." . $fileParts['extension'];
            $targetFile = $targetPath . $targetFileName;

            move_uploaded_file($tempFile, $targetFile);

            echo json_encode(['success' => 1, 'file' => $targetFileName]);
        }

    }else{
        echo json_encode(['success' => 0, 'msg' => MSG_INVALID_PHOTO_TYPE]);
    }
}