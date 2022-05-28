<?php
//var_dump($_POST);
	require 'db.php';
	include 'function/function.php';

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="css/main.css">
<!--	<link rel="stylesheet" href="css/chat.css">-->
<title>Документ без названия</title>
</head>

<body>
	<?php  include 'templete/header.php';//вернее меню?>
	<div class="row">
		<div class="menegers  column">
		<form action="menegere.php" method="post">
			<h2>Менеджер</h2>
			<div class="column">
				<?php //$connection = new PDO('mysql:host=localhost;dbname=linemail1;charset=utf8', 'line', 'line12345');
					//вывод менеджеров
						foreach($connection->query('SELECT * FROM users') as $row) { ?>
						<div class="row">
							<input type="checkbox" id="manager" name="id_manager" value="<?php echo $row['id']; ?>">
							<input type="hidden" name="mail" value="<?php echo $_POST['mail']; ?>">
							<label for="manager"><?php echo $row['login']; ?></label>
						</div>


				<?php } ?>
			</div>
		</div>
		
			<div class="action">
				<input type="submit" placeholder="Назначить менеджера" class="send" value="Назначить менеджера" >
			</div>
		</form>
	</div>
</body>
</html>