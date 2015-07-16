<?php

class BuckysStreamAPI {

    public function getListAction(){
        $request = $_GET;

        $token = isset($request['TOKEN']) ? trim($request['TOKEN']) : null;
        $lastDate = isset($request['lastDate']) ? $request['lastDate'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $stream = BuckysPost::getUserPostsStream($userID, $lastDate);

        //Format Result Data
        $result = [];

        foreach($stream as $post){
            if($post['pageID'] != BuckysPost::INDEPENDENT_POST_PAGE_ID){
                $pageIns = new BuckysPage();
                $pageData = $pageIns->getPageByID($post['pageID']);
            }

            $pagePostFlag = false;
            if(isset($pageData)){
                $pagePostFlag = true;
            }

            $item = [];

            $item['articleId'] = $post['postID'];

            $item['posterId'] = $post['poster'];

            $item['articleImage'] = "";
            $item['articleVideo'] = "";
            $item['articleVideoId'] = "";

            if($pagePostFlag){
                $item['posterName'] = $pageData['title'];
                $item['posterThumbnail'] = buckys_not_null($pageData['logo']) ? (THENEWBOSTON_SITE_URL . DIR_WS_PHOTO . "users/" . $pageData['userID'] . "/resized/" . $pageData['logo']) : (THENEWBOSTON_SITE_URL . DIR_WS_IMAGE . "newPagePlaceholder.jpg");
            }else{
                $item['posterName'] = $post['posterFullName'];
                $item['posterThumbnail'] = THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($post['poster']);
            }

            $item['postedDate'] = buckys_api_format_date($userID, $post['post_date']);
            $item['purePostedDate'] = $post['post_date'];

            $item['articleContent'] = $post['content'];

            if($post['type'] == 'video'){
                $item['articleVideo'] = $post['youtube_url'];
                $item['articleVideoId'] = buckys_get_youtube_video_id($post['youtube_url']);
            }else if($post['type'] == 'image'){
                $item['articleImage'] = THENEWBOSTON_SITE_URL . DIR_WS_PHOTO . 'users/' . $post['poster'] . '/resized/' . $post['image'];
            }

            $item['articleLikes'] = $post['likes'];
            $item['articleComments'] = $post['comments'];
            $item['isLiked'] = !$post['likeID'] ? "no" : "yes";

            $result[] = $item;
        }

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "RESULT" => $result]];

    }
}