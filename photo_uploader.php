<?php
/**
 * Upload Photo Using Jquery uploadify plugin
 */
require(dirname(__FILE__) . '/includes/bootstrap.php');

if(!empty($_FILES)){
    $tempFile = $_FILES['Filedata']['tmp_name'];
    if(isset($_POST['type']) && $_POST['type'] == 'forum')
        $targetPath = DIR_FS_ROOT . "images/forum";else
        $targetPath = DIR_FS_PHOTO . "tmp";
    if(!is_dir($targetPath)){
        mkdir($targetPath, 0777);
        //Create Index file
        $fp = fopen($targetPath . "/index.html", "w");
        fclose($fp);
    }

    // Validate the file type
    $fileParts = pathinfo($_FILES['Filedata']['name']);

    //Check the file extension
    if(in_array(strtolower($fileParts['extension']), $TNB_GLOBALS['imageTypes'])){

        //Check Image Size
        list($width, $height, $type, $attr) = getimagesize($tempFile);
        //Check Image Type
        if(!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_JPEG2000, IMAGETYPE_PNG])){
            echo json_encode(['success' => 0, 'msg' => MSG_INVALID_PHOTO_TYPE]);
            exit;
        }
        if($width > MAX_IMAGE_WIDTH || $height > MAX_IMAGE_HEIGHT){
            echo json_encode(['success' => 0, 'msg' => MSG_PHOTO_MAX_SIZE_ERROR]);
        }else{
            $targetFileName = md5(uniqid()) . "." . $fileParts['extension'];
            $targetFile = $targetPath . '/' . $targetFileName;

            move_uploaded_file($tempFile, $targetFile);

            if(isset($_POST['type']) && $_POST['type'] == 'forum')
                echo json_encode(['success' => 1, 'file' => DIR_WS_IMAGE . "forum/" . $targetFileName]);else
                echo json_encode(['success' => 1, 'file' => $targetFileName]);
        }

    }else{
        echo json_encode(['success' => 0, 'msg' => MSG_INVALID_PHOTO_TYPE]);
    }
}