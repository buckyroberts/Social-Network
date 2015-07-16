<?php

class BuckysVideoAPI {

    function getCategoriesAction(){
        $request = $_GET;

        $videoClass = new BuckysVideo();

        $token = isset($request['TOKEN']) ? trim($request['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => ['STATUS' => 'ERROR', 'ERROR' => 'Api token should not be blank']];

        }

        if($token != THENEWBOSTON_PUBLIC_API_KEY){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => ['STATUS' => 'ERROR', 'ERROR' => 'Api token is not valid.']];
        }

        $subjectID = isset($request['subject']) ? buckys_escape_query_string($request['subject']) : 0;

        $videoCategories = $videoClass->getVideoCategories($subjectID);

        return ['STATUS_CODE' => STATUS_CODE_OK, "DATA" => $videoCategories];
    }

    function getVideosAction(){
        $request = $_GET;

        $videoClass = new BuckysVideo();

        $categoryID = isset($request['cat']) ? buckys_escape_query_integer($request['cat']) : null;
        $videoID = isset($request['video']) ? buckys_escape_query_integer($request['video']) : null;

        $token = isset($request['TOKEN']) ? trim($request['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => ['STATUS' => 'ERROR', 'ERROR' => 'Api token should not be blank']];

        }

        if($token != THENEWBOSTON_PUBLIC_API_KEY){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => ['STATUS' => 'ERROR', 'ERROR' => 'Api token is not valid.']];
        }

        $videos = $videoClass->getVideos($categoryID);

        return ['STATUS_CODE' => STATUS_CODE_OK, "DATA" => $videos];
    }
}