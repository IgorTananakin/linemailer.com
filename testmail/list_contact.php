<?php 
	require 'db.php';
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
		
		<div class="section_mail">
			<table class="table_list">
				<thead>
					<tr>
						<th>Менеджер</th>
						<th>Закреплённые ящики</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						
						if (1 == $connection->is_admin($_SESSION['logged_user']->login)) //если админ
						{
							$user = $connection->all_users();//вывод всех
						} else {
							$user = $connection->array_menedger_by_login($_SESSION['logged_user']->login);//вывод только себя
						}
						foreach($user as $row) {
					?>
					<tr>
						
						<td><?php echo $row['login'];?></td>
						<td>
							<div class="row wrap">
								<?php 	
									
									//SELECT * FROM menagere INNER JOIN contacs ON contacs.id = menagere.id_email WHERE menagere.id_user = 1
									foreach($connection->all_email_for_one_menedger($row['id']) as $email) {

								?>
										<div class="text_margin "><?php echo "<p class='text_msg'>" . $email['email'] . "</p>";?></div>

								<?php 
											}
									
								?>
							</div>
						</td>
					</tr>
					<?php } ?>
					
				</tbody>
			</table>
			
		</div>
	</div>
</body>
</html>
<?


