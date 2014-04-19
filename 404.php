<?php 
session_start();
include('mysql.php');
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <link href="css/jquery.ui.all.css" rel="stylesheet" type="text/css">

        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/ui/jquery.ui.core.js"></script>
        <script src="js/ui/jquery.ui.position.js"></script>
        <script src="js/ui/jquery.ui.widget.js"></script>
        <script src="js/ui/jquery.ui.button.js"></script>
        <script src="js/ui/jquery.ui.tabs.js"></script>
        <script src="js/ui/jquery.ui.tooltip.js"></script>
        
        <script src="js/script.js"></script>
        <script src="js/other.js"></script>
        <link href="css/design.css" rel="stylesheet" type="text/css">

    	<title>Ошибка 404</title>
    </head>

<body>
<div id="container">
    <?php include('index/header.php'); ?>

        <div id="content" class="ui-corner-all tabs">   
            <ul class="ui-corner-all">
                <li><a href="#error404">Ошибка 404</a></li>
            </ul>
            <div id="error404">
                <h1>Да-да, это она - ваша самая любимая страница</h1>
                <a href="javascript:history.back()">Назад</a>
                <a href="index.php">Главная</a>
                <div class="not_smile"></div>
            </div>
        </div>            

    <div id="footer" class="ui-corner-all">Медведчук Александр Юрьевич. Дипломная работа</div>
</div>
</body>
</html>