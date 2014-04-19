<?php 
session_start();
header('Content-Type: text/html; charset=utf-8');
include("../mysql.php");

$uid = $_GET['uid'];
$sql = mysql_query("SELECT * FROM `news` WHERE uid='$uid' AND draft='false' ORDER BY `id` DESC");



if ($_GET['uid'] == $_SESSION['user_id'])    
{        
	print_r('
	<button type="button" id="add-feed-visible">Добавить новость</button>
	<div id="add-feed">
	<form method="post" action="" id="add-feed-form">            
		<p><input      id="add-feed-topic" name="add-feed-topic"   placeholder="Введите заголовок новости…" class="ui-corner-all" type="text" autocomplete="off"></p>
		<p><textarea   id="add-feed-text"  name="add-feed-text"    placeholder="Введите текст новости…" 	class="ui-corner-all" ></textarea></p>
		<p><input 	   id="add-feed-tag1" name="add-feed-tag1"     placeholder="Введите тег поиска для новости (обязательно)" class="ui-corner-all autocomplete" type="text" autocomplete="off"></p>
		<p><input 	   id="add-feed-tag2" name="add-feed-tag2"     placeholder="Введите тег поиска для новости..." class="ui-corner-all autocomplete" type="text" autocomplete="off"></p>
		<p><input 	   id="add-feed-tag3" name="add-feed-tag3"     placeholder="Введите тег поиска для новости..." class="ui-corner-all autocomplete" type="text" autocomplete="off"></p>
		<p><input 	   id="add-feed-tag4" name="add-feed-tag4"     placeholder="Введите тег поиска для новости..." class="ui-corner-all autocomplete" type="text" autocomplete="off"></p>
		<p><input 	   id="add-feed-tag5" name="add-feed-tag5"     placeholder="Введите тег поиска для новости..." class="ui-corner-all autocomplete" type="text" autocomplete="off"></p>
		<div id="radio">
			<input type="radio" id="on-board" name="add-feed-draft" value="false" checked="checked">	<label for="on-board">На стену</label>
			<input type="radio" id="on-draft" name="add-feed-draft" value="true">						<label for="on-draft">В черновик</label>
		</div>
		<p><button     id="add-feed-submit">Добавить</button></p>
	</form>
	</div>
	');
	print_r('<div>
	<select id="temp">
  		<option>Пункт 1</option>
  		<option>Пункт 2</option>
	</select>	
	</div>
	');
	if (mysql_num_rows($sql) > 0)
		{    	
			$result = mysql_fetch_array($sql);
			do{
				$addtime = date('d/m/Y H:i', strtotime($result['addtime']));
				$last_edit = date('d/m/Y H:i', strtotime($result['last_edit']));

				$tag1 = mysql_fetch_array(mysql_query("SELECT cyr_board, board FROM category_board WHERE id='$result[tag1]'"));
				$tag2 = mysql_fetch_array(mysql_query("SELECT cyr_board, board FROM category_board WHERE id='$result[tag2]'"));
				$tag3 = mysql_fetch_array(mysql_query("SELECT cyr_board, board FROM category_board WHERE id='$result[tag3]'"));
				$tag4 = mysql_fetch_array(mysql_query("SELECT cyr_board, board FROM category_board WHERE id='$result[tag4]'"));
				$tag5 = mysql_fetch_array(mysql_query("SELECT cyr_board, board FROM category_board WHERE id='$result[tag5]'"));

				echo '<hr noshade><h1>'.$result["topic"];
	            echo '</h1><p>'.preg_replace('/\n/', '<br>', $result["text"]).'</p>';
	            echo '<a class="tags tag1-post" href="category.php?tag='.$tag1['board'].'">'.$tag1['cyr_board'].'</a> ';
	            
	            if ($tag2 != NULL)
	            {
	            	echo '<a class="tags tag2-post" href="category.php?tag='.$tag2['board'].'">'.$tag2['cyr_board'].'</a> ';	
	            }
	            
	            if ($tag3 != NULL)
	            {
	            	echo '<a class="tags tag3-post" href="category.php?tag='.$tag3['board'].'">'.$tag3['cyr_board'].'</a> ';
	            }
	            if ($tag4 != NULL)
	            {
	            	echo '<a class="tags tag4-post" href="category.php?tag='.$tag4['board'].'">'.$tag4['cyr_board'].'</a> ';
	            }
	            if ($tag5 != NULL)
	            {
	            	echo '<a class="tags tag5-post" href="category.php?tag='.$tag5['board'].'">'.$tag5['cyr_board'].'</a> ';
	            }

				echo '<hr noshade>';
				echo '<a class="details-post" href="post.php?uid='.$uid.'&post='.$result["id"].'">Детальнее</a> ';
				echo '<a class="edit-post" href="edit.php?post='.$result["id"].'">Редактировать</a> ';
				echo '<span title="Дата добавления">'.$addtime.'</span> | ';
				echo '<span title="Дата последнего изменения">'.$last_edit.'</span><hr noshade><br><br>';
			}    
			while ($result = mysql_fetch_array($sql));
		echo "</div>";
		}
		else
		{    
			echo '<br>Доска пуста. Пока что…';
		}

}
else
{
	if (mysql_num_rows($sql) > 0)
		{    
			$result = mysql_fetch_array($sql);
			do{
				$addtime = new DateTime($result["addtime"]);
				$addtime = date_format($addtime,'d/m/Y H:i');

				$tag = mysql_fetch_array(mysql_query("SELECT cyr_board, board FROM category_board WHERE id='$result[category]'"));

				echo '<hr noshade><h1>'.$result["topic"];
	            echo '</h1><p>'.preg_replace('/\n/', '<br>', $result["text"]).'</p>';
	            echo '<a class="category-post" href="category.php?tag='.$tag['board'].'">'.$tag['cyr_board'].'</a> ';
				echo '<hr noshade>';
				echo '<a class="details-post" href="post.php?uid='.$uid.'&post='.$result["id"].'">Детальнее</a> ';
				echo $addtime.'<hr noshade><br><br>';
			}    
			while ($result = mysql_fetch_array($sql));
		}
		else
		{    
			echo '<br>Доска пуста. Пока что…';
		}
}
?>

<script src="page/page.js"></script>