<?php
	require 'db.php';
	include 'function/function.php';
var_dump($_POST);
//var_dump($_GET[]);
$mbox = mbox(0);
$to_address = "tananakinigor98@gmail.com";       
         $from_address = "tananakinigor98@gmail.com";
         $subject = $_POST['text_messege'];
         $cc = "tananakinigor98@gmail.com";
         $bcc = "tananakinigor98@gmail.com";
         $rpath = "return_path";
         
         //Sending a mail
         $res =  imap_mail($to_address, $from_address, $subject, $cc, $bcc, $rpath);
         if($res){
            print("Mail sent successfully");
         } else {
            print("Error Occurred");
         }

//imap_mail("tananakin.tank@yandex.ru", "tananakin.tank@yandex.ru", $_POST["mail"]);
//https://linemail.sytes.net/testmail/mail.php?mail_id=80&mail=support@noip.com

$mail = $_POST['mail'];
$mas = imap_search($mbox, 'FROM ' . $mail );
header("Location: https://linemail.sytes.net/testmail/mail.php?mail_id=$mas[0]&mail=$mail");
exit;

//$to = "tananakin.tank@yandex.ru";
//$subject = "Тема письма";
//$mailheaders = "Content-type:text/html;charset=utf-8";
//$mailheaders .= "From: SiteRobot <tananakin.tank@yandex.ru>rn";
//$mailheaders .= "Reply-To: tananakin.tank@yandex.rurn";
//mail($to, $subject, $_POST['text_messege'], $mailheaders);