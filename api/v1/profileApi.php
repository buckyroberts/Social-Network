<?php

class BuckysProfileApi {

    public function getInfoAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $lastDate = isset($data['lastDate']) ? $data['lastDate'] : null;
        $profileID = isset($data['profileId']) ? $data['profileId'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $userData = BuckysUser::getUserData($profileID);

        if(!buckys_not_null($profileID) || !buckys_not_null($userData) || !BuckysUser::checkUserID($profileID, true)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
        }

        $canViewPrivate = $userID == $profileID || BuckysFriend::isFriend($userID, $profileID) || BuckysFriend::isSentFriendRequest($profileID, $userID);
        $postType = "all";
        $posts = BuckysPost::getPostsByUserID($profileID, $userID, BuckysPost::INDEPENDENT_POST_PAGE_ID, $canViewPrivate, null, $lastDate, $postType);

        //Format Result Data
        $result = [];

        foreach($posts as $post){
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

        $profileInfo = ["name" => $userData['firstName'] . " " . $userData['lastName'], "thumbnail" => THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($userData), "reputation" => number_format($userData['reputation']), "can_post" => $canViewPrivate ? "yes" : "no"];

        $basicInfo = [];
        if(buckys_not_null($userData['gender']) && ($userData['gender_visibility'] || $canViewPrivate)){
            $basicInfo[] = ["label" => "Gender", "value" => $userData['gender']];
        }

        if($userData['relationship_status'] > 0 && ($userData['relationship_status_visibility'] || $canViewPrivate)){
            $basicInfo[] = ["label" => "RelationShip", "value" => $userData['relationship_status'] == 1 ? 'Single' : 'In a Relationship'];
        }

        if(buckys_not_null($userData['religion']) && ($userData['religion_visibility'] || $canViewPrivate)){
            $basicInfo[] = ["label" => "Religion", "value" => $userData['religion']];
        }

        if(buckys_not_null($userData['political_views']) && ($userData['political_views_visibility'] || $canViewPrivate)){
            $basicInfo[] = ["label" => "Political Views", "value" => $userData['political_views']];
        }

        if(buckys_not_null($userData['birthplace']) && ($userData['birthplace_visibility'] || $canViewPrivate)){
            $basicInfo[] = ["label" => "Birthplace", "value" => $userData['birthplace']];
        }

        if(buckys_not_null($userData['current_city']) && ($userData['current_city_visibility'] || $canViewPrivate)){
            $basicInfo[] = ["label" => "Current City", "value" => $userData['current_city']];
        }

        $educations = [];

        foreach($userData['educations'] as $e){
            if($canViewPrivate || $e['visibility']){
                $educations[] = ['school' => $e['school'], 'date' => $e['start'] . " - " . $e['end']];
            }
        }

        $employments = [];
        foreach($userData['employments'] as $e){
            if($canViewPrivate || $e['visibility']){
                $employments[] = ["employer" => $e['employer'], 'date' => $e['start'] . " - " . $e['end']];
            }
        }

        $links = [];

        foreach($userData['links'] as $row){
            if($canViewPrivate || $row['visibility']){
                if(strpos($row['url'], "http://") === false && strpos($row['url'], "https://") === false)
                    $row['url'] = "//" . $row['url'];

                $links[] = ['title' => $row['title'], 'link' => $row['url']];
            }
        }

        $email = [];
        if($userData['email_visibility'] != -1 && ($canViewPrivate || $userData['email_visibility'] == 1)){
            $email = $userData['email'];
        }

        $phones = [];
        if((buckys_not_null($userData['cell_phone']) && ($userData['cell_phone_visibility'] || $canViewPrivate))){
            $phones[] = ["label" => "Cell Phone", "value" => $userData['cell_phone']];
        }

        if((buckys_not_null($userData['home_phone']) && ($userData['home_phone_visibility'] || $canViewPrivate))){
            $phones[] = ["label" => "Home Phone", "value" => $userData['home_phone']];
        }

        if((buckys_not_null($userData['work_phone']) && ($userData['work_phone_visibility'] || $canViewPrivate))){
            $phones[] = ["label" => "Work Phone", "value" => $userData['work_phone']];
        }

        $contacts = [];
        foreach($userData['contact'] as $row){
            if($canViewPrivate || $row['visibility']){
                $contacts[] = ["contact_type" => $row['contact_type'], "contact_name" => $row['contact_name']];
            }
        }

        //Getting Photos
        $photos = BuckysPost::getPhotosByUserID($profileID, $userID, BuckysPost::INDEPENDENT_POST_PAGE_ID, $canViewPrivate, null, null, 18);
        $resultPhotos = [];
        foreach($photos as $row){
            $resultPhotos[] = ["posted_date" => $row['post_date'], "thumbnail" => THENEWBOSTON_SITE_URL . DIR_WS_PHOTO . 'users/' . $row['poster'] . '/resized/' . $row['image'], "original" => THENEWBOSTON_SITE_URL . DIR_WS_PHOTO . 'users/' . $row['poster'] . '/original/' . $row['image']];
        }

        //Get Friends        
        $friends = BuckysFriend::getAllFriends($profileID, 1, BuckysFriend::$COUNT_PER_PAGE);

        $resultFriends = [];
        foreach($friends as $data){
            $row = [];
            $row['id'] = $data['userID'];
            $row['name'] = $data['firstName'] . " " . $data['lastName'];
            $row['description'] = $data['current_city_visibility'] ? $data['current_city'] : "";
            $row['friendType'] = BuckysFriend::getRelationType($userID, $data['userID']);
            $row['thumbnail'] = THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($data);
            $resultFriends[] = $row;
        }

        $returnData = ["STATUS" => "SUCCESS", "FRIENDS" => $resultFriends, "POSTS" => $result, "PHOTOS" => $resultPhotos, "INFO" => $profileInfo

        ];

        if(count($basicInfo) > 0)
            $returnData['BASIC_INFO'] = $basicInfo;

        if(count($educations) > 0)
            $returnData['EDUCATIONS'] = $educations;

        if(count($employments) > 0)
            $returnData['EMPLOYMENTS'] = $employments;

        if(count($links) > 0)
            $returnData['LINKS'] = $links;

        if(count($email) > 0)
            $returnData['EMAIL'] = $email;

        if(count($phones) > 0)
            $returnData['PHONES'] = $phones;

        if(count($contacts) > 0)
            $returnData['CONTACTS'] = $contacts;

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => $returnData];

    }

    public function getPostsAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $lastDate = isset($data['lastDate']) ? $data['lastDate'] : null;
        $profileID = isset($data['profileId']) ? $data['profileId'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $userData = BuckysUser::getUserData($profileID);

        if(!buckys_not_null($profileID) || !buckys_not_null($userData) || !BuckysUser::checkUserID($profileID, true)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
        }

        $canViewPrivate = $userID == $profileID || BuckysFriend::isFriend($userID, $profileID) || BuckysFriend::isSentFriendRequest($profileID, $userID);
        $postType = "all";
        $posts = BuckysPost::getPostsByUserID($profileID, $userID, BuckysPost::INDEPENDENT_POST_PAGE_ID, $canViewPrivate, null, $lastDate, $postType);

        //Format Result Data
        $result = [];

        foreach($posts as $post){
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

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "POSTS" => $result

        ]];

    }

    public function getPhotosAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $lastDate = isset($data['lastDate']) ? $data['lastDate'] : null;
        $profileID = isset($data['profileId']) ? $data['profileId'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $userData = BuckysUser::getUserData($profileID);

        if(!buckys_not_null($profileID) || !buckys_not_null($userData) || !BuckysUser::checkUserID($profileID, true)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
        }

        $canViewPrivate = $userID == $profileID || BuckysFriend::isFriend($userID, $profileID) || BuckysFriend::isSentFriendRequest($profileID, $userID);

        //Getting Photos
        $photos = BuckysPost::getPhotosByUserID($profileID, $userID, BuckysPost::INDEPENDENT_POST_PAGE_ID, $canViewPrivate, null, null, 18, $lastDate);
        $resultPhotos = [];
        foreach($photos as $row){
            $resultPhotos[] = ["posted_date" => $row['post_date'], "thumbnail" => THENEWBOSTON_SITE_URL . DIR_WS_PHOTO . 'users/' . $row['poster'] . '/resized/' . $row['image'], "original" => THENEWBOSTON_SITE_URL . DIR_WS_PHOTO . 'users/' . $row['poster'] . '/original/' . $row['image']];
        }

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "PHOTOS" => $resultPhotos

        ]];

    }

    public function getFriendsAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $page = isset($data['page']) ? $data['page'] : 1;
        $profileID = isset($data['profileId']) ? $data['profileId'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $userData = BuckysUser::getUserData($profileID);

        if(!buckys_not_null($profileID) || !buckys_not_null($userData) || !BuckysUser::checkUserID($profileID, true)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
        }

        $canViewPrivate = $userID == $profileID || BuckysFriend::isFriend($userID, $profileID) || BuckysFriend::isSentFriendRequest($profileID, $userID);

        //Getting Photos
        //Get Friends        
        $friends = BuckysFriend::getAllFriends($profileID, $page, BuckysFriend::$COUNT_PER_PAGE);

        $resultFriends = [];
        foreach($friends as $data){
            $row['id'] = $data['userID'];
            $row['name'] = $data['firstName'] . " " . $data['lastName'];
            $row['description'] = $data['current_city_visibility'] ? $data['current_city'] : "";
            $row['friendType'] = BuckysFriend::getRelationType($userID, $data['userID']);
            $row['thumbnail'] = THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($data);
            $resultFriends[] = $row;
        }

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "FRIENDS" => $resultFriends

        ]];

    }

    public function addFriendAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $friendID = isset($data['friendID']) ? $data['friendID'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        if(!isset($friendID) || !BuckysUser::checkUserID($friendID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
        }
        if(BuckysFriend::isFriend($userID, $friendID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
        }
        if(BuckysFriend::isSentFriendRequest($userID, $friendID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_FRIEND_REQUEST_ALREADY_SENT)];
        }
        if(BuckysFriend::isSentFriendRequest($friendID, $userID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_FRIEND_REQUEST_ALREADY_RECEIVED)];
        }
        if(BuckysFriend::sendFriendRequest($userID, $friendID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "MESSAGE" => MSG_FRIEND_REQUEST_SENT]];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result($db->getLastError())];
        }
    }

    public function unfriendAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $friendID = isset($data['friendID']) ? $data['friendID'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        if(!isset($friendID) || !BuckysUser::checkUserID($friendID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
        }

        if(BuckysFriend::unfriend($userID, $friendID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => "SUCCESS", "MESSAGE" => MSG_FRIEND_REQUEST_REMOVED]];
        }else{
            ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(buckys_get_pure_messages())];
        }
    }

    public function deleteFriendRequestAction(){
        global $db;

        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $friendID = isset($data['friendID']) ? $data['friendID'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        if(!isset($friendID) || !BuckysUser::checkUserID($friendID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
        }

        if(BuckysFriend::delete($userID, $friendID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => "SUCCESS", "MESSAGE" => MSG_FRIEND_REQUEST_REMOVED]];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result($db->getLastError())];
        }
    }

    public function approveFriendRequestAction(){
        global $db;

        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $friendID = isset($data['friendID']) ? $data['friendID'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        if(!isset($friendID) || !BuckysUser::checkUserID($friendID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
        }

        if(BuckysFriend::accept($userID, $friendID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => "SUCCESS", "MESSAGE" => MSG_FRIEND_REQUEST_APPROVED]];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result($db->getLastError())];
        }
    }

    public function declineFriendRequestAction(){
        global $db;

        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $friendID = isset($data['friendID']) ? $data['friendID'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        if(!isset($friendID) || !BuckysUser::checkUserID($friendID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_INVALID_REQUEST)];
        }

        if(BuckysFriend::decline($userID, $friendID)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => "SUCCESS", "MESSAGE" => MSG_FRIEND_REQUEST_DECLINED]];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result($db->getLastError())];
        }
    }

    public function followAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $pageID = isset($data['pageID']) ? $data['pageID'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $pageFollowerIns = new BuckysPageFollower();

        $result = $pageFollowerIns->addFollower($pageID, $userID);

        if($result){
            $count = $pageFollowerIns->getNumberOfFollowers($pageID);
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "MESSAGE" => MSG_FOLLOW_PAGE_SUCCESS, "FOLLOWERS" => $count . " follower" . ($count > 1 ? "s" : "")]];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_FOLLOW_PAGE_FAIL)];
        }
    }

}