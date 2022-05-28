<?php
//testandrey98@gmail.com
//joebpcvhzxiobhbr

//tananakinigor98@gmail.com
//uvogewkltnfpuwye
//$mbox = imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX", "tananakinigor98@gmail.com", "uvogewkltnfpuwye")
//or die("can't connect: " . imap_last_error());

$mbox = imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX", "tananakinigor98@gmail.com", "uvogewkltnfpuwye")
or die("can't connect: " . imap_last_error());

$MC = imap_check($mbox);
//$mails = imap_search($mbox, 'TEXT hello');
$mails = imap_search($mbox, 'FROM testandrey98@gmail.com');
//var_dump($mails);

// Fetch an overview for all messages in INBOX
$result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
//foreach ($result as $overview) {
//	echo "<pre>";
//	var_dump($overview);
//	echo "</pre>";
//}
//var_dump($result);
$body = imap_fetchbody($mbox, 194,'1');


	//echo var_dump($body);
	//echo "<br>";
    //$body = base64_decode($body);// в случае кодировки использовать

//echo $body;
//echo "<div class='faq-tile'>" . $body . "</div>";
//var_dump( imap_fetchbody($mbox,1,1.1));
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
	<link rel="stylesheet" href="css/main.css">
</head>

<body>
	<div class="main">
		<div class="header">
			<div class="header_title">
				<div class="title">
					<a href="#" class="title_test">Email</a>

				</div>
				<div class="title">
					<a href="#" class="title_test">Контакты</a>
				</div>
			</div>
			<div class="header_logout" class="title_test">Выход</div>
		</div>
		<div class="section_mail">
			<div class="nav">
<!--
				<div class="nav_menu">
					<button class="button">Написать</button>
					<a href="">Входящие</a>
				</div>
-->
				<ul>
					<li><a href="" class="li_test">Входящие</a></li>
					<li><a href="" class="li_test">Отправленные</a></li>
				</ul>
			</div>
			<div class="">
				
				<div><?php $mails = imap_search($mbox, 'FROM tananakinigor98@gmail.com');
					 //var_dump($mails);
					foreach ($mails as $mail) {
						$body = imap_fetchbody($mbox, $mail,'1');
						//echo $body;
						echo '<div class="mes">
								<p>' . $body . '</p>
							 </div>';
					}
					
					?>
					
				</div>
				
				<form enctype="multipart/form-data" method="post" id="form" onsubmit="send(event, 'send.php')">
					<div class="containier_messege">
						<input type="text" name="text" placeholder="Сообщение" class="messege">
<!--						<input type="file" class="visually-hidden" name="myfile[]" multiple id="myfile">-->

						<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

						<div class="example-1">
						  <div class="form-group">
							<label class="label">
							  <i class="material-icons">attach_file</i>
<!--							  <span class="title">Прикрепить</span>-->
							  <input type="file" name="myfile[]" multiple id="myfile">
							</label>
						  </div>
						</div>

						<input value="Отправить" type="submit" class="btn">
					</div>
				</form>
				
				
				
				
<!--
					<div>Отправитель</div>
					<div>Тема письма</div>
					<div>Дата</div>
-->
				
			</div>
		</div>
	</div>
</body>
<script>
function send(event, php){
console.log("Отправка запроса");
event.preventDefault ? event.preventDefault() : event.returnValue = false;
var req = new XMLHttpRequest();
req.open('POST', php, true);
req.onload = function() {
	if (req.status >= 200 && req.status < 400) {
		json = JSON.parse(this.response); // Ебанный internet explorer 11
    	console.log(json);
        
    	// ЗДЕСЬ УКАЗЫВАЕМ ДЕЙСТВИЯ В СЛУЧАЕ УСПЕХА ИЛИ НЕУДАЧИ
    	if (json.result == "success") {
    		// Если сообщение отправлено
    		alert("Сообщение отправлено");
    	} else {
    		// Если произошла ошибка
    		alert("Ошибка. Сообщение не отправлено");
    	}
    // Если не удалось связаться с php файлом
    } else {alert("Ошибка сервера. Номер: "+req.status);}}; 

// Если не удалось отправить запрос. Стоит блок на хостинге
req.onerror = function() {alert("Ошибка отправки запроса");};
req.send(new FormData(event.target));
}
</script>
</html>
<?

//$imap = imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX", "tananakinigor98@gmail.com", "uvogewkltnfpuwye" ) or die("Error:" . imap_last_error());
////var_dump($imap1 );
////$imap = imap_open("{imap.server.ru:993/imap/ssl}INBOX", "tananakinigor98@gmail.com", "uvogewkltnfpuwye");
//$mails_id = imap_search($imap, '');
//var_dump($mails_id);
// //var_dump($imap);
//foreach ($mails_id as $num) {
//	// Заголовок письма
//	$header = imap_header($imap, $num);
//	var_dump($header);
// 
//	// Тело письма
//	$body = imap_body($imap, $num);
//	var_dump($body);
//}
// 
//imap_close($imap);