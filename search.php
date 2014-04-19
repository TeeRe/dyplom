<?php 
session_start();
include('mysql.php');
header('Content-Type: text/html; charset=utf-8');
$query = $_GET['q'];
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
    	<script src="js/jquery.form.js"></script>
        
        <script src="js/script.js"></script>
        <script src="js/other.js"></script>
        <link href="css/design.css" rel="stylesheet" type="text/css">

    	<title>Поиск</title>
    </head>

<body>

<a class="page_up ui-corner-all" href="javascript:void(0);" onclick="scroll(0,0);"></a>
<a class="page_up page_center ui-corner-all" href="javascript:void(0);"></a>
<a class="page_up page_down ui-corner-all" href="javascript:void(0);" onclick="scroll(0,100000);"></a>

<div id="container">
    <?php include('index/header.php');

print<<<HERE
    <div id="content" class="ui-corner-all tabs">	
    	<ul class="ui-corner-all">
            <li><a href="search/content.php?q=$query">Поиск: $_GET[q]</a></li>
    	</ul>
    </div>
HERE;

    ?>
    <div id="footer" class="ui-corner-all">Медведчук Александр Юрьевич. Дипломная работа</div>
</div>
</body>
</html>
