<?php 
session_start();
include('mysql.php');
header('Content-Type: text/html; charset=utf-8');

if (!isset($_SESSION['user_id']))
{
	if (isset($_COOKIE['login']) && isset($_COOKIE['password']))
	{
		$login = mysql_escape_string($_COOKIE['login']);
		$password = mysql_escape_string($_COOKIE['password']);
		$query = "SELECT id, login FROM `users`	WHERE `login`='{$login}' AND `password`='{$password}' LIMIT 1";
		$sql = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($sql) == 1)
		{
			$row = mysql_fetch_assoc($sql);
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['login'] = $row['login'];
		}
        header('Location: signup.php');
        exit;
	}
	header('Location: signup.php');
    exit;
};

$add_feed_visible_change = (isset($_POST['add-feed-visible-change'])) ? mysql_real_escape_string($_POST['add-feed-visible-change']) : '';
if (!empty($add_feed_visible_change))
{
    // mysql_query("INSERT INTO `settings` (`uid`, `add-feed-visible`) VALUES ('$_SESSION[user_id]', '$add_feed_visible_change')");
    // UPDATE  `settings` SET  `add-feed-visible` =  '$add_feed_visible_change' WHERE `uid` = '$_SESSION[user_id]';
    mysql_query("UPDATE `settings` SET `add-feed-visible` = '$add_feed_visible_change' WHERE `uid` = '$_SESSION[user_id]'");
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <link href="css/jquery.ui.all.css" rel="stylesheet" type="text/css" />

        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/ui/jquery.ui.core.js"></script>
        <script src="js/ui/jquery.ui.position.js"></script>
        <script src="js/ui/jquery.ui.widget.js"></script>
        <script src="js/ui/jquery.ui.button.js"></script>
        <script src="js/ui/jquery.ui.tabs.js"></script>
        <script src="js/ui/jquery.ui.tooltip.js"></script>
        <script src="js/ui/jquery.ui.datepicker.js"></script>
        <script src="js/ui/jquery.ui.datepicker-ru.js"></script>
    	<script src="js/jquery.form.js"></script>
        
        <script src="js/script.js"></script>
        <script src="js/other.js"></script>
        <link href="css/design.css" rel="stylesheet" type="text/css" />

        <link href="settings/settings.css" rel="stylesheet" type="text/css" />

    	<title>Настройки</title>
    </head>

<body>

<a class="page_up ui-corner-all" href="javascript:void(0);" onclick="scroll(0,0);"></a>
<a class="page_up page_center ui-corner-all" href="javascript:void(0);"></a>
<a class="page_up page_down ui-corner-all" href="javascript:void(0);" onclick="scroll(0,100000);"></a>

<div id="container">
    <?php include('index/header.php'); ?>

    <div id="content" class="ui-corner-all tabs">	
    	<ul class="ui-corner-all">
    		<li><a href="settings/boards/info_settings.php">Настройки</a></li>
            <li><a href="settings/boards/other_settings.php">Прочее</a></li>
    	</ul>
    </div>

    <div id="footer" class="ui-corner-all">Медведчук Александр Юрьевич. Дипломная работа</div>
</div>
</body>
</html>