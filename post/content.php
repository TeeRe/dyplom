<?php 
session_start();
header('Content-Type: text/html; charset=utf-8');
include("../mysql.php");

$post_id = $_GET['post'];
$uid = $_GET['uid'];
$sid = $_SESSION['user_id'];

$post = mysql_fetch_array(mysql_query("SELECT * FROM `news` WHERE id='$post_id'"));

//$comments_count = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS `Rows`, `post_id` FROM `$user_table_comments` WHERE post_id = $post_id"));

$addtime = date('d/m/Y H:i', strtotime($post['addtime']));
$last_edit = date('d/m/Y H:i', strtotime($post['last_edit']));

$tag = mysql_fetch_array(mysql_query("SELECT cyr_board, board FROM category_board WHERE id='$post[category]'"));
$rating = mysql_fetch_array(mysql_query("SELECT SUM(like_post), SUM(dislike_post) FROM rating WHERE post_id='$post[id]'"));
$user_rating = mysql_fetch_array(mysql_query("SELECT like_post, dislike_post FROM rating WHERE user_id='$sid' AND post_id='$post[id]'"));

if (($rating['SUM(like_post)'] == '') || ($rating['SUM(dislike_post)'] == ''))
{
    $likes = '0';
    $dislikes = '0';
}
else
{
    $likes = $rating['SUM(like_post)'];
    $dislikes = $rating['SUM(dislike_post)'];
}

if (!isset($_SESSION['login']))
{
    $disable_like = 'disabled';
    $disable_dislike = 'disabled';
}
else
{
    if ($user_rating['like_post'] == 1)
    {
        $disable_like = 'disabled';
    }
    else
    {
        $disable_like = '';
    }

    if ($user_rating['dislike_post'] == 1)
    {
        $disable_dislike = 'disabled';
    }
    else
    {
        $disable_dislike = '';
    }
}

echo '<hr noshade><h1>'.$post["topic"];
echo '</h1><p>'.preg_replace('/\n/', '<br>', $post["text"]).'</p>';
echo '<a class="category-post" href="category.php?tag='.$tag['board'].'">'.$tag['cyr_board'].'</a> ';
echo '<hr noshade>';

print_r('
    <form method="post" action="post/like_post.php?post='.$post_id.'" id="like">
        Likes: <button type="submit" class="like-post" '.$disable_like.'><span>'.$likes.'</span></button>
    </form>

    <form method="post" action="post/dislike_post.php?post='.$post_id.'" id="dislike">
        Dislikes: <button type="submit" class="dislike-post" '.$disable_dislike.'><span>'.$dislikes.'</span></button>
    </form>
    ');

echo '<hr noshade>';
//echo 'Комментарии: '.$comments_count['Rows'].' ';
echo '<span title="Дата добавления">'.$addtime.'</span> | ';
echo '<span title="Дата последнего изменения">'.$last_edit.'</span><hr noshade>';

if (!isset($_SESSION['login']))
{
	echo "Только зарегистрированные пользователи могут оставлять комментарии...";
}
else
{
	print_r('
		<form method="post" action="">            
			<p><textarea   id="add-comment"  name="add-comment"    placeholder="Комментировать…" 	class="ui-corner-all"></textarea></p>
			<p><button     id="add-comment-submit">Отправить</button></p>
		</form>
	');

$comments = mysql_query("SELECT * FROM `news_comments` WHERE post_id='$post_id' ORDER BY comment_id");
if (mysql_num_rows($comments) > 0)
{
    $res = mysql_fetch_array($comments);
    do{
        $comment_addtime = date('d/m/Y H:i', strtotime($res['addtime']));

        $author = mysql_fetch_array(mysql_query("SELECT login FROM users WHERE id='$res[author]'"));

        echo '<hr noshade>';
        echo '<p><strong>'.$author['login'].'</strong><br>';
        echo $res['comment'].'</p>';
        echo '<p>'.$comment_addtime.'</p>';
    }
    while ($res = mysql_fetch_array($comments));
}
else
{
    echo "Ваш комментарий будет первым...";
}
};      
?>

<script src="post/post.js"></script>
