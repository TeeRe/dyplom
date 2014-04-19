<?php 
session_start();
header('Content-Type: text/html; charset=utf-8');
include("../../mysql.php");

$uid = $_SESSION['user_id'];
$sql = mysql_fetch_array(mysql_query("SELECT * FROM `settings` WHERE uid='$uid'"));

$feed_menu_visible = $sql['add-feed-visible'];
?>

<div align="center">
<form method="post" action="" id="add-feed-visible-form"> 
	<div id="add-feed-visible-setting">
		<?php 
			if($feed_menu_visible == 'hide')
			{
				print_r('
					<input type="radio" id="add-feed-visible-hide" name="add-feed-visible-change" value="hide" checked="checked">	<label for="add-feed-visible-hide">Меню скрыто</label>
					<input type="radio" id="add-feed-visible-show" name="add-feed-visible-change" value="show">	<label for="add-feed-visible-show">Меню раскрыто</label>
				');
			}
			else if($feed_menu_visible == 'show')
			{
				print_r('
					<input type="radio" id="add-feed-visible-hide" name="add-feed-visible-change" value="hide">	<label for="add-feed-visible-hide">Меню скрыто</label>
					<input type="radio" id="add-feed-visible-show" name="add-feed-visible-change" value="show" checked="checked">	<label for="add-feed-visible-show">Меню раскрыто</label>
				');
			}
		?>
		
	</div>
</form>
</div>

<script src="settings/settings.js"></script>