<?php
session_start();
include('../mysql.php');
$id = $_SESSION['user_id'];
$changeMail1 = (isset($_POST['changeMail1'])) ? mysql_real_escape_string($_POST['changeMail1']) : '';
$changeMail2 = (isset($_POST['changeMail2'])) ? mysql_real_escape_string($_POST['changeMail2']) : '';
$changeMail3 = (isset($_POST['changeMail3'])) ? mysql_real_escape_string($_POST['changeMail3']) : '';
$res = mysql_fetch_array(mysql_query("SELECT `email` FROM `users` WHERE id='$id'"));
if( 
	($res['email'] != $changeMail1) || 
    ($changeMail2 != $changeMail3)  || 
    ($changeMail1 == '') ||
    ($changeMail2 == '') ||
    ($changeMail3 == '') ||
    ($res['email'] == $changeMail2)
  )
    {
        return false;
    }
    else
    { 
        mysql_query("UPDATE users SET email='$changeMail2' WHERE id='$id'") or die(mysql_error());
    }
?>