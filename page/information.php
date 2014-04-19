<?php
session_start();
include('../mysql.php');
header('Content-Type: text/html; charset=utf-8');

$uid = $_GET['uid'];
$res = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE id='$uid'"));
    echo '<p>'.$res['name'].' ';
    echo '<strong>'.$res['login'].'</strong> ';
    echo $res['surname'].'</p>';
    echo '<p>'.$res['email'].'</p>';
    echo '<p>'.$res['bday'].'</p>';
?>