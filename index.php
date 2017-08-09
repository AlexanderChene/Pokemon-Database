<?php
//This file is the base for all pages in the site. When creating a new page, we just open this one, then save a copy as the new page.
      include("dbconnect.php");
?>
<html>
<head>
<title>Pokemon Database</title>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
session_start();
if(isset($_SESSION["code"])){
	
}else{
?>
<script>
alert("Please Log In First!!");
window.location.href="exit.php";
</script>
<?php
}
?>
<div class="container">
	<?php
	     include("header.php");
		 //check to see if user is visiting a page other than the home page
          if(!isset($_GET['page'])){
			  ?><div class = "banner"><img src = "images/Ban.png" alt="Pokemon go" /></div>
			  <?php
		  }		 
	?>
	
    <div class="maincontent">
	     <?php
		     if(!isset($_GET['page'])){
				 include("home.php");
			 }else{
				 $page=$_GET['page'];
				 include("$page.php") ;
			 }
		 
		 ?>
	
 <!-- main content goes here-->
      <p ></p>
  </div>
  <?php
      //include("seccontent.php");
  ?>

	<div class="footer"></div>
</div><!-- Container ends here-->
</body>
</html>
