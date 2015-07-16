<?php
/**
 * Trade ajax action handler
 */
require(dirname(__FILE__) . '/includes/bootstrap.php');

//----------------- Log functions -------------------------//

function logDataOnFile($varName, $var){

    ob_start();
    print_r($var);
    $result = ob_get_contents();
    ob_end_clean();

    $fp = fopen('paypal.log', 'a');
    if($fp){
        $result = '
' . '---------------' . $varName . '----------------' . '
' . $result . '
';
        fwrite($fp, $result);
        fclose($fp);
    }

}

//================= check if the paypal notification is that the payment has been made ====================

$log = '';

//Read config file
$paypalRequest = 'cmd=_notify-validate';

// go through each of the POSTed vars and add them to the variable
foreach($_POST as $key => $value){
    $value = urlencode(stripslashes($value));
    $paypalRequest .= "&$key=$value";
}

$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
if(TNB_PAYPAL_MODE_LIVE == false){
    $ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
}

curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $paypalRequest);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Connection: Close']);

// In wamp like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
// of the certificate as shown below.
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if(!($res = curl_exec($ch))){

    logDataOnFile('CH Error - ' . date('Y-m-d H:i:s'), curl_error($ch));
    curl_close($ch);
    exit;
}
curl_close($ch);

if(strcmp($res, "VERIFIED") == 0){

    $paymentStatus = $_POST['payment_status'];
    $paymentAmount = $_POST['mc_gross'];         //full amount of payment. payment_gross in US
    $paymentCurrency = $_POST['mc_currency'];
    $txnId = $_POST['txn_id'];                   //unique transaction id
    $receiverEmail = $_POST['receiver_email'];
    $payerEmail = $_POST['payer_email'];
    $paymentCustom = $_POST['custom']; //custom value will be credit number, you may use this one

    $sellerPaypalEmail = TNB_PAYPAL_EMAIL;
    if(TNB_PAYPAL_MODE_LIVE == false){
        $sellerPaypalEmail = TNB_PAYPAL_SANDBOX_EMAIL;
    }

    if($receiverEmail == $sellerPaypalEmail && // receiver_email should be same as site paypal account email
        $paymentCurrency == TNB_PAYPAL_CURRENCY // currency should be same
    ){
        if($paymentStatus == 'Completed'){  //payment_status = Completed)

            //Update payment status as paid :), means creating transactions
            // Create Transaction in transaction table

            $transactionIns = new BuckysTransaction();
            $data['userID'] = $paymentCustom;
            $data['payer_email'] = $payerEmail;
            $data['amount'] = $paymentAmount;
            $data['currency'] = $paymentCurrency;
            $data['trackNumber'] = $txnId;
            $transactionIns->addPaypalTransaction($data);

            //Send notification, you may send email to clients

        }else{
            //status is not complete, // if status is not complete, then log this status
            //payment_status can be one of the following
            //Canceled_Reversal: A reversal has been canceled. For example, you won a dispute with the customer, and the funds for
            //                           Completed the transaction that was reversed have been returned to you.
            //Completed:            The payment has been completed, and the funds have been added successfully to your account balance.
            //Denied:                 You denied the payment. This happens only if the payment was previously pending because of possible
            //                            reasons described for the PendingReason element.
            //Expired:                 This authorization has expired and cannot be captured.
            //Failed:                   The payment has failed. This happens only if the payment was made from your customer’s bank account.
            //Pending:                The payment is pending. See pending_reason for more information.
            //Refunded:              You refunded the payment.
            //Reversed:              A payment was reversed due to a chargeback or other type of reversal. The funds have been removed from
            //                          your account balance and returned to the buyer. The reason for the
            //                           reversal is specified in the ReasonCode element.
            //Processed:            A payment has been accepted.
            //Voided:                 This authorization has been voided.

            //Log status

            logDataOnFile('Status - ' . date('Y-m-d H:i:s'), 'status is not complete');
        }
    }

}else if(strcmp($res, "INVALID") == 0){

    // Paypal didnt like what we sent. If you start getting these after system was working ok in the past, check if Paypal has altered its IPN format
    // Something goes wrong

    logDataOnFile('Invalid - ' . date('Y-m-d H:i:s'), 'Paypal didnt like what we sent. If you start getting these after system was working ok in the past, check if Paypal has altered its IPN format');

}

exit;