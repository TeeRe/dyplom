<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include("../mysql.php");

$author = $_SESSION['login'];
$add_comment = (isset($_POST['add-comment'])) ? mysql_real_escape_string($_POST['add-comment']) : '';

INSERT INTO  `u659288337_asylum`.`1_news_comments` (`post_id` ,`comment_id` ,`comment` ,`author` ,`like` ,`dislike` ,`addtime` ,`delete`)
VALUES (
'1', NULL ,  'Второй комментарий!',  'Admin',  '0',  '0', 
CURRENT_TIMESTAMP ,  'false'
);
?>