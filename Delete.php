<h1>Let's update the Pokemon database!</h1>
<?php 
$Name="";
$Err="";
function format_input($data){
	return $data;
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	if(empty($_POST['Name'])){
            
                $Err="Input cannot be empty";
            
		
	}else{
		$Name=format_input($_POST['Name']);
		
	}
}



?>


<?php 
if((isset($_GET['deleteid']))){
	$id=$_GET['deleteid'];
        $Name=$_POST['Name'];
	//echo $id;
	//$cat_sql="CALL `database`.`Delete_PM`(" . $id . ");";
	$cat_sql="DELETE FROM pokedex where `no.`=" . $id . ";";
	$cat_query=mysqli_query($dbconnect,$cat_sql);
	$cat_rs=mysqli_fetch_array($cat_query);
	echo "Delete Successfully!";
	
	
	

	}


if((isset($_GET['updateid']))){
	
	//include("update.php");
	
}

?>
<form action ="" method="POST">
Search for Pokemon you want to delete or update by it's name or partial name:<input type="text" name = "Name" value= "<?php echo $Name;?>"><span class="error"><?php echo $Err;?></span><br><br>
<div>
<input type="submit" name = "delete" value="Search" >
</div>

</form>


<?php 
$Name=$_POST['Name'];
//echo $Name;
$pm_sql="";
$delete="delete";


if($Name!="" ){
	
	//$pm_sql="CALL `database`.`Name_Search`(\"" . $Name . "\");";
	$pm_sql="SELECT * FROM pokedex WHERE Name LIKE CONCAT(\"". $Name . "\",'%');";
	//echo $pm_sql;
	


//echo $pm_sql;
$result = mysqli_query($dbconnect,$pm_sql);



	echo "<table border=1>";
       
	echo "<tr><td>No.</td><td>Name</td><td>Type1</td><td>Type2</td><td>Height ( /m )</td><td>Weight ( /kg )</td><td colspan=\"2\" >Function</td></tr>";
	
	while($row=mysqli_fetch_array($result)){
		$str= "pm/" . $row['png'];
		echo "<tr>";
		echo "<td><img src ='".$str."'  />".$row['no.']."</td>";
		echo "<td>".$row['Name']."</td>";
		echo "<td>".$row['Type1']."</td>";
		echo "<td>".$row['Type2']."</td>";
		echo "<td>".$row['Height(m)']."</td>";
		echo "<td>".$row['Weight(kg)']."</td>";
		echo "<td><a href='index.php?page=category&categoryID=1&deleteid=".$row['no.']."&search=".$Name."'>delete</a></td>";
		echo "<td><a href='index.php?page=category&categoryID=2&updateid=".$row['no.']."'>update</a></td>";
		echo "</tr>";
	}
	
	echo "</table>";

	
}


?>

<?php 

if((isset($_GET['search']))){
	$ch=$_GET['search'];
	//echo $ch;
	//$cat_sql="CALL `database`.`Delete_PM`(" . $id . ");";
	//$cat_query=mysqli_query($dbconnect,$cat_sql);
	//$cat_rs=mysqli_fetch_array($cat_query);
	if($ch!=""){
		
	
	//$pm_sql="CALL `database`.`Name_Search`(\"" . $ch . "\");";
	$pm_sql="SELECT * FROM pokedex WHERE Name LIKE CONCAT(\"". $ch . "\",'%');";
	$result = mysqli_query($dbconnect,$pm_sql);
	echo "<table border=1>";
        if($Name!=""){
            
        }else{
            echo "<tr><td>No.</td><td>Name</td><td>Type1</td><td>Type2</td><td>Height ( /m )</td><td>Weight ( /kg )</td><td>Function</td></tr>";
        }
	
	while($row=mysqli_fetch_array($result)){
		$str= "pm/" . $row['png'];
		echo "<tr>";
		echo "<td><img src ='".$str."'  />".$row['no.']."</td>";
		echo "<td>".$row['Name']."</td>";
		echo "<td>".$row['Type1']."</td>";
		echo "<td>".$row['Type2']."</td>";
		echo "<td>".$row['Height(m)']."</td>";
		echo "<td>".$row['Weight(kg)']."</td>";
		echo "<td><a href='index.php?page=category&categoryID=3&deleteid=".$row['no.']."&search=".$ch."'>delete</a></td>";
		echo "<td><a href='index.php?page=category&categoryID=2&updateid=".$row['no.']."'>update</a></td>";
		echo "</tr>";
	}
	
	echo "</table>";
	
	

	}
}

?>


