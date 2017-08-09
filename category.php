

<?php
  $fun = $_GET['categoryID'];
  
 if($fun==1){
	 include("Search.php");
 }
 if($fun==2){
	 include("Add.php");
 }
  
 if($fun==3){
	 include("Delete.php");
 }
 
if($fun==4){
	include("Admin.php");
}

if($fun==5){
    include("List.php");
}

?>