<?php
session_start();
include('../mysql.php');
$id = $_SESSION['user_id'];
$changeBday = (isset($_POST['changeBday'])) ? mysql_real_escape_string($_POST['changeBday']) : '';
if($changeBday != '') mysql_query("UPDATE users SET bday='$changeBday' WHERE id='$id'") or die(mysql_error());
else
{
    return false;
}
?>