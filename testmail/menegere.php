<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require 'db.php';
include 'function/function.php';

$dat = $connection->check_menedger_mail($_POST["id_manager"],$_POST['insert_mail']);

if (empty($dat) && isset($dat)) {
	$insert_mail = $_POST['insert_mail'];
	$id_email = $connection->id_email($insert_mail);
	
	 $connection->exec('INSERT INTO menagere (id_user,id_email) VALUES ( ' . $_POST['id_manager'] . ', ' . $id_email[0]['id'] . ') ');
	$insert = "true";
	echo json_encode($insert);
	//header("Location: https://linemail.sytes.net/testmail/mail.php?mail=$insert_mail");
} else {
	$insert = "false";
	echo json_encode($insert);
	//header("Location: https://linemail.sytes.net/testmail/mail.php?mail=$insert_mail");
}