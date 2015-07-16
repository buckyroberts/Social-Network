<?php
/**
 * Buckys Ads
 */

if(!defined('TNB_AD_STATUS_PENDING'))
    define('TNB_AD_STATUS_PENDING', 0);

if(!defined('TNB_AD_STATUS_ACTIVE'))
    define('TNB_AD_STATUS_ACTIVE', 1);

if(!defined('TNB_AD_STATUS_EXPIRED'))
    define('TNB_AD_STATUS_EXPIRED', -1);

if(!defined('TNB_AD_STATUS_REJECTED'))
    define('TNB_AD_STATUS_REJECTED', -2);

class BuckysAds {

    public $last_message;

    public static $COUNT_PER_PAGE = 20;

    /**
     * Getting Ad Sizes

     */
    public function getAdSizes(){
        global $db;

        $query = "SELECT * FROM " . TABLE_AD_SIZES . " ORDER BY `order`";
        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * Getting Size Detail
     *
     * @param mixed $id
     * @return stdClass
     */
    public function getAdSizeById($id){
        global $db;

        $query = $db->prepare("SELECT * FROM " . TABLE_AD_SIZES . " WHERE id=%d", $id);
        $row = $db->getRow($query);

        return $row;
    }

    /**
     * @param $userID
     * @param $data
     * @return bool
     */
    public function saveAd($userID, $data){
        global $db;

        //Validation Testing

        $adType = $data['type'];

        $adName = trim($data['name']);
        $adUrl = trim($data['url']);
        $budget = floatval($data['budget']);

        if(!$adName || !$adUrl || !$budget){
            $this->last_message = MSG_INVALID_REQUEST;
            return false;
        }

        if($budget < ADS_MINIMUM_PURCHASE_AMOUNT){
            $this->last_message = 'Minimum budget must be at least ' . ADS_MINIMUM_PURCHASE_AMOUNT . ' BTC';
            return false;
        }

        if($adType == 'Text'){
            $title = trim($data['title']);
            $description = trim($data['description']);
            $display_url = trim($data['display_url']);

            if(strlen($title) > 35){
                $this->last_message = MSG_AD_TITLE_LENGTH_ERROR;
                return false;
            }
            if(strlen($description) > 70){
                $this->last_message = MSG_AD_DESCRIPTION_LENGTH_ERROR;
                return false;
            }
            if(strlen($display_url) > 35){
                $this->last_message = MSG_AD_DISPLAY_URL_LENGTH_ERROR;
                return false;
            }
        }else if($adType == 'Image'){
            $adSize = $data['size'];
            $fileName = $data['file_name'];
        }else{
            $this->last_message = MSG_INVALID_REQUEST;
            return false;
        }

        //Check User Balance
        $bitcoinClass = new BuckysBitcoin();
        $userBalance = $bitcoinClass->getUserWalletBalance($userID);
        if($userBalance < $budget){
            $this->last_message = sprintf(MSG_AD_BITCOIN_BALANCE_NOT_ENOUGH_ERROR, $userBalance . ' BTC');
            return false;
        }

        $sendPayment = $bitcoinClass->sendBitcoin($userID, TNB_BITCOIN_ADDRESS, $budget);

        //they tried to send all the BTC in their wallet and didn't have enough for the fee
        if($sendPayment === false){
            $_SESSION['message'] = [];
            $tryPaymentAgain = $bitcoinClass->sendBitcoin($userID, TNB_BITCOIN_ADDRESS, $budget - BLOCKCHAIN_FEE);
            if($tryPaymentAgain === false){
                $this->last_message = MSG_INVALID_REQUEST;
                return false;
            }
        }

        $impressions = round($budget / ADS_PRICE_FOR_THOUSAND_IMPRESSIONS * 1000);
        $adKey = md5(buckys_generate_random_string(10) . $adName . $userID . time());

        if($adType == 'Text'){
            if(!$title || !$description || !$display_url){
                $this->last_message = MSG_INVALID_REQUEST;
                return false;
            }

            $newId = $db->insertFromArray(TABLE_ADS, ['adKey' => $adKey, 'status' => TNB_AD_STATUS_PENDING, 'createdDate' => date('Y-m-d H:i:s'), 'startedDate' => '0000-00-00 00:00:00', 'endedDate' => '0000-00-00 00:00:00', 'type' => 'Text', 'name' => $adName, 'title' => $title, 'budget' => $budget, 'ownerID' => $userID, 'description' => $description, 'url' => $adUrl, 'display_url' => $display_url, 'impressions' => $impressions]);

            if(!$newId){
                $this->last_message = $db->last_error;
                return false;
            }

            $this->last_message = MSG_AD_NEW_AD_CREATED;
            return true;
        }else if($adType == 'Image'){
            if(!$adSize || !$fileName || !file_exists(DIR_FS_TMP . $fileName)){
                $this->last_message = MSG_INVALID_REQUEST;
                return false;
            }

            //Move the image to the images/ads directory
            if(!is_dir(DIR_FS_AD_IMG)){
                mkdir(DIR_FS_AD_IMG, 0777);
                //Create Index.html to prevent directory listing issue
                $fp = fopen(DIR_FS_AD_IMG . "/index.html", "w");
                fclose($fp);
            }

            $newFileName = md5(time() . $fileName) . "." . pathinfo($fileName, PATHINFO_EXTENSION);

            $fp = fopen(DIR_FS_TMP . $fileName, "r");
            $fp1 = fopen(DIR_FS_AD_IMG . $newFileName, "w");
            $imgContent = fread($fp, filesize(DIR_FS_TMP . $fileName));
            fwrite($fp1, $imgContent);
            fclose($fp1);
            fclose($fp);

            unlink(DIR_FS_TMP . $fileName);

            $newId = $db->insertFromArray(TABLE_ADS, ['adKey' => $adKey, 'status' => TNB_AD_STATUS_PENDING, 'createdDate' => date('Y-m-d H:i:s'), 'startedDate' => '0000-00-00 00:00:00', 'endedDate' => '0000-00-00 00:00:00', 'type' => 'Image', 'name' => $adName, 'url' => $adUrl, 'budget' => $budget, 'ownerID' => $userID, 'adSize' => $adSize, 'fileName' => $newFileName, 'impressions' => $impressions]);

            if(!$newId){
                $this->last_message = $db->last_error;
                return false;
            }

            $this->last_message = MSG_AD_NEW_AD_CREATED;
            return true;
        }

    }

    /**
     * Getting Pending Ads Count

     */
    public static function getPendingAdsCount(){
        global $db;

        $query = "SELECT count(*) FROM " . TABLE_ADS . " WHERE `status`=" . TNB_AD_STATUS_PENDING;
        $c = $db->getVar($query);

        return $c;

    }

    /**
     * Getting Pending ADs
     *
     * @param mixed $page
     * @param mixed $limit
     * @return Indexed
     */
    public function getPendingAds($page, $limit = null){
        global $db;

        $query = "SELECT AD.*, CONCAT(U.firstName, ' ', U.lastName) AS creatorName
                    FROM " . TABLE_ADS . " AS AD
                    LEFT JOIN " . TABLE_USERS . " AS U ON U.userID = AD.ownerID
                  WHERE AD.`status`=" . TNB_AD_STATUS_PENDING . " ORDER BY AD.id";

        if($limit)
            $query .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;

        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * Approve Ads
     *
     * @param mixed $id
     * @return bool
     */
    public function approveAds($id){
        global $db;

        if(!is_array($id)){
            $id = [$id];
        }

        foreach($id as $ad_id){
            $query = $db->prepare("UPDATE " . TABLE_ADS . " SET `status`=" . TNB_AD_STATUS_ACTIVE . ", `startedDate`='" . date('Y-m-d H:i:s') . "' WHERE id=%d", $ad_id);
            $db->query($query);
        }

        return true;
    }

    /**
     * Reject Ads
     *
     * @param mixed $id
     * @return bool
     */
    public function rejectAds($id){
        global $db;

        if(!is_array($id)){
            $id = [$id];
        }

        $bitcoinClass = new BuckysBitcoin();

        foreach($id as $ad_id){
            $query = $db->prepare("UPDATE " . TABLE_ADS . " SET `status`=" . TNB_AD_STATUS_REJECTED . " WHERE id=%d", $ad_id);
            $db->query($query);
            //Return Bitcoin
            $query = $db->prepare("SELECT b.bitcoin_address, a.budget FROM " . TABLE_ADS . " AS a LEFT JOIN " . TABLE_USERS_BITCOIN . " AS b ON a.ownerID=b.userID WHERE a.id=%d", $ad_id);
            $info = $db->getRow($query);
            $bitcoinClass->sendBitcoinFromBuckysroom($info['bitcoin_address'], $info['budget'] - BLOCKCHAIN_FEE);
        }

        return true;
    }

    /**
     * Getting User Ads
     *
     * @param Int    $userID
     * @param String $status
     * @param Int    $page
     * @param Int    $limit
     * @return Indexed
     */
    public function getUserAds($userID, $status, $page = null, $limit = null){
        global $db;

        $query = $db->prepare("SELECT * FROM " . TABLE_ADS . " WHERE ownerID=%d", $userID);

        switch($status){
            case 'active':
                $query .= " AND `status`=" . TNB_AD_STATUS_ACTIVE;
                break;
            case 'pending':
                $query .= " AND `status`=" . TNB_AD_STATUS_PENDING;
                break;
            case 'expired':
                $query .= " AND `status`=" . TNB_AD_STATUS_EXPIRED;
                break;
        }

        if($page){
            $query .= " LIMIT " . ($page - 1) * $limit . ", " . $limit;
        }

        $rows = $db->getResultsArray($query);

        return $rows;
    }

    /**
     * @param $userID
     * @param $status
     * @return one
     */
    public function getUserAdsCount($userID, $status){
        global $db;

        $query = $db->prepare("SELECT count(*) FROM " . TABLE_ADS . " WHERE ownerID=%d", $userID);

        switch($status){
            case 'active':
                $query .= " AND `status`=" . TNB_AD_STATUS_ACTIVE;
                break;
            case 'pending':
                $query .= " AND `status`=" . TNB_AD_STATUS_PENDING;
                break;
            case 'expired':
                $query .= " AND `status`=" . TNB_AD_STATUS_EXPIRED;
                break;
        }

        $c = $db->getVar($query);

        return $c;
    }

    /**
     * put your comment there...
     *
     * @param Int $id
     * @return Array
     */
    public function getAdById($id){
        global $db;

        $query = $db->prepare("SELECT AD.*, CONCAT(U.firstName, ' ', U.lastName) AS creatorName
                    FROM " . TABLE_ADS . " AS AD
                    LEFT JOIN " . TABLE_USERS . " AS U ON U.userID = AD.ownerID
                  WHERE AD.`id`=%d", $id);

        $detail = $db->getRow($query);

        return $detail;
    }

    /**
     * @param $userID
     * @param $adID
     * @param $amount
     * @return bool
     */
    public function addFunds($userID, $adID, $amount){
        global $db;

        $amount = doubleval($amount);

        //Check User Balance
        $bitcoinClass = new BuckysBitcoin();
        $userBalance = $bitcoinClass->getUserWalletBalance($userID);
        if($userBalance < $amount){
            $this->last_message = sprintf(MSG_AD_BITCOIN_BALANCE_NOT_ENOUGH_ERROR, $userBalance . ' BTC');
            return false;
        }

        $sendPayment = $bitcoinClass->sendBitcoin($userID, TNB_BITCOIN_ADDRESS, $amount);

        //they tried to send all the BTC in their wallet and didn't have enough for the fee
        if($sendPayment === false){
            $_SESSION['message'] = [];
            $tryPaymentAgain = $bitcoinClass->sendBitcoin($userID, TNB_BITCOIN_ADDRESS, $amount - BLOCKCHAIN_FEE);
            if($tryPaymentAgain === false){
                $this->last_message = MSG_INVALID_REQUEST;
                return false;
            }
        }

        $impressions = round($amount / ADS_PRICE_FOR_THOUSAND_IMPRESSIONS * 1000);

        //Update AD
        $query = $db->prepare("UPDATE " . TABLE_ADS . " SET `status`=1, `budget`=`budget` + " . $amount . ", `impressions`=`impressions` + " . $impressions . " WHERE id=%d", $adID);
        $db->query($query);

        $this->last_message = MSG_AD_UPDATED;

        return true;
    }

}