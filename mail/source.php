<?php 
include("../mysql.php");

$req = "SELECT login FROM users WHERE login LIKE '%".$_REQUEST['term']."%' "; 

$query = mysql_query($req);

while($row = mysql_fetch_array($query))
{
	$results[] = array('label' => $row['login']);
}

echo json_encode($results);
?>