<?php

class BuckysSearchApi {

    public function getListAction(){
        global $TNB_GLOBALS, $db;
        $data = $_POST;

        $keyword = isset($data['keyword']) ? $data['keyword'] : null;
        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $sort = "pop";
        $page = isset($data['page']) ? $data['page'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        //Search Results
        $searchIns = new BuckysSearch();
        $pageIns = new BuckysPage();
        $pageFollowerIns = new BuckysPageFollower();

        $db_results = $searchIns->search($keyword, BuckysSearch::SEARCH_TYPE_USER_AND_PAGE, $sort, $page);

        $results = [];

        foreach($db_results as $item){
            $row = [];

            if($item['type'] == "user"){ //User
                $row['type'] = "user";
                //Getting Detail Information
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
                $row['id'] = $item['userID'];
                $row['title'] = $data['firstName'] . " " . $data['lastName'];
                $row['description'] = $data['current_city_visibility'] ? $data['current_city'] : "";
                $row['isFriend'] = !$data['friendID'] ? 'no' : 'yes';
                $row['image'] = THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($data);

            }else{
                $row['type'] = "page";

                //Page
                $pageData = $pageIns->getPageByID($item['pageID']);
                $followerCount = $pageFollowerIns->getNumberOfFollowers($item['pageID']);
                $row['id'] = $item['pageID'];
                $row['title'] = $pageData['title'];
                $row['description'] = number_format($followerCount) . " follower" . ($followerCount > 1 ? "s" : "");
                $row['isFollowed'] = BuckysPageFollower::isFollower($userID, $pageData['pageID']) ? 'yes' : 'no';
                $row['image'] = THENEWBOSTON_SITE_URL . (!$pageData['logo'] ? (DIR_WS_IMAGE . "newPagePlaceholder.jpg") : (DIR_WS_PHOTO . "users/" . $pageData['userID'] . "/resized/" . $pageData['logo']));
            }

            $results[] = $row;
        }

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "RESULT" => $results]];
    }

    public function getFriendListAction(){
        global $TNB_GLOBALS, $db;
        $data = $_POST;

        $keyword = isset($data['keyword']) ? $data['keyword'] : null;
        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;
        $sort = "pop";
        $page = isset($data['page']) ? $data['page'] : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        //Search Results
        $searchIns = new BuckysSearch();
        $pageIns = new BuckysPage();
        $pageFollowerIns = new BuckysPageFollower();

        $db_results = $searchIns->search($keyword, BuckysSearch::SEARCH_TYPE_USER_AND_PAGE, $sort, $page);

        $results = [];

        foreach($db_results as $item){

            if($item['type'] == "user"){

                //Getting Detail Information
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

                if($data['friendID']){
                    $row = [];

                    $row['id'] = $item['userID'];
                    $row['name'] = $data['firstName'] . " " . $data['lastName'];
                    $row['description'] = $data['current_city_visibility'] ? $data['current_city'] : "";
                    $row['friendType'] = "user";
                    $row['thumbnail'] = THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($data);

                    $results[] = $row;
                }
            }
        }

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "RESULT" => $results]];
    }
}