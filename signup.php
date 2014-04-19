<?php 
session_start();
include('mysql.php');
header('Content-Type: text/html; charset=utf-8');


if (isset($_SESSION['user_id']))
{
	if (isset($_COOKIE['login']) && isset($_COOKIE['password']))
	{
		$login = mysql_escape_string($_COOKIE['login']);
		$password = mysql_escape_string($_COOKIE['password']);
		$sql = mysql_query("SELECT id, login FROM `users` WHERE `login`='{$login}' AND `password`='{$password}' LIMIT 1") or die(mysql_error());
		if (mysql_num_rows($sql) == 1)
		{
			$row = mysql_fetch_assoc($sql);
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['login'] = $row['login'];
		}
        header('Location: index.php');
        exit;
	}
    else
    {
        header('Location: index.php');
        exit;
    }
};

$loginname = (isset($_POST['loginname'])) ? mysql_real_escape_string($_POST['loginname']) : '';
$loginpassword = (isset($_POST['loginpassword'])) ? mysql_real_escape_string($_POST['loginpassword']) : '';

if (!empty($_POST['loginname']))
{
    $query = "SELECT * FROM `users` WHERE `login`='{$loginname}' AND `password`='{$loginpassword}' LIMIT 1";
    $sql = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($sql) == 1)
		{
			$row = mysql_fetch_array($sql);
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['login'] = $row['login'];
            $_SESSION['password'] = $row['password'];			
			$time = 86400;
			if (isset($_POST['rememberme']))
			{
				setcookie('login', $loginname, time()+$time, "/");
				setcookie('password', $loginpassword, time()+$time, "/");
			}
        }
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
        <script src="js/ui/jquery.ui.tooltip.js"></script>      
        <script src="js/jquery.form.js"></script>
        
        <script src="js/jquery.toastmessage.js"></script>
        <link rel="stylesheet" href="css/jquery.toastmessage.css">
        
        <link href="css/design.css" rel="stylesheet" type="text/css">
        <script src="js/script.js"></script>

        <script src="signup/signup.js"></script>
        <link href="signup/signup.css" rel="stylesheet" type="text/css">

    	<title>Авторизация</title>
    </head>
    <body>
        <div id="container">
            <?php include("signup/header.php");?>   
            <?php include("signup/content.php");?>
            <div id="footer" class="ui-corner-all">Медведчук Александр Юрьевич. Дипломная работа</div>
        </div>
    </body>
</html>