<?php 
	require 'db.php';
?>


<?php
//testandrey98@gmail.com
//joebpcvhzxiobhbr

//tananakinigor98@gmail.com
//uvogewkltnfpuwye
//$mbox = imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX", "tananakinigor98@gmail.com", "uvogewkltnfpuwye")
//or die("can't connect: " . imap_last_error());

//var_dump($_SESSION);
if ( isset ($_SESSION['logged_user']) ) {
	$row = $connection->query('SELECT * FROM users WHERE users.key_admin = "admin" ')->fetchAll(PDO::FETCH_ASSOC);
	if($_SESSION['logged_user']->login === $row[0]["login"]) {									 
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
		
		<?php include 'templete/header.php'//вернее меню?>
		
		<div class="section_mail bg_white">
			
			<form action="add_menager_mail.php" method="POST">
				<div class="container_row">
					<div class="menegers  column">
						<h2>Менеджер</h2>
						<div class="column">
							<?php //$connection = new PDO('mysql:host=localhost;dbname=linemail1;charset=utf8', 'line', 'line12345');
								//вывод менеджеров
									foreach($connection->query('SELECT * FROM users') as $row) { ?>
									<div class="row">
										<input type="checkbox" id="manager" name="id_manager" value="<?php echo $row['id']; ?>">
										<label for="manager"><?php echo $row['login']; ?></label>
									</div>
								

							<?php } ?>
						</div>
					</div>
					<div class="emails ">
						<h2>Ящики</h2>
						
							<?php 
						$i = 1;
						$arr = [];
							//вывод почтовых ящиков
							foreach($connection->query('SELECT * FROM contacs') as $email) { 
						
						 
						?>
							<div class="row">
								<input type="checkbox" id="email" name="<?php echo $i;?>" value="<?php echo $email['id']; ?>">
								<label for="email"><?php echo $email['email']; ?></label>
							</div>
							<?php 
							$i = $i + 1;
								
							} ?>
						
					</div>
					<div class="action ">
						<input type="submit" placeholder="Добавить" class="send" value="Добавить ящик" >
					</div>
					
				</div>
				
			</form>
		</div>
	</div>
</body>
</html>
<?
	} else  header("Location: https://linemail.sytes.net/testmail/");
} else  header("Location: https://linemail.sytes.net/testmail/");
