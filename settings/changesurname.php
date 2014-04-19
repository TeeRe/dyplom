<?php
session_start();
include('../mysql.php');
$id = $_SESSION['user_id'];
$changeSurname = (isset($_POST['changeSurname'])) ? mysql_real_escape_string($_POST['changeSurname']) : '';
if($changeSurname != '') mysql_query("UPDATE users SET surname='$changeSurname' WHERE id='$id'") or die(mysql_error());
else
{
    return false;
}
?>