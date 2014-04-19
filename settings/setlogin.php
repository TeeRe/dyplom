<?php
session_start();
include('../mysql.php');
$id = $_SESSION['user_id'];
$res = mysql_fetch_array(mysql_query("SELECT `login` FROM `users` WHERE id='$id'"));
echo $res['login'];
?>