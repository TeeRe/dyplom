<?php
session_start();
include('../mysql.php');
header('Content-Type: text/html; charset=utf-8');



if ($_GET['q'] == '')
{
	$query = 'none';
}
else
{
	$query = $_GET['q'];
}

echo "<h1>Поиск по постам:</h1>";

$posts = mysql_query("SELECT * FROM `news` WHERE draft='false' AND `text` LIKE '%$query%' OR draft='false' AND `topic` LIKE '%$query%' ORDER BY id DESC" );

	if (mysql_num_rows($posts) > 0)
	{    
		$result = mysql_fetch_array($posts);
		do{
			$addtime = date('d/m/Y H:i', strtotime($result['addtime']));
			$last_edit = date('d/m/Y H:i', strtotime($result['last_edit']));
			$rating = $result['like_post']-$result['dislike_post'];

			$author_login = mysql_fetch_array(mysql_query("SELECT login FROM users WHERE id='$result[uid]'"));

			echo '<h1>'.$result["topic"];
            echo '</h1><p>'.preg_replace('/\n/', '<br>', $result["text"]).'</p>';
			echo '<hr noshade>';
			echo '<span title="Рейтинг: &uArr;'.$result['like_post'].' &dArr;'.$result['dislike_post'].'"><a class="likes">'.$rating.'</a></span>';
			echo '<a class="author-post" href="page.php?uid='.$result["uid"].'">'.$author_login["login"].'</a> ';
			echo '<a class="details-post" href="post.php?uid='.$result["uid"].'&post='.$result["id"].'">Детальнее</a> ';
			echo '<span title="Дата добавления">'.$addtime.'</span> | ';
			echo '<span title="Дата последнего изменения">'.$last_edit.'</span><hr noshade><br><br><hr noshade>';
		}    
		while ($result = mysql_fetch_array($posts));
	}
	else
	{
		echo "Совпадений не найдено.";
	}

echo "<h1>Поиск по пользователям:</h1>";

$users = mysql_query("SELECT * FROM `users` WHERE `login` LIKE '%$query%' OR `name` LIKE '%$query%' OR `surname` LIKE '%$query%' "); 

	if (mysql_num_rows($users) > 0)
	{    
		$result = mysql_fetch_array($users);
		do{

			echo '<p><a class="find-user-info" href="page.php?uid='.$result["id"].'">На страницу пользователя</a>';
			echo '<a class="find-user-receiver" href="mail.php?receiver='.$result["login"].'">Отправить сообщение пользователю</a>';
			echo ' '.$result['name'].' <b>'.$result["login"].'</b> '.$result['surname'];
			echo '</p>';
		}    
		while ($result = mysql_fetch_array($users));
	}
	else
	{
		echo "Совпадений не найдено.";
	}
?>

<script src="search/search.js"></script>