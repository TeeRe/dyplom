<?php
session_start();
include('../mysql.php');
header('Content-Type: text/html; charset=utf-8');

$tag = mysql_fetch_array(mysql_query("SELECT id FROM category_board WHERE board='$_GET[tag]'"));
$cat = $tag['id'];

$sql = mysql_query("SELECT * FROM `news` WHERE `category`=$cat AND draft='false' ORDER BY like_post DESC" );

	if (mysql_num_rows($sql) > 0)
		{    
			$result = mysql_fetch_array($sql);
			do{
				$addtime = date('d/m/Y H:i', strtotime($result['addtime']));
				$last_edit = date('d/m/Y H:i', strtotime($result['last_edit']));
				$rating = $result['like_post']-$result['dislike_post'];

				$author_login = mysql_fetch_array(mysql_query("SELECT login FROM users WHERE id='$result[uid]'"));

				echo '<hr noshade><h1>'.$result["topic"];
	            echo '</h1><p>'.preg_replace('/\n/', '<br>', $result["text"]).'</p>';
				echo '<hr noshade>';
				echo '<span title="Рейтинг: &uArr;'.$result['like_post'].' &dArr;'.$result['dislike_post'].'"><a class="likes">'.$rating.'</a></span>';
				echo '<a class="author-post" href="page.php?uid='.$result["uid"].'">'.$author_login["login"].'</a> ';
				echo '<a class="details-post" href="post.php?uid='.$result["uid"].'&post='.$result["id"].'">Детальнее</a> ';
				echo '<span title="Дата добавления">'.$addtime.'</span> | ';
				echo '<span title="Дата последнего изменения">'.$last_edit.'</span><hr noshade><br><br>';
			}    
			while ($result = mysql_fetch_array($sql));
		}
		else
		{
			echo 'Еще нет постов в данной категории. <a class="create-post" href="page.php">Создать?</a>';
		}
?>

<script src="boards/boards.js"></script>
