<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');

//Getting Publisher Ads
$query = "SELECT pa.*, b.bitcoin_address FROM " . TABLE_PUBLISHER_ADS . " AS pa LEFT JOIN " . TABLE_USERS_BITCOIN . " AS b ON b.userID=pa.publisherID WHERE pa.impressions > pa.paidImpressions";
$results = $db->getResultsArray($query);

$bitcoinClass = new BuckysBitcoin();
$classPublisherAds = new BuckysPublisherAds();

//$price_per_impression = ADS_PRICE_FOR_THOUSAND_IMPRESSIONS * ADS_PUBLISHER_PERCENTAGE / 1000;

foreach($results as $row){

    $userBalance = $classPublisherAds->getUserBalance($row['publisherID']);

    if($userBalance >= ADS_MINIMUM_PAYOUT_BALANCE){
        $amountToSend = $userBalance - BLOCKCHAIN_FEE;
        $paymentSend = $bitcoinClass->sendBitcoinFromBuckysroom($row['bitcoin_address'], $amountToSend);
        if($paymentSend){
            $db->update("UPDATE " . TABLE_PUBLISHER_ADS . " SET `paidImpressions`=`impressions` WHERE publisherID=" . $row['publisherID']);
        }
    }

    /*
    $unpaidImpressions = $row['impressions'] - $row['paidImpressions'];
    
    //0.00036 for every 1000 impressions
    $amount = $unpaidImpressions * $price_per_impression;
    if($amount < ADS_MINIMUM_PAYOUT_BALANCE)
        continue;
    
    $amount = $amount - BLOCKCHAIN_FEE;

    $bitcoinClass->sendBitcoinFromBuckysroom($row['bitcoin_address'], $amount);
    //Update PaidImpressions
    $db->update("UPDATE " . TABLE_PUBLISHER_ADS . " SET `paidImpressions`=`impressions`, `earnings` = `earnings` + " . $amount . " WHERE id=" . $row['id']);
    */

}