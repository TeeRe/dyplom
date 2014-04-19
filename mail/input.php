<?php
session_start();
include('../mysql.php');
header('Content-Type: text/html; charset=utf-8');

$receiver = $_SESSION['user_id'];
$input_mails = mysql_query("SELECT * FROM `mails` WHERE receiver='$receiver' AND `receiver_delete`='false' ORDER BY `id` DESC");
if (mysql_num_rows($input_mails) > 0)
{
    $mail = mysql_fetch_array($input_mails);
    do{
    		$author = mysql_fetch_array(mysql_query("SELECT login FROM users WHERE id='$mail[author]'"));
            $sendtime = date('d/m/Y H:i', strtotime($mail["sendtime"]));

            echo '<hr noshade><h1>От: '.$author['login'];
            echo '</h1><p>'.preg_replace('/\n/', '<br />', $mail["text"]).'</p>';
			echo '<hr noshade>';
			echo '<a class="send-reply" href="mail.php?receiver='.$author["login"].'">Ответить</a>';
			echo '<span title="Получено">'.$sendtime.'</span><hr noshade><br><br>';
    }
    while ($mail = mysql_fetch_array($input_mails));
}
else
{
	echo "Вам еще никто не написал. Пока.";
}
?>

<script src="mail/mail.js"></script>