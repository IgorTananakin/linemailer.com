<?php
//для пагинации
function pagination($count_mail_id) {
	$page = $_GET['page'];

	if (($page == 0) || ($page < 0)) {

		$count = $count_mail_id;
		$count_next = $count_mail_id - 20;

	} if ($page > 0) {

		$count = $count_mail_id - ($page * 20);
		$count_next = $count - 20;

	}

	if ($count < 20) {
		$page = $page - 1;
		
		//$count = ($count_mail_id - ($page * 20)) - 20;
		
		$count = $count_mail_id - ($page * 20);
		$count_next = 1;

	} 

	yield  $count;
	return $count_next;

}
//пагинация для менеджера
function pagination_user($count_user_pg1,$page) {
	if ($count_user_pg1 > 21) {
		if ($page <= 1) {
			$str = 0;
			$next_str = 20;
		}  else if ($page > 1) {
			$str = ($page - 1) * 20;
			$next_str = $page * 20;
			if ( ($count_user_pg1 < $next_str) || ($count_user_pg1 < $str)) {
				$str = (ceil($count_user_pg1/20) - 1) * 20;
				$next_str = $count_user_pg1;
			}
		}
	} else if ( ($count_user_pg1 < 21) && ($count_user_pg1 >= 1) ) {
		$str = 1;
		$next_str = 21;
	} else if ($count_user_pg1 < 1) {
		$str = 0;
		$next_str = 0;
	}
	yield $str;
	return $next_str;
}
//получение всех писем менеджера в одном массиве
function user_mail_pg1($mas_email,$mbox) {
	$user_mail_pg1 = [];
	//перебор для получения всех почтовых адресов не админа
	foreach ($mas_email as $mas => $value) {
		$result1 = imap_search($mbox, 'FROM ' . $mas_email[$mas] );//массив id писем
//		var_dump($result1);
		foreach ($result1 as $res => $value) {
				if ($result1 !== false) {
					if(!in_array($result1[$res],$user_mail_pg1)) {
						array_push($user_mail_pg1, $result1[$res]);	
					}
				}
			}
		
	}
	
	return $user_mail_pg1;
}
//для получение папки
function list_folder(){
	$list_folder = [ 
				 ["{imap.gmail.com:993/ssl/novalidate-cert}INBOX", "Входящие"],//входящие
				 ["{imap.gmail.com:993/ssl/novalidate-cert}[Gmail]/&BB4EQgQ,BEAEMAQyBDsENQQ9BD0ESwQ1-","Отправленные"],//отправленные
			     ["{imap.example.org}Notes","Заметки"]
	];
	
	return $list_folder;
}
//подключение imap
function mbox($inbox = 0) {
	$list = list_folder();
	
	$mbox = imap_open($list[$inbox][0], "tananakinigor98@gmail.com", "uvogewkltnfpuwye") ;	
	
	return $mbox;
}
//получение параметра для подключения к какой папке подключаться
function get_inbox() {
//	if (!isset($_GET['inbox'])){
//		$inbox = 0;
//	} else {
		$inbox = $_GET['inbox'];
//	}
	
	return $inbox;
}
//
function menadger() {
	
}

?>


	
