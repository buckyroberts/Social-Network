<?php

/**
 * Manage Bitcoins
 */
class BuckysBitcoin {

    var $COUNT_PER_PAGE = 20;

    /**
     * Create Wallet Address
     *
     * @param Int $userID
     * @return array|bool
     */
    public static function createWallet($userID, $userEmail){
        global $db;

        $password = buckys_generate_random_string(10);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://blockchain.info/api/v2/create_wallet?api_code=' . BLOCKCHAIN_INFO_API_KEY . '&password=' . $password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $return = curl_exec($ch);
        curl_close($ch);

        $returnData = json_decode($return);

        if(!$returnData){
            buckys_add_message("There was an error to create bitcoin account: " . $return, "error");
            return false;
        }

        $data = ['userID' => $userID, 'bitcoin_guid' => $returnData->guid, 'bitcoin_address' => $returnData->address, 'bitcoin_link' => $returnData->link, 'bitcoin_password' => buckys_encrypt($password)];

        $db->insertFromArray(TABLE_USERS_BITCOIN, $data);

        return $data;
    }

    /**
     * Get balance
     *
     * @param mixed $userID
     * @return bool|float|int
     */
    public static function getUserWalletBalance($userID){
        $bitcoinInfo = BuckysUser::getUserBitcoinInfo($userID);

        if(!$bitcoinInfo)
            return 0;

        $balance = BuckysBitcoin::getWalletBalance($bitcoinInfo['bitcoin_guid'], buckys_decrypt($bitcoinInfo['bitcoin_password']));

        return $balance;
    }

    /**
     * @param $guid
     * @param $password
     * @return bool|float|int
     */
    public function getWalletBalance($guid, $password){
        global $db;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://blockchain.info/merchant/' . $guid . '/balance?password=' . $password);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $return = curl_exec($ch);

        curl_close($ch);

        $returnData = json_decode($return);

        if(!$returnData){
            buckys_add_message("There was an error to get balance of your wallet: " . $return, MSG_TYPE_ERROR);
            return false;
        }

        if(isset($returnData->error)){
            buckys_add_message('Getting Balance Error: ' . $returnData->error, MSG_TYPE_ERROR);
            return 0;
        }

        return $returnData->balance / 100000000;
    }

    /**
     * @param $userID
     * @param $toAddress
     * @param $amount
     * @return bool
     */
    public static function sendBitcoin($userID, $toAddress, $amount){
        global $db;

        $bitcoinInfo = BuckysUser::getUserBitcoinInfo($userID);

        $amount = $amount * 100000000;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://blockchain.info/merchant/' . $bitcoinInfo['bitcoin_guid'] . '/payment?password=' . buckys_decrypt($bitcoinInfo['bitcoin_password']) . '&to=' . $toAddress . '&amount=' . $amount . '&from=' . $bitcoinInfo['bitcoin_address']);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $return = curl_exec($ch);

        curl_close($ch);

        $returnData = json_decode($return);

        if(!$returnData){
            buckys_add_message("There was an error to send the bitcoin: " . $return, MSG_TYPE_ERROR);
            return false;
        }

        if(isset($returnData->error)){
            buckys_add_message('Sending Bitcoin Error: ' . $returnData->error, MSG_TYPE_ERROR);
            return false;

        }else{
            buckys_add_message($returnData->message);
            if(isset($returnData->notice) && $returnData->notice)
                buckys_add_message($returnData->notice, MSG_TYPE_NOTICE);
        }

        return true;
    }

    /**
     * @param $address
     * @param $amount
     * @return bool
     */
    public function sendBitcoinFromBuckysroom($address, $amount){
        global $db;

        $amount = $amount * 100000000;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://blockchain.info/merchant/' . TNB_BITCOIN_GUID . '/payment?password=' . TNB_BITCOIN_PASSWORD . '&to=' . $address . '&amount=' . $amount . '&from=' . TNB_BITCOIN_ADDRESS);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $return = curl_exec($ch);

        curl_close($ch);

        $returnData = json_decode($return);

        if(!$returnData){
            buckys_add_message("There was an error to send the bitcoin: " . $return, MSG_TYPE_ERROR);
            return false;
        }

        if(isset($returnData->error)){
            buckys_add_message('Sending Bitcoin Error: ' . $returnData->error, MSG_TYPE_ERROR);
            return false;

        }else{
            buckys_add_message($returnData->message);
            if(isset($returnData->notice) && $returnData->notice)
                buckys_add_message($returnData->notice, MSG_TYPE_NOTICE);
        }

        return true;
    }

    /**
     * @param     $userID
     * @param int $page
     * @param int $limit
     * @return array|bool
     */
    public function getTransactions($userID, $page = 1, $limit = 20){
        global $db;

        if(!$this->_getTransactions($userID)){
            return false;
        }

        //Getting Total Transactions and final balance
        $query = $db->prepare("SELECT count(*) AS n_tx FROM " . TABLE_USERS_BITCOIN_TRANSACTIONS_HISTORY . " WHERE userID=%d", $userID);
        $totalCount = $db->getVar($query);

        $query = $db->prepare("SELECT balance FROM " . TABLE_USERS_BITCOIN_TRANSACTIONS_HISTORY . " WHERE userID=%d ORDER BY `date` DESC LIMIT 1", $userID);
        $finalBalance = $db->getVar($query);

        //Getting Transactions
        $query = $db->prepare("SELECT t.addr, t.type, t.amount, t.balance, t.date FROM " . TABLE_USERS_BITCOIN_TRANSACTIONS_HISTORY . " t                                
                               WHERE t.userID=%d ORDER BY t.date DESC LIMIT %d, %d", $userID, ($page - 1) * $limit, $limit);

        $data = $db->getResultsArray($query);

        return [$totalCount, $finalBalance, $data];

    }

    /**
     * @param $userID
     * @return bool
     */
    private function _getTransactions($userID){
        global $db;

        $bitcoinInfo = BuckysUser::getUserBitcoinInfo($userID);

        //Getting User Last Transaction
        $query = $db->prepare("SELECT * FROM " . TABLE_USERS_BITCOIN_TRANSACTIONS_HISTORY . " WHERE userID=%d ORDER BY `date` DESC", $userID);
        $lastTrans = $db->getRow($query);

        $limit = 20;
        $offset = 0;

        do{
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_URL, 'https://blockchain.info/address/' . $bitcoinInfo['bitcoin_address'] . '?format=json&limit=' . $limit . '&offset=' . $offset);
            $return = curl_exec($ch);

            curl_close($ch);

            $returnData = json_decode($return);

            if(!$returnData){
                buckys_add_message("There was an error to get transactions: " . $return, MSG_TYPE_ERROR);
                return false;
            }

            if(isset($returnData->error)){
                buckys_add_message('There was an error to get transactions: ' . $returnData->error, MSG_TYPE_ERROR);
                return false;

            }else{
                $transactions = $returnData->txs;

                if(!$transactions){
                    $this->fixBalances($userID, !$lastTrans ? 0.0 : $lastTrans['balance']);
                    return true;
                }

                foreach($transactions as $trx){
                    if($lastTrans && $lastTrans['hash'] == $trx->hash){
                        $this->fixBalances($userID, !$lastTrans ? 0.0 : $lastTrans['balance']);
                        return true;
                    }

                    $row = [];

                    $row['userID'] = $userID;
                    $row['hash'] = $trx->hash;
                    $row['date'] = $trx->time;
                    $row['balance'] = -1.0;
                    $row['addr'] = [];
                    $row['amount'] = [];
                    $row['totalAmount'] = 0;

                    if($trx->inputs[0]->prev_out->addr != $bitcoinInfo['bitcoin_address']) //Received
                    {
                        $row['addr'][] = $trx->inputs[0]->prev_out->addr;

                        foreach($trx->out as $out){
                            if($out->addr == $bitcoinInfo['bitcoin_address']){
                                $row['amount'][] = intval($out->value);
                                $row['totalAmount'] += intval($out->value);
                            }
                        }

                        $row['type'] = 'received';
                    }else{
                        //Send Bitcoin
                        foreach($trx->out as $out){
                            if($out->addr != $bitcoinInfo['bitcoin_address']){
                                $row['addr'][] = $out->addr;
                                $row['amount'][] = -1 * intval($out->value);
                                $row['totalAmount'] += intval($out->value);
                            }
                        }

                        if(!$row['addr']) //It means that user sent it to himeself
                        {
                            $row['addr'][] = $trx->out[0]->addr;
                            $row['amount'][] = -1 * intval($trx->out[0]->value);
                            $row['totalAmount'] += 0;
                        }

                        $row['type'] = 'sent';
                        $row['totalAmount'] += ceil($trx->size / 1000) * 10000;
                    }

                    $row['addr'] = implode("\n", $row['addr']);
                    $row['amount'] = implode("\n", $row['amount']);

                    $db->insertFromArray(TABLE_USERS_BITCOIN_TRANSACTIONS_HISTORY, $row);

                }

                if(count($transactions) < $limit){
                    $this->fixBalances($userID, !$lastTrans ? 0.0 : $lastTrans['balance']);
                    return true;
                }
            }

            $offset += $limit;
        }while(1);

        return true;
    }

    /**
     * @param     $userID
     * @param int $balance
     */
    public function fixBalances($userID, $balance = 0){
        global $db;

        //Fix balanace
        //$query = $db->prepare("SELECT * FROM " . TABLE_USERS_BITCOIN_TRANSACTIONS_HISTORY . " WHERE userID=%d AND balance < 0 ORDER BY `date`", $userID);
        $query = $db->prepare("SELECT * FROM " . TABLE_USERS_BITCOIN_TRANSACTIONS_HISTORY . " WHERE userID=%d ORDER BY `date` ASC", $userID);
        $rows = $db->getResultsArray($query);

        $balance = 0;

        foreach($rows as $row){
            if($row['type'] == 'sent')
                $balance -= $row['totalAmount'];else
                $balance += $row['totalAmount'];

            $db->updateFromArray(TABLE_USERS_BITCOIN_TRANSACTIONS_HISTORY, ['balance' => $balance], ['transactionID' => $row['transactionID']]);
        }
    }

    /**
     * @param $addr
     * @return array
     */
    public function getUserInfoFromAddr($addr){
        global $db;

        $query = $db->prepare("SELECT u.userID, u.firstName, u.lastName FROM " . TABLE_USERS_BITCOIN . " AS ub LEFT JOIN " . TABLE_USERS . " AS u ON u.userID=ub.userID WHERE ub.bitcoin_address=%s", $addr);

        $row = $db->getRow($query);

        return $row;
    }

}