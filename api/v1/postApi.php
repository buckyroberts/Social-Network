<?php

class BuckysPostApi {

    public function createAction(){
        global $TNB_GLOBALS;
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }
        $data['type'] = $data['post_type'];

        if($data['type'] == 'image'){
            //Upload photo if it is image type
            $tempFile = $_FILES['image']['tmp_name'];

            $targetPath = DIR_FS_PHOTO . "tmp";

            if(!is_dir($targetPath)){
                mkdir($targetPath, 0777);
                //Create Index file
                $fp = fopen($targetPath . "/index.html", "w");
                fclose($fp);
            }

            // Validate the file type
            $fileParts = pathinfo($_FILES['image']['name']);

            //Check the file extension
            if(in_array(strtolower($fileParts['extension']), $TNB_GLOBALS['imageTypes'])){

                //Check Image Size
                list($width, $height, $type, $attr) = getimagesize($tempFile);
                //Check Image Type
                if(!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_JPEG2000, IMAGETYPE_PNG])){
                    return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_PHOTO_TYPE)];
                }
                if($width * $height > MAX_IMAGE_WIDTH * MAX_IMAGE_HEIGHT){
                    return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_PHOTO_MAX_SIZE_ERROR)];
                }else{
                    $targetFileName = md5(uniqid()) . "." . $fileParts['extension'];
                    $targetFile = $targetPath . '/' . $targetFileName;

                    move_uploaded_file($tempFile, $targetFile);

                    $data['file'] = $targetFileName;
                }

            }else{
                return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_PHOTO_TYPE)];
            }
        }

        if(BuckysPost::savePost($userID, $data)){ //Success
            $message = buckys_get_pure_messages();

            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS', 'MESSAGE' => $message]];
        }else{
            $error = buckys_get_pure_messages();

            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result($error)];
        }
    }

    public function changeProfileImageAction(){
        global $TNB_GLOBALS;
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }
        //Upload photo if it is image type
        $tempFile = $_FILES['image']['tmp_name'];

        $targetPath = DIR_FS_PHOTO . "tmp";

        if(!is_dir($targetPath)){
            mkdir($targetPath, 0777);
            //Create Index file
            $fp = fopen($targetPath . "/index.html", "w");
            fclose($fp);
        }

        // Validate the file type
        $fileParts = pathinfo($_FILES['image']['name']);

        //Check the file extension
        if(in_array(strtolower($fileParts['extension']), $TNB_GLOBALS['imageTypes'])){

            //Check Image Size
            list($width, $height, $type, $attr) = getimagesize($tempFile);
            //Check Image Type
            if(!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_JPEG2000, IMAGETYPE_PNG])){
                return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_PHOTO_TYPE)];
            }
            if($width * $height > MAX_IMAGE_WIDTH * MAX_IMAGE_HEIGHT){
                return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_PHOTO_MAX_SIZE_ERROR)];
            }else{
                $targetFileName = md5(uniqid()) . "." . $fileParts['extension'];
                $targetFile = $targetPath . '/' . $targetFileName;

                move_uploaded_file($tempFile, $targetFile);

                $data['file'] = $targetFileName;
            }

        }else{
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_PHOTO_TYPE)];
        }

        if(BuckysUser::updateUserProfileThumbnail($userID, $data['file'])){ //Success
            $message = buckys_get_pure_messages();

            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS', 'MESSAGE' => $message]];
        }else{
            $error = buckys_get_pure_messages();

            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result($error)];
        }
    }

    public function likePostAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $postID = isset($data['postID']) ? $data['postID'] : null;
        $actionType = isset($data['actionType']) ? $data['actionType'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        if(!$postID || !$actionType){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
        }

        $post = BuckysPost::getPostById($postID);

        if(!$post || $post['post_status'] != 1){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
            exit;
        }

        $r = BuckysPost::likePost($userID, $postID, $actionType, false);
        $message = buckys_get_pure_messages();

        if(!$r){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result($message)];
            exit;
        }else{
            $likes = BuckysPost::getPostLikesCount($postID);
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS', 'MESSAGE' => $message, 'LIKES' => $likes, 'isLiked' => $actionType == 'likePost' ? 'yes' : 'no']];
        }

    }

}