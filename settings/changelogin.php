<?php
session_start();
include('../mysql.php');
$id = $_SESSION['user_id'];
$changeLogin = (isset($_POST['changeLogin'])) ? mysql_real_escape_string($_POST['changeLogin']) : '';
if($changeLogin != '') mysql_query("UPDATE users SET login='$changeLogin' WHERE id='$id'") or die(mysql_error());
else
{
    return false;
}
?>