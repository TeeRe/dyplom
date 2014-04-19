<?php
session_start();
include('../mysql.php');
header('Content-Type: text/html; charset=utf-8');

$author = $_SESSION['user_id'];
$output_mails = mysql_query("SELECT * FROM `mails` WHERE author='$author' AND `author_delete`='false' ORDER BY `id` DESC");
if (mysql_num_rows($output_mails) > 0)
{
    $mail = mysql_fetch_array($output_mails);
    do{
    		$receiver = mysql_fetch_array(mysql_query("SELECT login FROM users WHERE id='$mail[receiver]'"));
    		$sendtime = date('d/m/Y H:i', strtotime($mail["sendtime"]));

            echo '<hr noshade><h1>Кому: '.$receiver['login'];
            echo '</h1><p>'.preg_replace('/\n/', '<br />', $mail["text"]).'</p>';
			echo '<hr noshade>';
			echo '<a class="send-more" href="mail.php?receiver='.$receiver["login"].'">Написать еще</a>';
			echo '<span title="Отправлено">'.$sendtime.'</span><hr noshade><br><br>';
    }
    while ($mail = mysql_fetch_array($output_mails));
}
else
{
	echo "Тут будут отображены отправленные вами сообщения.";
}
?>

<script src="mail/mail.js"></script>