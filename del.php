<?php
$id=$_GET["id"];
$sql="DELETE FROM pokedex where `no.`=" . $id . ";";
$link=mysqli_connect("localhost","root","950707","database");
//mysqli_select_db($link,"database");
$res=mysqli_query($link,$sql);
$sql="ALTER TABLE pokedex AUTO_INCREMENT = 1";
$res=mysqli_query($link,$sql);
echo $sql;

?>