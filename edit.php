<?php 
session_start();
include('mysql.php');
header('Content-Type: text/html; charset=utf-8');

if (isset($_GET['post'])) 
{
    $post = $_GET['post'];

    if (!preg_match("|^[\d]+$|", $post)) {
        header('Location: index.php');
        exit;
    }

    $sql = mysql_fetch_array(mysql_query("SELECT uid, topic FROM `news` WHERE id='$post'"));

    if($sql['uid'] != $_SESSION['user_id'])
    {
        header('Location: index.php');
        exit;
    }
    else
    {
        $title = $sql['topic'];
    }
}
else
{
    header('Location: index.php');
    exit;
};

$edit_feed_topic = (isset($_POST['edit-feed-topic'])) ? mysql_real_escape_string($_POST['edit-feed-topic']) : '';
$edit_feed_text = (isset($_POST['edit-feed-text'])) ? mysql_real_escape_string($_POST['edit-feed-text']) : '';
$edit_feed_tag = (isset($_POST['edit-feed-tag'])) ? mysql_real_escape_string($_POST['edit-feed-tag']) : '';
if ( $edit_feed_tag == NULL ) { $edit_feed_tag = "Без категории"; }
$tag_id = mysql_fetch_array(mysql_query("SELECT id FROM category_board WHERE cyr_board='$edit_feed_tag'"));
$edit_feed_tag = $tag_id['id'];
$edit_feed_topic = strip_tags($edit_feed_topic);

if (!empty($edit_feed_topic) && (!empty($edit_feed_text)))
{ 
    $sql = mysql_query("UPDATE `news` SET `topic` = '$edit_feed_topic',`text` = '$edit_feed_text', `category` = '$edit_feed_tag' WHERE id='$post'");
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

        <script src="js/jquery.autosize-min.js"></script>
        
        <script src="js/script.js"></script>
        <script src="js/other.js"></script>
        <link href="css/design.css" rel="stylesheet" type="text/css">

    	<title><?php echo $title; ?></title>
    </head>

<body>
<div id="container">
    <?php include('index/header.php'); ?>
    <?php

print<<<HERE
        <div id="content" class="ui-corner-all tabs">   
            <ul class="ui-corner-all">
                <li><a href="edit/content.php?post=$post">$title</a></li>
            </ul>
        </div>         
HERE;

    ?>
    <div id="footer" class="ui-corner-all">Медведчук Александр Юрьевич. Дипломная работа</div>
</div>
</body>
</html>