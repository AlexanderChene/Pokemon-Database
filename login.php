<?php
//This file is the base for all pages in the site. When creating a new page, we just open this one, then save a copy as the new page.
      include("dbconnect.php");
?>
 <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Loading……</title>
</head>
<?php 
     


session_start();
$username=$_REQUEST["username"];
$password=$_REQUEST["password"];
//echo $username;
//echo $password;
//mysql_select_db("test",$dbconnect);
$dbusername=null;
$dbpassword=null;
$user_sql="select * from users where username='" . $username . "';";
$result=mysqli_query($dbconnect,$user_sql);
//echo "select * from users where username='" . $username . "';";
while($row=mysqli_fetch_array($result)){
	$dbusername= $row['username'];
	$dbpassword= $row['password'];
}
//echo $dbusername;
//echo $dbpassword;
if(is_null($dbusername)){
?>
<script>
alert("User Not Found!!");
window.location.href="login.html";
</script>
<?php
}else{
	if($dbpassword!=$password){

?>
<script>
alert("Wrong password!!");
window.location.href="login.html";
</script>
<?php
}
else{
	$_SESSION['username']=$username;
	$_SESSION['code']=mt_rand(0,1000000);
	?>
	<script>
	window.location.href="index.php";
	</script>
	<?php
}
}
mysqli_close($dbconnect);
?>
</body>
</html>




