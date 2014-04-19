<?php 
session_start();
include('mysql.php');
header('Content-Type: text/html; charset=utf-8');

if (isset($_GET['uid'])) 
{
    $uid = $_GET['uid'];

    if (!preg_match("|^[\d]+$|", $uid)) {
        header('Location: 404.php');
        exit;
    };

    $sql = mysql_fetch_array(mysql_query("SELECT id FROM `users` WHERE id='$uid' LIMIT 1"));
    if ($sql['id'] == NULL)
    {
        header('Location: 404.php');
        exit;
    }
}
else
{
    header('Location: 404.php');
    exit;
};

if (isset($_GET['post'])) 
{
    $post = $_GET['post'];

    if (!preg_match("|^[\d]+$|", $post)) {
        header('Location: 404.php');
        exit;
    };

    $sql = mysql_fetch_array(mysql_query("SELECT id, topic, draft FROM `news` WHERE id='$post' LIMIT 1"));
    if ($sql['id'] == NULL)
    {
        header('Location: 404.php');
        exit;
    }
    else
    {
        $title = $sql['topic'];
    }

    if (($uid != $_SESSION['user_id']) && ($sql['draft'] == 'true'))
    {
        header('Location: draft.php?uid='.$uid);
        exit;
    }
}
else
{
    header('Location: 404.php');
    exit;
};

$post_id = $_GET['post'];
$add_comment = (isset($_POST['add-comment'])) ? mysql_real_escape_string($_POST['add-comment']) : '';
$add_comment = strip_tags($add_comment);
$author = $_SESSION['user_id'];
$uid = $_GET['uid'];

if (!empty($add_comment))
{
    mysql_query("INSERT INTO `news_comments` (`post_id`,`comment_id`,`comment`,`author`,`addtime`,`delete`) VALUES ('$post_id', NULL, '$add_comment', '$author', CURRENT_TIMESTAMP, 'false')");
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

        <script src="js/jquery.autosize-min.js"></script>
        
        <script src="js/script.js"></script>
        <script src="js/other.js"></script>
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

print<<<HERE
        <div id="content" class="ui-corner-all tabs">   
            <ul class="ui-corner-all">
                <li><a href="post/content.php?uid=$uid&post=$post">$title</a></li>
            </ul>
        </div>            
HERE;

    ?>

    <div id="footer" class="ui-corner-all">Медведчук Александр Юрьевич. Дипломная работа</div>
</div>
</body>
</html>