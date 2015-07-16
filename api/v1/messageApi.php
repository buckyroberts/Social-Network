<?php

class BuckysMessageApi {

    public function getInboxAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $messages = BuckysMessage::getReceivedMessages($userID, $data['page']);

        $results = [];

        foreach($messages as $row){
            $item = [];

            $item['messageID'] = $row['messageID'];

            $item['body'] = $row['body'];
            $item['subject'] = $row['subject'];

            $item['status'] = $row['status'];

            $item['sender'] = $row['sender'];
            $item['senderName'] = $row['senderName'];
            $item['thumbnail'] = THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($row['sender']);

            $item['created_date'] = buckys_api_format_date($userID, $row['created_date']);

            $item['type'] = "inbox";

            $results[] = $item;
        }

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "RESULT" => $results]];
    }

    public function getSentAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $messages = BuckysMessage::getSentMessages($userID, $data['page']);

        $results = [];

        foreach($messages as $row){
            $item = [];

            $item['messageID'] = $row['messageID'];

            $item['body'] = $row['body'];
            $item['subject'] = $row['subject'];

            $item['status'] = $row['status'];

            $item['sender'] = $row['sender'];
            $item['senderName'] = $row['senderName'];
            $item['thumbnail'] = THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($row['receiver']);

            $item['created_date'] = buckys_api_format_date($userID, $row['created_date']);
            $item['type'] = "sent";

            $results[] = $item;
        }

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "RESULT" => $results]];
    }

    public function getTrashAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $messages = BuckysMessage::getDeletedMessages($userID, $data['page']);

        $results = [];

        foreach($messages as $row){
            $item = [];

            $item['messageID'] = $row['messageID'];

            $item['body'] = $row['body'];
            $item['subject'] = $row['subject'];

            $item['status'] = $row['status'];

            $item['sender'] = $row['sender'];
            $item['senderName'] = $row['senderName'];
            $item['thumbnail'] = THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($row['sender']);

            $item['created_date'] = buckys_api_format_date($userID, $row['created_date']);
            $item['type'] = "trash";

            $results[] = $item;
        }

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "RESULT" => $results]];
    }

    public function getMessageInfoAction(){
        $request = $_GET;

        $token = isset($request['TOKEN']) ? trim($request['TOKEN']) : null;
        $messageId = isset($request['messageID']) ? trim($request['messageID']) : null;
        $messageType = isset($request['messageType']) ? trim($request['messageType']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        BuckysMessage::changeMessageStatus($messageId);

        $row = BuckysMessage::getMessageById($messageId);

        if(empty($row)){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('No record found.')];
        }

        $results = [];

        $results['messageID'] = $row['messageID'];

        $results['body'] = $row['body'];
        $results['subject'] = $row['subject'];

        $results['status'] = $row['status'];
        $results['type'] = $messageType;

        $results['sender'] = $row['sender'];
        $results['senderName'] = $row['senderName'];
        $results['senderThumbnail'] = THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($row['sender']);

        $results['receiver'] = $row['receiver'];
        $results['receiverName'] = $row['receiverName'];
        $results['receiverThumbnail'] = THENEWBOSTON_SITE_URL . BuckysUser::getProfileIcon($row['receiver']);

        $results['created_date'] = buckys_api_format_date($userID, $row['created_date']);

        $results['nextId'] = BuckysMessage::getNextID($userID, $messageId, $messageType);
        $results['prevId'] = BuckysMessage::getPrevID($userID, $messageId, $messageType);

        return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ["STATUS" => "SUCCESS", "RESULT" => $results]];
    }

    public function deleteMessageInfoAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        if(BuckysMessage::deleteMessage($data['messageID'])){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS']];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('There was an error to send your message.')];
        }
    }

    public function composeMessageAction(){
        $data = $_POST;

        $token = isset($data['TOKEN']) ? trim($data['TOKEN']) : null;

        if(!$token){
            return ['STATUS_CODE' => STATUS_CODE_BAD_REQUEST, 'DATA' => buckys_api_get_error_result('Api token should not be blank')];
        }

        if(!($userID = BuckysUsersToken::checkTokenValidity($token, "api"))){
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('Api token is not valid.')];
        }

        $param['userID'] = $userID;
        $param['to'] = $data['to'];
        $param['subject'] = $data['subject'];
        $param['body'] = $data['body'];

        if(BuckysMessage::sendMessage($param)){
            return ['STATUS_CODE' => STATUS_CODE_OK, 'DATA' => ['STATUS' => 'SUCCESS']];
        }else{
            return ['STATUS_CODE' => STATUS_CODE_UNAUTHORIZED, 'DATA' => buckys_api_get_error_result('There was an error to send your message.')];
        }
    }
}