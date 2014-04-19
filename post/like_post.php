<?php 
session_start();
header('Content-Type: text/html; charset=utf-8');
include("../mysql.php");

$uid = $_SESSION['user_id'];
$pid = $_GET['post'];

if ($uid == 0)
{
	exit;
}

$there_table = mysql_fetch_array(mysql_query("SELECT like_post, dislike_post FROM rating WHERE user_id='$uid' AND post_id='$pid'"));
if ($there_table == 0)
{
	mysql_query("INSERT INTO rating (`id`, `post_id`, `user_id`, `like_post`, `dislike_post`) 
							 VALUES (NULL, '$pid', '$uid', '1', '0')") or die(mysql_error());
}
else
{
	mysql_query("UPDATE rating SET like_post='1', dislike_post='0' WHERE user_id='$uid' AND post_id='$pid'");
}

$post_rating = mysql_fetch_array(mysql_query("SELECT dislike_post FROM news WHERE id='$pid' LIMIT 1"));

mysql_query("UPDATE news SET like_post = like_post + 1 WHERE id='$pid'");
if ($post_rating['dislike_post'] > 0)
{
	mysql_query("UPDATE news SET dislike_post = dislike_post - 1 WHERE id='$pid'");
}
?>