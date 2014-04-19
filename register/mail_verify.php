<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include('../mysql.php');

$mail = $_POST['mail'];
$res = mysql_query("SELECT * FROM `users` WHERE email='$mail'");

if (mysql_num_rows($res) >= 1)
	{
		echo 'isSet';
	}
	else
	{
		echo 'notSet';
	}
?>