<div class="header">
			<div class="header_title">
				<div class="title">
					<a href="https://linemail.sytes.net/testmail/index.php?inbox=0" class="title_test">Вся почта</a>

				</div>
				<div class="title">
					<a href="https://linemail.sytes.net/testmail/list_contact.php" class="title_test">Контакты</a>
				</div>
				<?php 
					$is_admin = $connection->is_admin($_SESSION['logged_user']->login);

						if (1 == $is_admin) { //если админ
				?>
				<!-- <div class="title">
					<a href="https://linemail.sytes.net/testmail/add_contact.php" class="title_test">Добавить почту менеджеру</a>
				</div> -->
				<?php
						}
				?>
				
			</div>
			<div class="header_logout" class="title_test">
				
				<?php if ( isset ($_SESSION['logged_user']) ) : 
						echo $_SESSION['logged_user']->login; ?>
				
						<a href="logout.php">Выйти</a>
				
				<?php else : ?>
				
						<a href="/testmail/login.php" class="menu_title">Авторизация</a>
						<a href="/testmail/signup.php" class="menu_title">Регистрация</a>
				
				<?php endif; ?>
				
			</div>
		</div>