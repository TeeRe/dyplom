<?php
include("../mysql.php");
header('Content-Type: text/html; charset=utf-8');

$sql = mysql_query("SELECT * FROM `project_news` WHERE `delete`='false' ORDER BY `id` DESC");

if (mysql_num_rows($sql) > 0)
{
    $result = mysql_fetch_array($sql);
    do{
			$addtime = date('d/m/Y H:i', strtotime($result['addtime']));

            echo '<hr noshade><h1>'.$result["topic"];
            echo '</h1><p>'.preg_replace('/\n/', '<br />', $result["text"]).'</p>';
			echo '<hr noshade><span title="Дата добавления">'.$addtime.'</span><hr noshade><br><br>';
    }
    while ($result = mysql_fetch_array($sql));
};
?>