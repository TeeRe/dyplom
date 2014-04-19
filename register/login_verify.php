<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include('../mysql.php');

$login = $_POST['login'];
$res = mysql_query("SELECT * FROM `users` WHERE login='$login'");

if (mysql_num_rows($res) >= 1)
	{
		echo 'isSet';
	}
	else
	{
		echo 'notSet';
	}
?>