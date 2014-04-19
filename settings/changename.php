<?php
session_start();
include('../mysql.php');
$id = $_SESSION['user_id'];
$changeName = (isset($_POST['changeName'])) ? mysql_real_escape_string($_POST['changeName']) : '';
if($changeName != '') mysql_query("UPDATE users SET name='$changeName' WHERE id='$id'") or die(mysql_error());
else
{
    return false;
}
?>