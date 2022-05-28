<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;
 
 
require_once 'vendor/autoload.php';
require_once 'class-db.php';
//"config": { "platform-check": false },

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
 
//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
 
$mail->SMTPAuth = true;
$mail->AuthType = 'XOAUTH2';
 
$email = 'tananakinigor98@gmail.com'; // the email used to register google app
$clientId = '223749374368-27sbjsm05ifnuetbhmrvcomncqrt4dln.apps.googleusercontent.com';
$clientSecret = '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';
 
$db = new DB();
$refreshToken = $db->get_refersh_token();
 
//Create a new OAuth2 provider instance
$provider = new Google(
    [
        'clientId' => $clientId,
        'clientSecret' => $clientSecret,
    ]
);
 
//Pass the OAuth provider instance to PHPMailer
$mail->setOAuth(
    new OAuth(
        [
            'provider' => $provider,
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'refreshToken' => $refreshToken,
            'userName' => $email,
        ]
    )
);
 
$mail->setFrom($email, 'tananakinigor98@gmail.com');
$mail->addAddress('tananakinigor98@gmail.com', 'RECIPIENT_NAME');
$mail->isHTML(true);
$mail->Subject = 'Email Subject';
$mail->Body = '<b>Email Body</b>';
 
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}