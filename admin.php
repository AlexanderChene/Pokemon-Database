<?php
     $cat_sql="SELECT * FROM `database`.types";
	 $cat_query=mysqli_query($dbconnect,$cat_sql);
	 $cat_rs=mysqli_fetch_assoc($cat_query);

?>

