<?php 
	require 'db.php';

	$data = $_POST;
	if ( isset($data['do_login']) )
	{
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if ( $user )
		{
			//логин существует
			if ( password_verify($data['password'], $user->password) )
			{
				//если пароль совпадает, то нужно авторизовать пользователя
				$_SESSION['logged_user'] = $user;
				header("Location: https://linemail.sytes.net/testmail/index.php?inbox=0&page=0");
				//echo '<div style="color:green;">Вы авторизованы!<br/> Можете перейти на <a href="/testmail/">главную</a> страницу.</div><hr>';
			} else
			{
				$errors[] = 'Неверно введен пароль!';
			}

		} else
		{
			$errors[] = 'Пользователь с таким логином не найден!';
		}
		
		if ( !empty($errors) )
		{
			//выводим ошибки авторизации
			echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
		}

	}

?>


<link rel="stylesheet" href="css/style_in_out.css">
<div class="form_center">
	<form id="form1" action="/testmail/login.php" method="post">
		<fieldset>
			   <label for="login">Логин</label>
			   <input id="login" name="login" size="30" type="text" value="<?php echo @$data['login']; ?>"/>
			   <label for="password">Пароль</label>
			   <input id="password" name="password" size="30" type="password" value="<?php echo @$data['password']; ?>"/>
			   <button type="submit" name="do_login">Войти</button>
		</fieldset>


	</form>
</div>

	
