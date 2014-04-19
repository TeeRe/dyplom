<?php 
session_start();
header('Content-Type: text/html; charset=utf-8');
include("../mysql.php");

$post = $_GET['post'];
$uid = $_SESSION['user_id'];

$sql = mysql_query("SELECT * FROM `news` WHERE id='$post' AND uid='$uid'");
$result = mysql_fetch_array($sql);

$tag = mysql_fetch_array(mysql_query("SELECT cyr_board FROM category_board WHERE id='$result[category]'"));

echo '	
		<div class="tags-button">
			<button id="p" 			title="Новый абзац">p</button>
			<button id="h2"			title="Заголовок второго уровня">h2</button>
			<button id="h3"			title="Заголовок третьего уровня">h3</button>
			<button id="b"			title="Полужирный текст">b</button>
			<button id="i"			title="Курсивный текст">i</button>
			<button id="a"			title="Ссылка">a</button>
			<button id="img"		title="Картинка">img</button>
		</div>

		<form method="post" action="edit.php?post='.$post.'">            
			<p><input      id="edit-feed-topic" name="edit-feed-topic"   placeholder="Изменить заголовок новости…"    class="ui-corner-all" type="text" value="'.$result["topic"].'"></p>
			<p><textarea   id="edit-feed-text"  name="edit-feed-text"    placeholder="Изменить текст новости…"        class="ui-corner-all">'.$result["text"].'</textarea></p>
			<p><input 	   id="edit-feed-tag"   name="edit-feed-tag"     placeholder="Изменить категорию новости…"    class="ui-corner-all" type="text" value="'.$tag["cyr_board"].'"></p>
			<p><button     id="edit-feed-submit">Изменить</button></p>
		</form>	';
?>

<hr noshade>
<button id="delete-post">Удалить</button>
<?php 

if ($result['draft'] == 'false'){
	echo '<button id="draft-post-true">Переместить в черновик</button>';
}
else if ($result['draft'] == 'true')
{
	echo '<button id="draft-post-false">Переместить на доску</button>';
}
	
?>

<div id="delete-post-confirm" title="Вы уверены?">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Вы уверены, что хотите удалить пост, в который было вложено столько сил?</p>
</div>
<div id="draft-post-true-confirm" title="Вы уверены?">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Вы уверены, что хотите переместить пост в черновик? Он будет доступен только Вам.</p>
</div>
<div id="draft-post-false-confirm" title="Вы уверены?">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Вы уверены, что хотите переместить пост на стену? Теперь он будет доступен всем.</p>
</div>

<script src="edit/edit.js"></script>