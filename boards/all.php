<?php
session_start();
include('../mysql.php');
header('Content-Type: text/html; charset=utf-8');
?>
<div id="all-boards">
	<div class="first-line-boards">
		<a class="cinema" href="category.php?tag=cinema">Кино</a>
		<a class="literature" href="category.php?tag=literature">Литература</a>
		<a class="music" href="category.php?tag=music">Музыка</a>
	</div>

	<hr noshade>

	<div class="second-line-boards">
		<a class="programming" href="category.php?tag=programming">Программирование</a>
		<a class="scientific" href="category.php?tag=scientific">Наука</a>
	</div>
	
	<hr noshade>
	
	<div class="third-line-boards">
		<a class="sport" href="category.php?tag=sport">Спорт</a>
	</div>

	<hr noshade>
	
	<div class="fourth-line-boards">
		<a class="without_category" href="category.php?tag=without_category">Без категории</a>
	</div>
</div>

<script src="boards/boards.js"></script>