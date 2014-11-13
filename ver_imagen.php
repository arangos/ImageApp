<?php 

$con = mysql_connect("localhost","root","");
$querys = "SELECT `path` FROM `store`";
$query = mysql_db_query("databaseimage", $querys);

while ($new = mysql_fetch_array($query)){
	$data[] = $new['path'];
}

echo json_encode($data);

?>