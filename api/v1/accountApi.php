<?php

class BuckysAccountAPI {

    /**
     * Process Login from api
     *
     * @return userID, Email and Token
     */
    public function loginAction(){
        //The login request should be POST method
        $request = $_POST;

        $token = isset($request['TOKEN']) ? trim($request['TOKEN']) : null;
        $email = isset($request['email']) ? trim($request['email']) : null;
        $password = isset($request['password']) ? trim($request['password']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if($token != THENEWBOSTON_PUBLIC_API_KEY){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $info = buckys_get_user_by_email($email);

        if(buckys_not_null($info) && buckys_validate_password($password, $info['password'])){
            if($info['status'] == 0){ //Account is not verified
                return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result(MSG_ACCOUNT_NOT_VERIFIED)];
            }else{
                //Remove Old Token
                BuckysUsersToken::removeUserToken($info['userID'], 'api');

                //Create New Token
                $token = BuckysUsersToken::createNewToken($info['userID'], 'api');

                return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS', 'TOKEN' => $token, 'EMAIL' => $info['email'], 'USERID' => $info['userID']]];
            }
        }else{
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result('Email or password is not correct.')];
        }
    }

    public function registerAction(){
        $request = $_POST; //email, firstName, lastName, email, password, password2

        $token = isset($request['TOKEN']) ? trim($request['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if($token != THENEWBOSTON_PUBLIC_API_KEY){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        //Validate Input Data
        $newID = BuckysUser::createNewAccount($request);

        if(!$newID){
            //Getting Error Message
            $error = buckys_get_pure_messages();

            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result($error)];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS', 'USERID' => $newID, 'MESSAGE' => MSG_NEW_ACCOUNT_CREATED]];
        }
    }

    /**
     * Get User Basic Info

     */
    public function getBasicInfoAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $userData = BuckysUser::getUserData($userID);

        $basicInfo = ['firstName' => $userData['firstName'], 'lastName' => $userData['lastName'], 'gender' => $userData['gender'], 'gender_visibility' => $userData['gender_visibility'], 'relationship_status' => $userData['relationship_status'], 'relationship_status_visibility' => $userData['relationship_status_visibility'], 'birthdate_year' => date("Y", strtotime($userData['birthdate'])), 'birthdate_month' => date("n", strtotime($userData['birthdate'])), 'birthdate_day' => date("j", strtotime($userData['birthdate'])), 'birthdate' => $userData['birthdate'], 'birthdate_visibility' => $userData['birthdate_visibility'], 'religion' => $userData['religion'], 'religion_visibility' => $userData['religion_visibility'], 'political_views' => $userData['political_views'], 'political_views_visibility' => $userData['political_views_visibility'], 'birthplace' => $userData['birthplace'], 'birthplace_visibility' => $userData['birthplace_visibility'], 'current_city' => $userData['current_city'], 'current_city_visibility' => $userData['current_city_visibility'],];

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS', 'USER_INFO' => $basicInfo]];
    }

    public function saveBasicInfoAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $userData = BuckysUser::getUserData($userID);

        if($data['birthdate_year'] == '-')
            $data['birthdate_year'] = '';
        if($data['birthdate_month'] == '-')
            $data['birthdate_month'] = '';
        if($data['birthdate_day'] == '-')
            $data['birthdate_day'] = '';

        switch($data['relationship_status']){
            case 'Single':
                $data['relationship_status'] = 1;
                break;
            case 'In a Relationship':
                $data['relationship_status'] = 2;
                break;
            case '-':
            default:
                $data['relationship_status'] = 0;
                break;
        }

        $data['timezone'] = $userData['timezone'];

        if(BuckysUser::saveUserBasicInfo($userID, $data)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS']];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('There was an error to saving your information.')];
        }

        exit;
    }

    public function getEducationInfoAction(){
        $request = $_GET;

        $token = isset($request['TOKEN']) ? trim($request['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $educationInfo = BuckysUser::getUserEducations($userID);

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS', 'RESULT' => $educationInfo]];
    }

    public function saveEducationInfoAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $count = isset($data['COUNT']) ? $data['COUNT'] : 0;

        $info = [];

        for($i = 0; $i < $count; $i++){
            $row = [];

            $row['name'] = $data['NAME' . $i];
            $row['start'] = $data['START' . $i];
            $row['end'] = $data['END' . $i];
            $row['visibility'] = $data['VISIBILITY' . $i];

            $info[] = $row;
        }

        if(BuckysUser::updateUserEducationInfo($userID, $info)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS']];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('There was an error to saving your information.')];
        }

        exit;
    }

    public function getEmployeeInfoAction(){
        $request = $_GET;

        $token = isset($request['TOKEN']) ? trim($request['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $employeeInfo = BuckysUser::getUserEmploymentHistory($userID);

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS', 'RESULT' => $employeeInfo]];
    }

    public function saveEmployeeInfoAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $count = isset($data['COUNT']) ? $data['COUNT'] : 0;

        $info = [];

        for($i = 0; $i < $count; $i++){
            $row = [];

            $row['employer'] = $data['NAME' . $i];
            $row['start'] = $data['START' . $i];
            $row['end'] = $data['END' . $i];
            $row['visibility'] = $data['VISIBILITY' . $i];

            $info[] = $row;
        }

        if(BuckysUser::updateUserEmploymentHistory($userID, $info)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS']];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('There was an error to saving your information.')];
        }

        exit;
    }

    public function getLinkInfoAction(){
        $request = $_GET;

        $token = isset($request['TOKEN']) ? trim($request['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $linkInfo = BuckysUser::getUserLinks($userID);

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS', 'RESULT' => $linkInfo]];
    }

    public function saveLinkInfoAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $count = isset($data['COUNT']) ? $data['COUNT'] : 0;

        $info = [];

        for($i = 0; $i < $count; $i++){
            $row = [];

            $row['title'] = $data['TITLE' . $i];
            $row['url'] = $data['URL' . $i];
            $row['visibility'] = $data['VISIBILITY' . $i];

            $info[] = $row;
        }

        if(BuckysUser::updateUserLinks($userID, $info)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS']];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('There was an error to saving your information.')];
        }

        exit;
    }

    public function getContactInfoAction(){
        $request = $_GET;

        $token = isset($request['TOKEN']) ? trim($request['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $contactInfo = BuckysUser::getUserContactInfo($userID);

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS', 'RESULT' => $contactInfo]];
    }

    public function saveContactInfoAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $header = [];
        $header['email'] = $data['email'];
        $header['work_phone'] = $data['work_phone'];
        $header['home_phone'] = $data['home_phone'];
        $header['cell_phone'] = $data['cell_phone'];
        $header['email_visibility'] = $data['email_visibility'];
        $header['home_phone_visibility'] = $data['home_phone_visibility'];
        $header['work_phone_visibility'] = $data['work_phone_visibility'];
        $header['cell_phone_visibility'] = $data['cell_phone_visibility'];

        $count = isset($data['COUNT']) ? $data['COUNT'] : 0;

        $info = [];

        for($i = 0; $i < $count; $i++){
            $row = [];

            $row['name'] = $data['CONTACT_NAME' . $i];
            $row['type'] = $data['CONTACT_TYPE' . $i];
            $row['visibility'] = $data['VISIBILITY' . $i];

            $info[] = $row;
        }

        if(BuckysUser::updateUserFields($userID, $header) && BuckysUser::updateUserMessengerInfo($userID, $info)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS']];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('There was an error to saving your information.')];
        }

        exit;
    }

    public function changePasswordAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $current = BuckysUser::getUserData($userID);

        if(!buckys_validate_password($data['current_password'], $current['password'])){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result('Current password is incorrect.')];
        }else{
            $pwd = buckys_encrypt_password($data['new_password']);

            if(BuckysUser::updateUserFields($userID, ['password' => $pwd])){
                return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS']];
            }else{
                return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('There was an error to saving your information.')];
            }
        }

        exit;
    }

    public function deleteAccountAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $current = BuckysUser::getUserData($userID);

        if(!buckys_validate_password($data['password'], $current['password'])){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => buckys_api_get_error_result('Current password is incorrect.')];
        }else{
            if(BuckysUser::deleteUserAccount($userID)){
                return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS']];
            }else{
                return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('There was an error to saving your information.')];
            }
        }

        exit;
    }
}
