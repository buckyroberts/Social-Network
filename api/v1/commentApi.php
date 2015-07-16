<?php

class BuckysCommentApi {

    public function getListAction(){
        global $TNB_GLOBALS;
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $postID = isset($data['postID']) ? trim($data['postID']) : null;

        if(!$token || !$postID){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $comments = BuckysComment::getPostAllComments($postID);

        $results = [];

        foreach($comments as $row){
            $item = [];

            $item['commentId'] = $row['commentID'];
            $item['postId'] = $row['postID'];

            $item['commenterId'] = $row['commenter'];
            $item['commenterName'] = $row['fullName'];
            $item['commenterThumbnail'] = THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($row['commenter']);

            $item['commentedDate'] = buckys_api_format_date($userID, $row['posted_date']);
            $item['commentContent'] = !$row['content'] ? "" : $row['content'];
            $item['commentImage'] = !$row['image'] ? "" : (THENEWBOSTON_SITE_URL . DIR_WS_PHOTO . 'users/' . $row['commenter'] . '/original/' . $row['image']);

            $results[] = $item;
        }

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "RESULT" => $results]];
    }

    public function createAction(){
        global $TNB_GLOBALS;

        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $postID = isset($data['postID']) ? trim($data['postID']) : null;

        $image = null;

        if(!$token || !$postID){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        //First Upload File
        if(isset($_FILES['image'])){
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

                    $image = $targetFileName;
                }
            }else{
                return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_PHOTO_TYPE)];
            }
        }

        $comment = $data['comment'];
        if(trim($comment) == '' && !$image){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_COMMENT_EMPTY)];
        }
        //if Post Id was not set, show error
        if(!$postID){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
        }

        //Check the post id is correct
        if(!BuckysPost::checkPostID($postID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_POST_NOT_EXIST)];
        }

        $post = BuckysPost::getPostById($postID);
        if($post['visibility'] == 0 && $userID != $post['poster'] && !BuckysFriend::isFriend($userID, $post['poster'])){
            //Only Friends can leave comments to private post
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
        }

        if(!($commentID = BuckysComment::saveComments($userID, $postID, $comment, $image))){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result($db->getLastError())];
        }else{
            $newComment = BuckysComment::getComment($commentID);

            $newCount = BuckysComment::getPostCommentsCount($postID);

            $commentArray = [];
            $commentArray['commentId'] = $newComment['commentID'];
            $commentArray['postId'] = $newComment['postID'];

            $commentArray['commenterId'] = $newComment['commenter'];
            $commentArray['commenterName'] = $newComment['fullName'];
            $commentArray['commenterThumbnail'] = THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($newComment['commenter']);

            $commentArray['commentedDate'] = buckys_api_format_date($userID, $newComment['posted_date']);
            $commentArray['commentContent'] = !$newComment['content'] ? "" : $newComment['content'];
            $commentArray['commentImage'] = !$newComment['image'] ? "" : (THENEWBOSTON_SITE_URL . DIR_WS_PHOTO . 'users/' . $newComment['commenter'] . '/original/' . $newComment['image']);

            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "COMMENTS" => $newCount, "NEWCOMMENT" => $commentArray]];
        }
    }
}