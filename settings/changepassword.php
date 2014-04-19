<?php
session_start();
include('../mysql.php');
$id = $_SESSION['user_id'];
$changePassword1 = (isset($_POST['changePassword1'])) ? mysql_real_escape_string($_POST['changePassword1']) : '';
$changePassword2 = (isset($_POST['changePassword2'])) ? mysql_real_escape_string($_POST['changePassword2']) : '';
$changePassword3 = (isset($_POST['changePassword3'])) ? mysql_real_escape_string($_POST['changePassword3']) : '';
$res = mysql_fetch_array(mysql_query("SELECT `password` FROM `users` WHERE id='$id'"));
if( ($res['password'] != $changePassword1) || 
    ($changePassword2 != $changePassword3) || 
    ($changePassword1 == '') ||
    ($changePassword2 == '') ||
    ($changePassword3 == '') ||
    ($res['password'] == $changePassword2) ||
    ($res['password'] == $changePassword3))
    {
        return false;
    }
    else
    { 
        mysql_query("UPDATE users SET password='$changePassword2' WHERE id='$id'") or die(mysql_error());
    }
?>