<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//var_dump($_POST);
$mas = $_POST;
//var_dump(count($_POST));
$connection = new PDO('mysql:host=localhost;dbname=linemail1;charset=utf8', 'line', 'line12345');


$id_manager =  $_POST['id_manager'];
unset($mas['id_manager']);

//var_dump($mas);


//var_dump($data);
$dat = $connection->query("SELECT * FROM menagere WHERE menagere.id_user = " . $id_manager )->fetchAll(PDO::FETCH_ASSOC);
//var_dump($dat);
if (empty($dat)) {
	foreach ($mas as $key => $value) {
		$connection->exec('INSERT INTO menagere (id_user,id_email) VALUES ( ' . $id_manager . ', ' . $mas[$key] . ') ');
	}
	
} else {
	foreach ($mas as $key => $value) {
		$data = $connection->query("SELECT * FROM menagere WHERE menagere.id_user = " . $id_manager . " AND menagere.id_email = " . $mas[$key])->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($data);
		if ($data == false) {
			//echo "email_id нет в базе" . $mas[$key];
			$connection->exec('INSERT INTO menagere (id_user,id_email) VALUES ( ' . $id_manager . ', ' . $mas[$key] . ') ');
		}

	}
}
header("Location: https://linemail.sytes.net/testmail/add_contact.php"); /* Перенаправление браузера */





