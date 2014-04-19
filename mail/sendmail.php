<?php
if (isset($_GET['receiver']))
{
    $receiver = $_GET['receiver'];
}
else
{
    $receiver = NULL;
}

print_r('
<form method="post" action="">
	<p><input      id="send-mail-receiver" 	name="send-mail-receiver"   	placeholder="Введите логин получателя…(например - Admin)" 	class="ui-corner-all" type="text" autocomplete="off" value="'.$receiver.'"></p>
	<p><textarea   id="send-mail-text" 		name="send-mail-text" 			placeholder="Введите текст сообщения…" 						class="ui-corner-all"></textarea></p>
	<p><button     id="send-mail-submit">Добавить</button></p>
</form>
');
?>

<script src="mail/mail.js"></script>