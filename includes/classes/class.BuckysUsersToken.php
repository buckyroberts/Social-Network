<?php

class BuckysUsersToken {

    /**
     * Remove User Token
     *
     * @param Int    $userID
     * @param String $tokenType = password, ...
     */
    public static function removeUserToken($userID, $tokenType){
        global $db;

        $query = $db->prepare("DELETE FROM " . TABLE_USERS_TOKEN . " WHERE userID=%s AND tokenType=%s", $userID, $tokenType);
        $db->query($query);

        return;
    }

    /**
     * @param      $userID
     * @param      $tokenType
     * @param null $token
     * @return null|string
     */
    public static function createNewToken($userID, $tokenType, $token = null){
        global $db;

        $info = BuckysUser::getUserData($userID);

        if(!$token){
            $token = md5(mt_rand(0, 99999) . time() . mt_rand(0, 99999) . $info['email'] . mt_rand(0, 99999));
        }

        $newID = $db->insertFromArray(TABLE_USERS_TOKEN, ['userID' => $userID, 'userToken' => $token, 'tokenDate' => time(), 'tokenType' => $tokenType]);

        return $token;
    }

    /**
     * @param $token
     * @param $tokenType
     * @return bool|one
     */
    public static function checkTokenValidity($token, $tokenType){
        global $db;

        if($tokenType == 'password'){
            $query = $db->prepare('SELECT userID FROM ' . TABLE_USERS_TOKEN . ' WHERE userToken=%s AND tokenType=%s AND tokenDate > %s', $token, $tokenType, time() - PASSWORD_TOKEN_EXPIRY_DATE * 60 * 60 * 24);
        }else{
            $query = $db->prepare('SELECT userID FROM ' . TABLE_USERS_TOKEN . ' WHERE userToken=%s AND tokenType=%s', $token, $tokenType);
        }
        $userID = $db->getVar($query);
        if(!$userID){
            return false;
        }
        return $userID;

        return false;
    }

}