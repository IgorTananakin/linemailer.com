<?php 
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
	require 'db.php';
	include 'function/function.php';

if ( isset ($_SESSION['logged_user']) ) {
$user_pag = [];//массив для пагинации у менеджеров 
$user_mail_pg1 = [];// массив для пагинации под менеджером
	
//var_dump($_SESSION['logged_user']);	
$mbox = mbox(get_inbox());	//function.php
	
$list = imap_list($mbox, "{imap.example.org}", "*");//получение всех папок в почте
//var_dump($list);
$MC = imap_check($mbox);

//вывод и запрос на всех админов
$row = $connection->all_admin();
$admin_mas = [];
foreach ($row as $arr => $value) {
	if (empty($admin_mas)) {
		array_push($admin_mas , $row[$arr]["login"]);
	}
}

$array = $connection->all_emails_in_menedger();


	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/modal_window.css">
</head>

<body>
	<div class="main">
		
		<?php include 'templete/header.php'//вернее меню?>
		
		<div class="section_mail">
			<div class="nav">
				<ul>
					<li class="row left_menu_li window__items">
						<a href="#" id="show-modal" class="button" >Написать</a>
						
					</li>
					<li class="row left_menu_li li_bg">
						<i class="fa fa-envelope left_icon" aria-hidden="true" ></i>
						<a href="https://linemail.sytes.net/testmail/index.php?inbox=0&page=0" class="li_test"><?php echo list_folder()[0][1];?></a>
					</li>
					<li class="row left_menu_li">
						<i class="fa fa-folder-o left_icon" aria-hidden="true" ></i>
						<a href="https://linemail.sytes.net/testmail/index.php?inbox=1&page=0" class="li_test"><?php echo list_folder()[1][1];?></a>
					</li>
					<li class="row left_menu_li">
						<i class="fa fa-address-book left_icon" aria-hidden="true" ></i>
						<a href="https://linemail.sytes.net/testmail/list_contact.php" class="li_test">Контакты</a>
					</li>
					
					<?php 
//					var_dump($row[0]["TRUE"]);
					if (1 == $is_admin) //$is_admin в header.php получил
					{
					foreach( $connection->menedger() as $user)  { ?>
					
					<li class="left_menu_li"><a href="https://linemail.sytes.net/testmail/index.php?inbox=0&menedger=<?php echo $user['login'];?>&page=0" class="li_test"><?php echo $user['login'];?></a></li>
					
					<?php 
						}
					} 
					?>
				</ul>
			</div>
			<div class="container">
				<div class="container_mail">
					<table class="table">
					<thead>
						<tr>
<!--							<th>id письма</th>-->
							<th>Отправитель</th>
							<th>Тема письма</th>
							<th>Дата</th>
							<?php if (($connection->is_admin($_SESSION['logged_user']->login) == 1) && (empty($_GET['menedger'])))  { ?>
								
							<th>Закреплён</th>
							<th>Действие</th>
							
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php 
							
							//получение всех почтовых адресов у менеджера
							$mas_email = [];//для преобразования (массив почтовых адресов)

							//массив почтовых ящиков для записи новых ящиков в базу
							$mas_imap_email = [];
	
							//проверка если не админ
							if(1 != $is_admin) {//если не админ	
								$mas_email = $connection->mas_email_in_menedger($_SESSION['logged_user']->id);
								
								
								//для пагинации 
								$user_mail_pg1 = user_mail_pg1($mas_email,$mbox);//получение всех писем менеджера в одном массиве
								
								//для пагинации менеджера
								$value1 = pagination_user(count($user_mail_pg1),$_GET['page']);
								$str = $value1->current(); //получение первого значения из функциии
								$value1->next();//переход ко второму значению из функциии
								$next_str = $value1->getReturn(); //получение второго значения из функциии
								$result1 = $user_mail_pg1;
								//конец преобразований для пагинации
									foreach($result1 as $res => $val) {
										if (($res >= $str) && ($res < $next_str)) { // условия пагинации
										

										$id_mail = $result1[$res];
										$header = imap_headerinfo($mbox, $id_mail);
										$fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;//отправитель
									?>
										<tr class="list_messege" mail="<?php echo $id_mail?>">
											

											<td class="list_messege" id="mail_id" mail="<?php echo $fromaddr;?>">
												<?php 
													$header = imap_headerinfo($mbox, $id_mail);
													$fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;//отправитель
													echo $fromaddr;
												?>
											</td>
											
											<td class="list_messege" id="mail_id" mail="<?php echo $fromaddr;?>">
												<?php
													echo mb_decode_mimeheader($header->subject) ;//заголовок
												?>
											</td>
											
											<td class="list_messege" id="mail_id" mail="<?php echo $fromaddr;?>">
												<?php  
													echo gmdate("Y-m-d\ H:i:s\ ", $header->udate);
												?>
											</td>
											
										</tr>

									<?php 
											} //end if
										} //endforeach $result1 
									//} //endforeach $mas_email


							} else if(1 == $is_admin) {


								$count_mail_id = $MC->Nmsgs;

								//для пагинации
								$value = pagination($count_mail_id);
								$count = $value->current(); //получение первого значения из функциии
								$value->next();//переход ко второму значению из функциии
								$count_next = $value->getReturn(); //получение второго значения из функциии

								$result = imap_fetch_overview($mbox,"$count:$count_next",0);//выгрузить всю почту
								$result = array_reverse($result);//самое последнее письмо 1

								//массив почтовых ящиков
								$mas_imap_email = [];
								
								if(!isset($_GET['menedger'])) {
									//echo "123";
								
								foreach ($result as $overview) {
									
									//получение отправителя
									$header = imap_headerinfo($mbox, $overview->msgno);
									$fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;
									?>

							<tr >
								
								<?php 

								if(!in_array($fromaddr,$mas_imap_email)) {
									array_push($mas_imap_email, $fromaddr);	
								}
									
									
									
									

								?>
								<td class="list_messege" id="mail_id" mail="<?php echo $fromaddr;?>"><?php echo $fromaddr; ?></td>
								<td class="list_messege" id="mail_id" mail="<?php echo $fromaddr;?>"><?php echo mb_decode_mimeheader($overview->subject); ?></td>
								<td class="list_messege" id="mail_id" mail="<?php echo  $fromaddr;?>"><?php  echo gmdate("Y-m-d\ H:i:s\ ", $overview->udate); ?></td>
								
								<td>
									<?php if (in_array($fromaddr, $connection->all_emails_in_menedger()) === true) { ?>
												
													<i class="fa fa-user-circle-o green" aria-hidden="true"><a href="https://linemail.sytes.net/testmail/list_contact.php"></a></i>
												
									<?php } else { ?>
												
													<i class="fa fa-user-circle-o" aria-hidden="true"><a href="https://linemail.sytes.net/testmail/list_contact.php"></a></i>
												
									<?php } ?>
								</td>
								<td class="delete_mail" >
									
									<i class="fa fa-times delete" aria-hidden="true" id="del_mail_id" mail_id="<?php echo $overview->msgno;?>"></i>
								</td>
								
								
								
							</tr>

						<?php 

								} } else if(isset($_GET['menedger'])) {
									$id_menedger = $connection->id_menedger_by_login($_GET['menedger']);
									$mas_email = $connection->mas_email_in_menedger($id_menedger);
									
									
									//для пагинации 
								$user_mail_pg1 = user_mail_pg1($mas_email,$mbox);//получение всех писем менеджера в одном массиве
								
								//для пагинации менеджера
								$value1 = pagination_user(count($user_mail_pg1),$_GET['page']);
								$str = $value1->current(); //получение первого значения из функциии
								$value1->next();//переход ко второму значению из функциии
								$next_str = $value1->getReturn(); //получение второго значения из функциии
								$result1 = $user_mail_pg1;
								//конец преобразований для пагинации
									
//									//перебор для получения всех почтовых адресов не админа
//								foreach ($mas_email as $mas => $value) {
//									$result1 = imap_search($mbox, 'FROM ' . $mas_email[$mas] );//массив id писем
									
									foreach($result1 as $res => $val) {
////										var_dump($result1[$res]);
//										//для пагинации у юзера в админе
//										if(!in_array($result1[$res],$user_pag)) {
//											array_push($user_pag, $result1[$res]);	
//										}
//										//конец действий для пагинации юзера в админе
										
										if (($res >= $str) && ($res < $next_str)) { // условия пагинации
										
										$id_mail = $result1[$res];
										$header = imap_headerinfo($mbox, $id_mail);
										$fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;//отправитель
									?>
										<tr class="list_messege" mail="<?php echo $id_mail?>">
											

											<td class="list_messege" id="mail_id" mail="<?php echo $fromaddr;?>">
												<?php 
													$header = imap_headerinfo($mbox, $id_mail);
													$fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;//отправитель
													echo $fromaddr;
												?>
											</td>
											
											<td class="list_messege" id="mail_id" mail="<?php echo $fromaddr;?>">
												<?php
													echo mb_decode_mimeheader($header->subject) ;//заголовок
												?>
											</td>
											
											<td class="list_messege" id="mail_id" mail="<?php echo $fromaddr;?>">
												<?php  
													echo gmdate("Y-m-d\ H:i:s\ ", $header->udate);
												?>
											</td>
											
										</tr>

									<?php 
											}//end if
										} //endforeach $result1 
									//} //endforeach $mas_email
									
									
									
									
									
									
									
								}
									
									
									//получить всю почту
									$dat = $connection->all_contact();
									//массив контактов
									$mas_contacs = [];
									foreach($dat as $row => $value) {
											//запись в массив контактов
											array_push($mas_contacs, $dat[$row]["email"]);
									}
									//запись в массив $result почты которой нет
									$result = array_diff($mas_imap_email,$mas_contacs);
									//перебор для записи
									foreach($result as $res => $val) {
										$connection->exec('INSERT INTO contacs (email) VALUES ( "' . $result[$res] . '") ');
									}
							}
						?>
					</tbody>
				</table>
				</div>
				
				
					<div class="pagination">
						<a href="#" class="pag next round l">&#8249;</a>
						<?php 
							//количество для пагинации юзеров в админе
							$count_user_pag = count($user_pag);
							// если админ и не на вкладке просмотра менеджеров
							if (($connection->is_admin($_SESSION['logged_user']->login) == 1) && (!isset($_GET['menedger'])) ) {
								$page = ceil($count_mail_id / 20);
								for ($i = 0; $i < $page; $i++) { ?>
									
									<a class="pag_" href="https://linemail.sytes.net/testmail/index.php?inbox=<?php echo get_inbox();?>&page=<?php echo $i ;?>">
									<?php echo $i+1;?>
									</a>
									
							<?php } 
								//var_dump($MC);
							
							} else if(isset($_GET['menedger']) ) { // админ на вкладке менеджеров
								$page = ceil(count($user_mail_pg1) / 20);
								for ($i = 0; $i < $page; $i++) { ?>
						
								<a class="pag_" href="https://linemail.sytes.net/testmail/index.php?inbox=0&menedger=andr@mail.ru&page=<?php echo $i+1 ;?>">
									<?php echo $i+1;?>
								</a>
							<?php }
							} else if(($connection->is_admin($_SESSION['logged_user']->login) == 0)) { // только менеджер
								
								$page = ceil(count($user_mail_pg1) / 20);
								
								for ($i = 1; $i < $page; $i++) { ?>
						
									<a class="pag_" href="https://linemail.sytes.net/testmail/index.php?inbox=0&page=<?php echo $i ;?>">
										<?php echo $i;?>
									</a>
							<?php }
							}
							

//							for ($i = 0; $i < $page; $i++) { 

						?>
								
						<?php // } ?>
						<a href="#" class="pag next round r">&#8250;</a>
					</div>
				
				
			</div>
		</div>
	</div>
</body>
</html>
<script src="js/script_event.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" async></script>

<link href="css/toast.min.css" rel="stylesheet">
<script src="js/toast.min.js"></script>
<?php
						
} else {
	header("Location: https://linemail.sytes.net/testmail/login.php");
	//если не авторизован
}
	// end if isset ($_SESSION['logged_user'])


imap_close($mbox);?>