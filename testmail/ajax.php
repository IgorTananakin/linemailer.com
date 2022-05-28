<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$mbox = imap_open("{imap.gmail.com:993/ssl/novalidate-cert}INBOX", "tananakinigor98@gmail.com", "uvogewkltnfpuwye")
or die("can't connect: " . imap_last_error());

// C какой позиции будет осуществляться вывод
$startFrom = $_POST['startFrom'];
$mas = $_POST['mas'];
$count_mas = count($mas);

$new_mas = [];


$body = quoted_printable_decode(imap_fetchbody($mbox, $mas[$startFrom]['value'],'1'));
$mas[$startFrom]['value'] = $body;
$mas[$startFrom]['date'] = date('Y-m-d\ H:i:s\ ', $mas[$startFrom]['date']);
$new_mas = [ $startFrom=>[
				'name' => $mas[$startFrom]['name'],
				'value' => $body,
				'date' => $mas[$startFrom]['date']
			] 
		   ];



echo json_encode($new_mas);


