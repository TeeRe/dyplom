<?php
session_start();
include('../mysql.php');

$post_id = $_POST['post_id'];

$sql = mysql_query("UPDATE `news` SET `draft` = 'delete' WHERE id='$post_id'");
?>