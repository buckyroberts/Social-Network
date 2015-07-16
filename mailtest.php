<?php

require_once("./includes/phpMailer/class.phpmailer.php");

$mail = new PHPMailer();

$mail->SMTPSecure = 'ssl';
$mail->Port = SMTP_PORT;
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug = 2;

$mail->Host = SMTP_HOST;
$mail->Username = SMTP_USERNAME;
$mail->Password = SMTP_PASSWORD;

$mail->AddAddress(BUCKYSROOM_TEST_EMAIL, "Eric So");
$mail->SetFrom(BUCKYSROOM_TEST_EMAIL, 'Buckysroom');
$mail->Subject = "Testing Email";
$mail->Body = "Testing Email";
$mail->Send();
