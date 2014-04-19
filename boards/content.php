<?php
session_start();
include('../mysql.php');
header('Content-Type: text/html; charset=utf-8');

$tag = mysql_fetch_array(mysql_query("SELECT id FROM category_board WHERE board='$_GET[tag]'"));
$cat = $tag['id'];

$sql = mysql_query("SELECT * FROM `news` WHERE `category`=$cat ORDER BY id DESC" );

	if (mysql_num_rows($sql) > 0)
		{    
			$result = mysql_fetch_array($sql);
			do{
				$addtime = new DateTime($result["addtime"]);
				$last_edit = new DateTime($result["last_edit"]);
				$addtime = date_format($addtime,'d/m/Y H:i');
				$last_edit = date_format($last_edit,'d/m/Y H:i');

				$author_login = mysql_fetch_array(mysql_query("SELECT login FROM users WHERE id='$result[uid]'"));

				echo '<hr noshade><h1>'.$result["topic"];
	            echo '</h1><p>'.preg_replace('/\n/', '<br>', $result["text"]).'</p>';
				echo '<hr noshade>';
				echo '<a class="author-post" href="page.php?uid='.$result["uid"].'">'.$author_login["login"].'</a> ';
				echo '<a class="details-post" href="post.php?uid='.$result["uid"].'&post='.$result["id"].'">Детальнее</a> ';
				echo $addtime.' | ';
				echo $last_edit.'<hr noshade><br><br>';
			}    
			while ($result = mysql_fetch_array($sql));
		}
		else
		{
			echo 'Еще нет постов в данной категории. <a class="create-post" href="page.php">Создать?</a>';
		}
?>

<script src="boards/boards.js"></script>
