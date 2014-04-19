<?php 
session_start();
include('mysql.php');
header('Content-Type: text/html; charset=utf-8');

if (isset($_GET['tag']))
{
    $tag = $_GET['tag'];
    $title = mysql_fetch_array(mysql_query("SELECT cyr_board FROM `category_board` WHERE board='$tag'"));
}
else
{
    header('Location: boards.php');
    exit;
}
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

    	<title><?php echo $title['cyr_board']; ?></title>
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
            <li><a href="category/content.php?tag=$tag">$title[cyr_board]</a></li>
    	</ul>
    </div>
HERE;

    ?>
    <div id="footer" class="ui-corner-all">Медведчук Александр Юрьевич. Дипломная работа</div>
</div>
</body>
</html>