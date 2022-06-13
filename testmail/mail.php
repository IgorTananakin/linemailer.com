<?php
$start = microtime(true);
	require 'db.php';
	include 'function/function.php';
 include 'templete/header.php';//вернее меню


//входящие
$mbox = imap_open(list_folder()[0][0], "tananakinigor98@gmail.com", "uvogewkltnfpuwye")
or die("can't connect: " . imap_last_error());
$mail = $_GET['mail'];

$MC = imap_check($mbox);
$result1 = imap_search($mbox, 'FROM ' . $_GET['mail'] );
//var_dump($result1);
//отправленные письма 
$mbox1 = imap_open(list_folder()[1][0], "tananakinigor98@gmail.com", "uvogewkltnfpuwye")
or die("can't connect: " . imap_last_error());
$result2 = imap_search($mbox1, 'TO ' . $_GET['mail'] );
//var_dump($result2);


//			<?php

//массив входящие + отправленные
$mas_all_mail = [];
	foreach($result2 as $res => $value) {
		$header = imap_headerinfo($mbox1, $result2[$res]);
		$mail_id = $result2[$res];
		//$body = imap_fetchbody($mbox1, $mail_id,'1');
		$key =[
			'name' => 'send',
			'value' => $result2[$res],
			'date' => $header->udate//,
			//'body' => $body
		]; 
		array_push($mas_all_mail, $key);
	}
	foreach($result1 as $res => $value) {
		$header = imap_headerinfo($mbox, $result1[$res]);
		$mail_id = $result1[$res];
		//$body = imap_fetchbody($mbox, $mail_id,'1');
		$key =[
			'name' => 'incoming',
			'value' => $result1[$res],
			'date' => $header->udate//,
			//'body' => $body
		]; 
		array_push($mas_all_mail, $key);
	}
	
//var_dump($mas_all_mail);
//объекты созданные в массиве доступны из вне
usort($mas_all_mail, function($b,$a) { return ($a['date'] - $b['date']); } );//сортировка двух массивов
//$json_all_mail = json_encode($mas_all_mail);
//echo $json_all_mail;
//echo '<pre>';
//var_dump($mas_all_mail);
//echo '</pre>';

?>
<script type="text/javascript">
	var tempArray = <?php echo json_encode($mas_all_mail); ?>;
	
</script>
<?php
// Кол-во страниц 
$limit = 4;
$total = count($mas_all_mail);
$amt = ceil($total / $limit);
?>




<!--модальное окно-->
<div id="myModal1" class="modal1">
  <div class="modal-content1">
    <div class="modal-header1">
      <span class="close1">&times;</span>
      <h2>Выберите менеджера</h2>
    </div>
    <div class="modal-body1">
      <div class="menegers1  column">
		<!-- <form name="menegere" > -->
		<!-- action="menegere.php" method="post" -->
			<div class="column">
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<?php foreach($connection->all_users() as $row) { ?>
						<div class="row">
							<input type="radio" id="manager" name="id_manager" value="<?php echo $row['id']; ?>" atr_mail="<?php echo $row['login']; ?>">
							<input type="hidden" name="mail" value="<?php echo $_POST['mail']; ?>">
							<label for="manager"><?php echo $row['login']; ?></label>
						</div>


				<?php } ?>
			</div>
		
		  	<div class="action">
				<input type="submit" placeholder="Назначить менеджера"  atr-mail="<?php echo $_GET['mail']; ?>" class="menedger_btn" value="Назначить менеджера" >
			</div>
		<!-- </form> -->
		</div>
    </div>
    <div class="modal-footer1">
<!--      <h3>Футер модального окна</h3>-->
    </div>
  </div>
</div> 
<!--конец модального окна	  -->
	  
	  



<div class="prod-list ">
<div class="column" id="test" >
<?php
$i = 5;//так как массив отсортирован, то 1 элемент выводится самый последний, а нужно
foreach ($mas_all_mail as $key => $value) {
	//foreach ($mas_all_mail[$key] as $res => $value) {
	if ($key < 5) {
		if ($mas_all_mail[$i - $key]["name"] === 'incoming') {
?>

	<div class="messege left trg-left">
		<div class="msg_l left">
			<div class="column m-5">
				<div >
					<p class="body_msg_l"><?php echo quoted_printable_decode(imap_fetchbody($mbox, $mas_all_mail[$i - $key]['value'],'1'));?></p>
				</div>
				<div class="time_msg_l">
					<p><?php echo gmdate("Y-m-d\ H:i:s\ ", $mas_all_mail[$i - $key]['date']); ?></p>
				</div>
			</div>
		</div>
	</div>
<?php 
		} else if ($mas_all_mail[$i - $key]["name"] === 'send') {

?>

	<div class="messege right">
		<div class="msg_r right">
			<div class="column m-5">
				
				<p class="body_msg_r"><?php echo quoted_printable_decode(imap_fetchbody($mbox1, $mas_all_mail[$i - $key]['value'],'1'));?></p>
				<div class="time_msg">
					<p ><?php echo gmdate("Y-m-d\ H:i:s\ ", $mas_all_mail[$i - $key]['date']); ?></p>
				</div>
			</div>
		</div>
	</div>
<?php
		}
	//}

}	
}
?>

</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/scpipt_download.js"></script>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/chat.css">
	<link rel="stylesheet" href="css/modal_menedger.css">
	<link rel="stylesheet" href="css/modal_window.css">

	<link href="css/toast.min.css" rel="stylesheet">
  <script src="js/toast.min.js"></script>
	
	
			<?php //echo '<p>Итоговое время выполнения скрипта: '.round(microtime(true) - $start, 4).' сек.</p><br><br><br>'; ?>


	<div>
		
		<div class="form_chat">
			<!-- <form class="forms_send"> -->
			 <!-- action="../artisansweb/index2.php" method="post" -->
			<div class="forms_send">
				<div class="row">
					
					<input type="hidden" name="mail" value="<?php echo $mail; ?>">
					<input type="text" id="id_messege" name="text_messege" class="text_messege">
					<input type="submit" name="send" id="id_send_mail" class="send_mail" value="Отправить">
				</div>
			</div>
			<!-- </form> -->
<!--			<form class="forms_menedger" action="add_mail.php" method="post">-->
				<!--				раскоментить в случае чего-->
				<!-- <p>wqe</p> -->
				<div class="row" >
					<input type="hidden" name="mail" atr-mail-id="<?php echo $mail_id; ?>" value="<?php echo $mail_id; ?>">
					<input type="hidden" name="mail" atr-mail="<?php echo $mail; ?>" value="<?php echo $mail; ?>">
					<?php if($connection->is_admin($_SESSION['logged_user']->login)) { ?>

					<input type="submit" name="add_menege" id="show-modal2 myBtn1" class="btn_menadger" value="Назначить менеджеру" >
					
					<?php } ?>
				</div>
<!--			</form>-->
			<?php //echo '<br><br><br><br><br><br><p>Время выполнения скрипта: '.round(microtime(true) - $start, 4).' сек.</p>'; ?>
		</div>
	</div>	
<script src="js/script_event.js"></script>


