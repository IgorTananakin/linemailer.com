<?php
class BD extends PDO{
	
	//получение всех админов
	public function all_admin(){
		return $this->query('SELECT * FROM users WHERE users.key_admin = "admin" ')->fetchAll(PDO::FETCH_ASSOC);
	}
	
	//если админ то 1
	public function is_admin($login){
		return $this->query('SELECT TRUE FROM users WHERE users.login = "' . $login . '" 
							AND users.key_admin = "admin"')->fetchAll(PDO::FETCH_ASSOC)[0]["TRUE"];
	}
	
	//получение всех контактов
	public function all_contact() {
		return $this->query('SELECT * FROM contacs')->fetchAll(PDO::FETCH_ASSOC);
	}
	
	//получить менеджеров
	public function menedger() {
		return $this->query('SELECT * FROM users WHERE users.key_admin = "NULL" ')->fetchAll(PDO::FETCH_ASSOC);
	}
	
	//получить все почтовые ящики у конкретного менеджера
	public function all_email_for_one_menedger($id_menedger) {
		
		return $this->query('SELECT email FROM menagere 
							INNER JOIN contacs ON contacs.id = menagere.id_email
							WHERE menagere.id_user = ' . $id_menedger )->fetchAll(PDO::FETCH_ASSOC);
	}
	
	//получить id менеджера или админа по его логину
	public function id_menedger_by_login($login) {
		var_dump($login);
		$test = 'SELECT id FROM users WHERE login = "' . $login . ' " ';
		var_dump($test);
		return $this->query($test)->fetchAll(PDO::FETCH_ASSOC)[0]['id'];
	}

	//получить массив менеджера по его логину
	public function array_menedger_by_login($login) {
		return $this->query('SELECT * FROM users WHERE login = "' . $login . ' " ')->fetchAll(PDO::FETCH_ASSOC);
	}
	
	//получить массив почтовых ящиков
	public function mas_email_in_menedger($id_menedger) {
		$mas_email = [];//для преобразования (массив почтовых адресов)
		//var_dump($id_menedger);
		$emails = $this->all_email_for_one_menedger($id_menedger);
		// var_dump($emails);
		foreach ($emails as $email) {
			array_push($mas_email, $email["email"]);//преобразование в один массив
		}
		return $mas_email;
	}
	
	//получить всех из users
	public function all_users() {
		return $this->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
	}
	
	
	//получить все закреплённые ящики за всеми менеджерами
	public function all_emails_in_menedger() {
		$mas = [];
		$all_emails_in_menedger =  $this->query('SELECT contacs.email FROM contacs 
												 INNER JOIN menagere ON menagere.id_email = contacs.id 
												 INNER JOIN users ON users.id = menagere.id_user 
												 WHERE users.key_admin = "NULL" 
												 GROUP BY contacs.email')->fetchAll(PDO::FETCH_ASSOC);
		foreach ($all_emails_in_menedger as $row => $value) {
			array_push($mas, $all_emails_in_menedger[$row]["email"]);	
		}
		
//		$mass = [];
//		foreach ($mas as $row ) {
//			array_push($mass, $row[$key]);
//		}
		return $mas;
	}
	
	//проверка на существования закреплённого ящика
	public function check_menedger_mail ($id_menadger, $mail) {
		return $this->query("SELECT * FROM menagere 
							INNER JOIN contacs ON contacs.id = menagere.id_email
							WHERE menagere.id_user = " . $id_menadger . " AND contacs.email = '" . $mail . "'")->fetchAll(PDO::FETCH_ASSOC);
		//return $id_menadger;
	}
	
	//получение id_email for insert
	public function id_email ($email) {
		
		return $this->query("SELECT * FROM contacs WHERE email = '" . $email . "'")->fetchAll(PDO::FETCH_ASSOC);
	}
	// //получение id_email for insert
	// public function id_email ($id_email) {
	// 	return $this->query("SELECT * FROM contacs WHERE email = '" . $id_email . "'")->fetchAll(PDO::FETCH_ASSOC);
	// }
	
	
	
	
	
	
}
////$connection = new BD('mysql:host=localhost;dbname=linemail1;charset=utf8', 'line', 'line12345');
//$connection1 = new BD('mysql:host=localhost;dbname=linemail1;charset=utf8', 'line', 'line12345');
//$row = $connection1->query('SELECT * FROM users WHERE users.key_admin = "admin" ')->fetchAll(PDO::FETCH_ASSOC);
////$row = $connection->query('SELECT * FROM users WHERE users.key_admin = "admin" ')->fetchAll(PDO::FETCH_ASSOC);
//var_dump($connection1->is_admin());