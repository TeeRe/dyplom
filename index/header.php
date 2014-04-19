<?php if (isset($_SESSION['user_id']))
{
	echo '
	<div id="header" class="ui-corner-all">
		<ul>
				<li><a class="home" href="index.php">Главная</a></li>
				<li><a class="boards" href="boards.php">Доски</a></li>
				<li><a class="messages" href="mail.php">Сообщения</a></li>
				<li><a class="page" href="page.php">Моя страница</a></li>
				<li><a class="settings" href="settings.php">Настройки</a></li>
				<li>
				<form method="get" action="search.php">
					<input name="q" class="search_area ui-corner-all if-login" type="text" placeholder="Поиск…" autocomplete="off"> 
					<button class="search" type="submit">Поиск</button>
				</form>
				</li>
				<li><a class="exit" href="index.php?logout">Выход</a></li>
		</ul>
	</div>
	';
}
else
{
	echo '
	<div id="header" class="ui-corner-all">
		<ul>
			<li><a class="home" href="index.php">Главная</a></li>
			<li><a class="boards" href="boards.php">Доски</a></li>
			<li>
			<form method="get" action="search.php">
				<input name="q" class="search_area ui-corner-all if-login" type="text" placeholder="Поиск…" autocomplete="off"> 
				<button class="search" type="submit">Поиск</button>
			</form>
			</li>
			<li><a class="register" href="register.php">Регистрация</a></li>
			<li><a class="login" href="signup.php">Вход</a></li>
		</ul>
	</div>
	';
}
?>