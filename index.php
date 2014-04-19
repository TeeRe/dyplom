<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
if (isset($_GET['logout']))
{
	if (isset($_SESSION['user_id']))
		{
		unset($_SESSION['user_id']);
		unset($_SESSION['password']);
		unset($_SESSION['login']);
		}	
	setcookie('login', '', 0, "/");
	setcookie('password', '', 0, "/");
	header('Location: index.php');
	exit;
};
?>

<!DOCTYPE HTML>
<html>
	<head>
		<link href="css/jquery.ui.all.css" rel="stylesheet" type="text/css">

		<script src="js/jquery-1.9.1.js"></script>
		<script src="js/ui/jquery.ui.core.js"></script>
    	<script src="js/ui/jquery.ui.position.js"></script>
    	<script src="js/ui/jquery.ui.widget.js"></script>
		<script src="js/ui/jquery.ui.button.js"></script>
		<script src="js/ui/jquery.ui.tabs.js"></script>
		<script src="js/ui/jquery.ui.tooltip.js"></script>

		<link href="css/design.css" rel="stylesheet" type="text/css">
		<script src="js/other.js"></script>
		<script src="js/script.js"></script>

		<title>Главная</title>
	</head>

	<body>

	<a class="page_up ui-corner-all" href="javascript:void(0);" onclick="scroll(0,0);"></a>
	<a class="page_up page_center ui-corner-all" href="javascript:void(0);"></a>
	<a class="page_up page_down ui-corner-all" href="javascript:void(0);" onclick="scroll(0,100000);"></a>
	
		<div id="container">
			<?php include('index/header.php'); ?>

			<div id="content" class="tabs">
			  <ul>
			    <li><a href="index/news.php">Новости</a></li>
			    <li><a href="index/best24.php">Лучшее за сутки</a></li>
			    <li><a href="index/last.php">Последние добавленные</a></li>
			  </ul>
			</div>

			<div id="footer" class="ui-corner-all">Медведчук Александр Юрьевич. Дипломная работа</div>
		</div>
	</body>
</html>