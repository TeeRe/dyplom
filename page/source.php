<?php 
include("../mysql.php");

$req = "SELECT cyr_board, board FROM category_board WHERE cyr_board LIKE '%".$_REQUEST['term']."%' "; 

$query = mysql_query($req);

while($row = mysql_fetch_array($query))
{
	$results[] = array('label' => $row['cyr_board']);
}

echo json_encode($results);
?>