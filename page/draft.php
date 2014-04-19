<?php 
session_start();
header('Content-Type: text/html; charset=utf-8');
include("../mysql.php");

$uid = $_GET['uid'];
$sql = mysql_query("SELECT * FROM `news` WHERE uid='$uid' AND draft='true' ORDER BY `id` DESC");

print_r('
<div class="tags-button">
	<button id="p" 			title="Новый абзац">p</button>
	<button id="h2"			title="Заголовок второго уровня">h2</button>
	<button id="h3"			title="Заголовок третьего уровня">h3</button>
	<button id="b"			title="Полужирный текст">b</button>
	<button id="i"			title="Курсивный текст">i</button>
	<button id="a"			title="Ссылка">a</button>
	<button id="img"		title="Картинка">img</button>
</div>

<form method="post" action="" id="add-feed-form-draft"> 
	<p><input      id="add-feed-topic-draft" name="add-feed-topic"	placeholder="Введите заголовок новости…"	class="ui-corner-all" type="text"></p>
	<p><textarea   id="add-feed-text-draft"  name="add-feed-text"	placeholder="Введите текст новости…"		class="ui-corner-all"></textarea></p>
	<p><input 	   id="add-feed-tag-draft"   name="add-feed-tag"    placeholder="Введите категорию новости…"    class="ui-corner-all" type="text"></p>
	<p><input      id="add-feed-draft" name="add-feed-draft" type="hidden" value="true"></p>
	<p><button     id="add-feed-submit-draft">Добавить</button></p>
</form>		
');

if (mysql_num_rows($sql) > 0)
	{    
		$result = mysql_fetch_array($sql);
		do{
			$addtime = date('d/m/Y H:i', strtotime($result['addtime']));
			$last_edit = date('d/m/Y H:i', strtotime($result['last_edit']));

			$tag = mysql_fetch_array(mysql_query("SELECT cyr_board FROM category_board WHERE id='$result[category]'"));

			echo '<hr noshade><h1>'.$result["topic"];
            echo '</h1><p>'.preg_replace('/\n/', '<br>', $result["text"]).'</p>';
            echo '<a class="category-post" href="#">'.$tag['cyr_board'].'</a> ';
			echo '<hr noshade>';
			echo '<a class="details-post" href="post.php?uid='.$uid.'&post='.$result["id"].'">Детальнее</a> ';
			echo '<a class="edit-post" href="edit.php?post='.$result["id"].'">Редактировать</a> ';
			echo $addtime.' | ';
			echo $last_edit.'<hr noshade><br><br>';
		}    
		while ($result = mysql_fetch_array($sql));
	}
	else
	{    
		echo '<br />Тут пока что ничего нет...';
	}


?>

<div class="error_message" title="Ошибка!">
  <p>1</p>
</div>

<script src="page/draft.js"></script>