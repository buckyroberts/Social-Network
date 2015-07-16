<?php

class BuckysNotificationApi {

    public function getNotificationCountAction(){
        $request = $_GET;

        $token = isset($request['TOKEN']) ? trim($request['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $newMessageCount = BuckysMessage::getNumOfNewMessages($userID);
        $newNotificationCount = BuckysActivity::getNumberOfNotifications($userID);
        $friendRequestCount = BuckysFriend::getNumberOfReceivedRequests($userID);

        $results = [];

        $results['new_message'] = $newMessageCount;
        $results['new_notification'] = $newNotificationCount;
        $results['friend_request'] = $friendRequestCount;

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "RESULT" => $results]];
    }

    public function getNewNotificationAction(){
        global $TNB_GLOBALS, $db;

        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $notifications = BuckysActivity::getAppNotifications($userID, $data['page']);

        $results = [];

        foreach($notifications as $row){
            $item = [];

            $item['postID'] = $row['postID'];
            $item['userID'] = $row['userID'];

            $query = $db->prepare("SELECT
                                u.firstName, 
                                u.lastName, 
                                u.userID, 
                                u.thumbnail, 
                                u.current_city, 
                                u.current_city_visibility,
                                f.friendID 
                          FROM 
                                " . TABLE_USERS . " AS u
                          LEFT JOIN " . TABLE_FRIENDS . " AS f ON f.userID=%d AND f.userFriendID=u.userID AND f.status='1'
                          WHERE u.userID=%d", $userID, $item['userID']);

            $data = $db->getRow($query);

            $item['userName'] = $data['firstName'] . " " . $data['lastName'];
            $item['comment_content'] = $row['comment_content'];
            $item['userThumbnail'] = THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($data);
            $item['type'] = $row['type'];
            $item['activityType'] = $row['activityType'];
            $item['post_date'] = buckys_api_format_date($userID, $row['post_date']);
            $item['isNew'] = $row['isNew'];

            $results[] = $item;
        }

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "RESULT" => $results]];
    }

    public function markReadNotificationAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        if(BuckysActivity::markReadNotifications($userID, $data['postID'])){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS']];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('There was an error to mark read.')];
        }
    }
}