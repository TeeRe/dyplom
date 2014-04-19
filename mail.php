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
        header('Location: index.php');
        exit;
	}
	header('Location: index.php');
    exit;
};

if (isset($_GET['receiver']))
{
    $receiver = $_GET['receiver'];
}
else
{
    $receiver = NULL;
}

$author = $_SESSION['user_id'];
$mail_receiver = (isset($_POST['send-mail-receiver'])) ? mysql_real_escape_string($_POST['send-mail-receiver']) : '';
    $mr = mysql_fetch_array(mysql_query("SELECT id FROM `users` WHERE login='$mail_receiver' LIMIT 1"));
    $mail_receiver = $mr['id'];
$text = (isset($_POST['send-mail-text'])) ? mysql_real_escape_string($_POST['send-mail-text']) : '';

if (($mail_receiver != NULL) && ($text != NULL))
{
    mysql_query("
    INSERT INTO `mails` (`id`,`text`,`author`,`receiver`,`read`,`sendtime`,`author_delete`,`receiver_delete`)
    VALUES (NULL , '$text', '$author', '$mail_receiver', 'false', NULL, 'false', 'false')");
}

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
        <script src="js/ui/jquery.ui.autocomplete.js"></script>
        <script src="js/ui/jquery.ui.menu.js"></script>
    	<script src="js/jquery.form.js"></script>

        <script src="js/jquery.autosize-min.js"></script>
        
        <script src="js/script.js"></script>
        <script src="js/other.js"></script>
        <link href="css/design.css" rel="stylesheet" type="text/css">

    	<title>Сообщения</title>
    </head>

<body>

<a class="page_up ui-corner-all" href="javascript:void(0);" onclick="scroll(0,0);"></a>
<a class="page_up page_center ui-corner-all" href="javascript:void(0);"></a>
<a class="page_up page_down ui-corner-all" href="javascript:void(0);" onclick="scroll(0,100000);"></a>

<div id="container">
<?php include('index/header.php'); ?>
<?php 
print<<<HERE
    <div id="content" class="ui-corner-all tabs">	
    	<ul class="ui-corner-all">
            <li><a href="mail/sendmail.php?receiver=$receiver">Новое сообщение</a></li>
    		<li><a href="mail/input.php">Входящие</a></li>
            <li><a href="mail/output.php">Исходящие</a></li>
    	</ul>
    </div>
HERE;
?>
    <div id="footer" class="ui-corner-all">Медведчук Александр Юрьевич. Дипломная работа</div>
</div>
</body>
</html>