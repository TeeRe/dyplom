<?php 
session_start();
include('mysql.php');
header('Content-Type: text/html; charset=utf-8');

if (!isset($_SESSION['user_id']))
{
	if (isset($_COOKIE['login']) && isset($_COOKIE['password']))
	{
		$login = mysql_escape_string($_COOKIE['login']);
		$password = mysql_escape_string($_COOKIE['password']);
		$query = "SELECT id, login FROM `users`	WHERE `login`='{$login}' AND `password`='{$password}' LIMIT 1";
		$sql = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($sql) == 1)
		{
			$row = mysql_fetch_assoc($sql);
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['login'] = $row['login'];
		}
        header('Location: index.php');
        exit;
	}
};

if (isset($_GET['uid'])) 
{
    $uid = $_GET['uid'];

    if ($uid == NULL)
    {
        header('Location: index.php');
        exit;
    }

    if (!preg_match("|^[\d]+$|", $uid)) 
    {
        header('Location: 404.php');
        exit;
    };

    $sql = mysql_fetch_array(mysql_query("SELECT id, login, name, surname FROM `users` WHERE id='$uid' LIMIT 1"));
    if ($sql['id'] == NULL)
    {
        header('Location: 404.php');
        exit;
    }
    else
    {
        if ($uid == $_SESSION['user_id']) 
        {
            $title = "Моя страница";
            $board_title = "Моя доска";
        }
        else
        {
            if (($sql['name'] == NULL) || $sql['surname'] == NULL) {
                $title = $sql['login'];
            }
            else
            {
                $title = $sql['surname'].' '.$sql['name'];
            }
            $board_title = "Доска";
        }
    }
}
else
{
    $uid = $_SESSION['user_id'];
    header('Location: page.php?uid='.$uid);
    exit;
};

$add_feed_topic = (isset($_POST['add-feed-topic'])) ? mysql_real_escape_string($_POST['add-feed-topic']) : '';
$add_feed_text = (isset($_POST['add-feed-text'])) ? mysql_real_escape_string($_POST['add-feed-text']) : '';
$add_feed_tag1 = (isset($_POST['add-feed-tag1'])) ? mysql_real_escape_string($_POST['add-feed-tag1']) : '';
$add_feed_tag2 = (isset($_POST['add-feed-tag2'])) ? mysql_real_escape_string($_POST['add-feed-tag2']) : '';
$add_feed_tag3 = (isset($_POST['add-feed-tag3'])) ? mysql_real_escape_string($_POST['add-feed-tag3']) : '';
$add_feed_tag4 = (isset($_POST['add-feed-tag4'])) ? mysql_real_escape_string($_POST['add-feed-tag4']) : '';
$add_feed_tag5 = (isset($_POST['add-feed-tag5'])) ? mysql_real_escape_string($_POST['add-feed-tag5']) : '';

$tag1_id = mysql_fetch_array(mysql_query("SELECT id FROM category_board WHERE cyr_board='$add_feed_tag1'"));
$add_feed_tag1 = $tag1_id['id'];

$tag2_id = mysql_fetch_array(mysql_query("SELECT id FROM category_board WHERE cyr_board='$add_feed_tag2'"));
$add_feed_tag2 = $tag2_id['id'];

$tag3_id = mysql_fetch_array(mysql_query("SELECT id FROM category_board WHERE cyr_board='$add_feed_tag3'"));
$add_feed_tag3 = $tag3_id['id'];

$tag4_id = mysql_fetch_array(mysql_query("SELECT id FROM category_board WHERE cyr_board='$add_feed_tag4'"));
$add_feed_tag4 = $tag4_id['id'];

$tag5_id = mysql_fetch_array(mysql_query("SELECT id FROM category_board WHERE cyr_board='$add_feed_tag5'"));
$add_feed_tag5 = $tag5_id['id'];

$add_feed_draft = (isset($_POST['add-feed-draft'])) ? mysql_real_escape_string($_POST['add-feed-draft']) : '';
$addtime = date('Y-m-d H:i:s');
$add_feed_topic = strip_tags($add_feed_topic);

if (!empty($add_feed_topic) && (!empty($add_feed_text)))
{ 
    $sql = mysql_query("INSERT INTO `news` (`uid`, `id`, `topic`, `text`, `tag1`, `tag2`, `tag3`, `tag4`, `tag5`, `addtime`, `draft`) VALUES ('$uid', NULL, '$add_feed_topic', '$add_feed_text', '$add_feed_tag1', '$add_feed_tag2', '$add_feed_tag3', '$add_feed_tag4', '$add_feed_tag5', '$addtime', '$add_feed_draft')");
    header('Location: page.php');
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
        <script src="js/ui/jquery.ui.dialog.js"></script>
        <script src="js/ui/jquery.ui.autocomplete.js"></script>
        <script src="js/ui/jquery.ui.menu.js"></script>
    	<script src="js/jquery.form.js"></script>

        <script src="js/jquery.toastmessage.js"></script>
        <link rel="stylesheet" href="css/jquery.toastmessage.css">

        <!-- // <script src="js/jquery.autosize-min.js"></script> -->
        
        <script src="js/script.js"></script>
        <script src="js/other.js"></script>

        <link rel="stylesheet" href="sce/minified/themes/default.min.css" type="text/css" media="all">
        <link rel="stylesheet" href="sce/minified/themes/modern.min.css" type="text/css" media="all">
        <script type="text/javascript" src="sce/minified/jquery.sceditor.bbcode.min.js"></script>
        <script src="sce/languages/ru.js"></script>

        <link href="css/design.css" rel="stylesheet" type="text/css">

    	<title><?php echo $title; ?></title>
    </head>

<body>

<a class="page_up ui-corner-all" href="javascript:void(0);" onclick="scroll(0,0);"></a>
<a class="page_up page_center ui-corner-all" href="javascript:void(0);"></a>
<a class="page_up page_down ui-corner-all" href="javascript:void(0);" onclick="scroll(0,100000);"></a>

<div id="container">
    <?php include('index/header.php'); ?>
    <?php
if ($_GET['uid'] == $_SESSION['user_id']){
print<<<HERE
        <div id="content" class="ui-corner-all tabs">   
            <ul class="ui-corner-all">
                <li><a href="page/board.php?uid=$uid">$board_title</a></li>
                <li><a href="page/information.php?uid=$uid">Информация</a></li>
                <li><a href="page/draft.php?uid=$uid">Черновик</a></li>
            </ul>
        </div>            
HERE;
}
else
{
print<<<HERE
        <div id="content" class="ui-corner-all tabs">   
            <ul class="ui-corner-all">
                <li><a href="page/board.php?uid=$uid">$board_title</a></li>
                <li><a href="page/information.php?uid=$uid">Информация</a></li>
            </ul>
        </div>            
HERE;
}

    ?>

    <div id="footer" class="ui-corner-all">Медведчук Александр Юрьевич. Дипломная работа</div>
</div>
</body>
</html>