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

$regname = (isset($_POST['regname'])) ? mysql_real_escape_string($_POST['regname']) : '';
$regpassword1 = (isset($_POST['regpassword1'])) ? mysql_real_escape_string($_POST['regpassword1']) : '';
$regpassword2 = (isset($_POST['regpassword2'])) ? mysql_real_escape_string($_POST['regpassword2']) : '';
$regmail = (isset($_POST['regmail'])) ? mysql_real_escape_string($_POST['regmail']) : '';

if (!empty($regname))
{
    if (
            ($regpassword1 != '') &&
            ($regpassword2 != '') &&
            ($regpassword1 == $regpassword2) &&
            ($regmail != '')
        ) 
    {
        $sql = "INSERT INTO `users` (`id`, `login`, `email`, `password`, `name`, `surname`, `bday`) 
                VALUES (
                    NULL, 
                    '$regname', 
                    '$regmail', 
                    '$regpassword1', 
                    '', 
                    '', 
                    ''
        );";
        mysql_query($sql) or die(mysql_error());
        // header('Location: signup.php');
        // exit;
    }
    else
    {
        // header('Location: register.php');
        // exit;
    }
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
    <script src="js/ui/jquery.ui.tooltip.js"></script>
    <script src="js/ui/jquery.ui.dialog.js"></script>
    
    <script src="js/jquery.form.js"></script>

    <script src="js/jquery.toastmessage.js"></script>
    <link rel="stylesheet" href="css/jquery.toastmessage.css">

    <link href="css/design.css" rel="stylesheet" type="text/css" />
    <script src="js/script.js"></script>

    <script src="register/register.js"></script>
    <link href="register/register.css" rel="stylesheet" type="text/css" />

	<title>Регистрация</title>
</head>
<body>
<div id="container">
    <?php include("register/header.php");?>   
    <?php include("register/content.php");?>
    <div id="footer" class="ui-corner-all">Медведчук Александр Юрьевич. Дипломная работа</div>
</div>
</body>
</html>