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
//$mails = imap_search($mbox, 'FROM testandrey98@gmail.com');
//var_dump($mails);

// Fetch an overview for all messages in INBOX
$result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
//foreach ($result as $overview) {
//	echo "<pre>";
//	var_dump($overview);
//	echo "</pre>";
//}
//var_dump($result);
$body = imap_fetchbody($mbox, 14,'1');


	//echo var_dump($body);
	//echo "<br>";
    $body = base64_decode($body);

echo $body;
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
					<a href="#" class="title_test">Менеджер</a>
				</div>
			</div>
			<div class="header_logout" class="title_test">Выход</div>
		</div>
		<div class="section_mail">
			<div class="nav">
				<div class="nav_menu">
					<button class="button">Написать</button>
<!--					<a href="">Входящие</a>-->
				</div>
				<ul>
					<li><a href="" class="li_test">testandrey98@gmail.com</a></li>
<!--					<li><a href="" class="li_test">Отправленные</a></li>-->
				</ul>
			</div>
			<div class="container_mail">
				<table class="table">
				<thead>
					<tr>
						<th>id</th>
						<th>Отправитель</th>
						<th>Тема письма</th>
						<th>Дата</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($result as $overview) {
						//if ($overview->msgno == $mails[0]) {?>
						<tr>
							<td><a href="https://linemail.sytes.net/testmail/mail.php?mail=<?php echo $overview->msgno; ?>"> <?php echo $overview->msgno; ?></a></td>
							<td><?php echo mb_decode_mimeheader($overview->from); ?></td>
							<td><?php echo mb_decode_mimeheader($overview->subject); ?></td>
							<td><?php  echo gmdate("Y-m-d\ H:i:s\ ", $overview->udate); ?></td>
						</tr>
					
					<?php }
					//} ?>
				</tbody>
			</table>
				
				
<!--
					<div>Отправитель</div>
					<div>Тема письма</div>
					<div>Дата</div>
-->
				
			</div>
		</div>
	</div>
</body>
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