<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include('../mysql.php');

$login = $_POST['login'];
$password = $_POST['password'];
$res = mysql_query("SELECT * FROM `users` WHERE login='$login' AND password='$password'");

if (mysql_num_rows($res) == 1)
	{
		echo 'false';
	}
	else
	{
		echo 'true';
	}
?>