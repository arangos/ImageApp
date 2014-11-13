<?php

//conexion con la base de datos
mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("databaseimage") or die(mysql_error());


$id = addslashes($_REQUEST['id']);

$image = mysql_query("SELECT * FROM store WHERE id=$id");
$image = mysql_fetch_assoc($image);
$image = $image['image'];

header("Content-type: image/jpg");

echo $image;
?>
