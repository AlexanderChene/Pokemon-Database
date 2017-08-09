<?php
     $cat_sql="SELECT * FROM `database`.types";
	 $cat_query=mysqli_query($dbconnect,$cat_sql);
	 $cat_rs=mysqli_fetch_array($cat_query);
	 $Type1=$_POST['Type1'];
	 $Type2=$_POST['Type2'];
//66666

?>
<?php

if($_GET['updateid']!=''){
	$id=$_GET['updateid'];
    echo "<h1>Let's update!!</h1>";
	$update_sql="SELECT * FROM pokedex where `no.`=" . $id . ";";
	$update_query=mysqli_query($dbconnect,$update_sql);
	$update_rs=mysqli_fetch_array($update_query);
	$update_id=$update_rs['no.'];
	$update_Name=$update_rs['Name'];
	$update_Height=$update_rs['Height(m)'];
	$update_Weight=$update_rs['Weight(kg)'];
	$update_Type1=$update_rs['Type1'];
	$update_Type2=$update_rs['Type2'];
	//echo $update_rs['Name'];
	/*
    echo '<script type="text/javascript">',
     '<h1>Let\'s update!!</h1>',
     '</script>'
    ;
	*/
}else{
	echo "<h1>DIY Your Pokemon</h1>";
    echo '<script type="text/javascript">',
            '<h1>DIY Your Pokemon</h1>',
            '</script>'
            
     ;
}




?>

<script>document.write('<br>');</script>
<script>document.write('<br>');</script>



<?php


$Name=$update_Name;
$Height=$update_Height;
$Weight=$update_Weight;
$Type1=$update_Type1;
$Type2=$update_Type2;
if($Type1==""){
	      $Type1="N/A";
        }

       if($Type2==""){
	      $Type2="N/A";
       }
$heightErr="";
$nameErr="";
$typeErr="";
$typeCheck=0;

function format_input($data){
	return $data;
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	
	if(empty($_POST['Name'])){
		$nameErr="Name can not be empty!!";
	}else{
		$Name=format_input($_POST['Name']);
		
	}
	
	if(empty($_POST['Height'])){
		$heightErr="Height cannot be empty!!";
	}else if(!(is_float($_POST['Height'])||is_numeric($_POST['Height']))){
		$heightErr="Height must be a number!!";
	}else{
		$Height=format_input($_POST['Height']);
	}
	if(empty($_POST['Weight'])){
		$weightErr="Weight cannot be empty!!";
	}else if(!(is_float($_POST['Weight'])||is_numeric($_POST['Weight']))){
		$weightErr="Weight must be a number!";
	}else{
		$Weight=format_input($_POST['Weight']);
	}
	
	 	 
	 if($_POST['Type1']=='N/A' && $_POST['Type2']=='N/A'){
		$typeErr="At leaste select one type!!";
	}else if($_POST['Type1']==$_POST['Type2']){
		$typeErr="Duplicated Types";
	}else{
		$typeCheck=1;
		$Type1=$_POST['Type1'];
		$Type2=$_POST['Type2'];
			
		
	}
	
	
}


?>

<script>
function Kong(){
	document.getElementById("Name").value="";
	document.getElementById("Height").value="";
	document.getElementById("Weight").value="";
	document.getElementById("Type1").value="N/A";
	document.getElementById("Type2").value="N/A";
	
}


</script>

<html>
<head>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.js"></script>

</head>
<body>
<form name = "AddPM" action ="index.php?page=category&categoryID=2&updateid=<?php echo $update_id?>" method="POST" autocomplete="on">

<tr><td>Name: <input type = "text" name="Name" id= "Name" value= "<?php echo $Name;?>"Size=20 ><span class="error" ><?php echo $nameErr;?></span></td></tr>
<script>document.write('<br>');</script>

<script>document.write('<br>');</script>
<tr>
      <td width="280" height="41" align="center"><span class="style2">Select Types:</span></td>
	  
	   <td width="300">
	  
	       <select name="Type1" id="Type1" size=1>
		   <?php
			    do{
			?><option value=<?php echo $cat_rs['TypeName']?> <?php if($Type1==$cat_rs['TypeName']){?> selected="selected"<?php }?>><?php echo $cat_rs['TypeName']?></option><?php
					
				}while($cat_rs=mysqli_fetch_assoc($cat_query))	
			?>
		   </select>&nbsp;&nbsp;&nbsp
		   
		   
		   <?php
             $cat_sql="SELECT * FROM `database`.types";
	         $cat_query=mysqli_query($dbconnect,$cat_sql);
	         $cat_rs=mysqli_fetch_assoc($cat_query);

           ?>
           <select name="Type2" id="Type2" size=1>
		   <?php
			    do{
			?><option value=<?php echo $cat_rs['TypeName']?> <?php if($Type2==$cat_rs['TypeName']){?> selected="selected"<?php }?>><?php echo $cat_rs['TypeName']?></option><?php
					
				}while($cat_rs=mysqli_fetch_assoc($cat_query))	
			?>
		    
		   </select>
		   <span class="error"><?php echo $typeErr;?></span>
		   </td>
	
		   
		   
	</tr>
	<script>document.write('<br>');</script>
	
    <script>document.write('<br>');</script>
	<tr><td>Height ( /m ): <input name="Height" id="Height" value= "<?php echo $Height; ?>"><span class="error"><?php echo $heightErr;?></span></td></tr>
	<script>document.write('<br>');</script>
	
    <script>document.write('<br>');</script>
	<tr><td>Weight ( /kg ): <input name="Weight" id="Weight" value= "<?php echo $Weight;?>"><span class="error"><?php echo $weightErr;?></span></td></tr>
	<script>document.write('<br>');</script>
	<script>document.write('<br>');</script>
	<script>document.write('<br>');</script>
	<?php if($_GET['updateid']==''){?>
	<input type = "submit" name ="Submit" value="Submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
	<?php }else{?>
	<input type="submit" name="update" value="Update"/>
	<a href=http://localhost/web/index.php?page=category&categoryID=5><input type="button" name="Quit" value="Quit Editing"/></a>
	<?php } ?>
	<input type = "button" value="Clear" onclick="Kong()"/>
	
</form>
</body>
</html>

<!-- change the autocomplete size -->
<script>
var countries = [
                 { value: 'Andorra', data: 'AD' },
                 // ...
                 { value: 'Zimbabwe', data: 'ZZ' }
              ];
				
$('#ame').autocomplete({
    width:500,
    lookup:countries,
    onSelect: function (suggestion) {
        alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
    }
    
  });
$('#eight').autocomplete({
    width:10,
    onSelect: function (suggestion) {
        alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
    }
    
  }); 
$('#eight').autocomplete({
    width:10,
    onSelect: function (suggestion) {
        alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
    }
    
  }); 
</script>
	
<script>

function CheckRes(){
var e1 = document.getElementById("Type1");
var strUser1 = e1.options[e1.selectedIndex].text;

var e2 = document.getElementById("Type2");
var strUser2 = e2.options[e2.selectedIndex].text;

if(strUser1=='N/A' && strUser2=='N/A'){
	alert("At Least Select One Type To Search!!");
}else if(strUser1==strUser2){
	alert("Duplicated Types!!");
}else{
	<?php
     $select_value=$_POST['Type1'];
	 echo $select_value;
     ?>
}	
}
</script>

<?php

	//echo "<br/>name:" . $Name;
//echo "<br/>Type1:" . $Type1;
//echo "<br/>Type2:" . $Type2;
//echo "<br/>Height:" . $Height;
//echo "<br/>Weight:" . $Weight;
?>
<?php
if($_GET['updateid']==''){
if($typeCheck==1 && $Name!='' && $Height!='' && $Weight!=''){
if($Type1=='N/A'){
	$Type1='';
}
if($Type2=='N/A'){
	$Type2='';
}
//$add_sql = "CALL `database`.`Add_PM`(\"" . $Name . "\"," . $Height . "," . $Weight . ",\"" . $Type1 . "\",\"" . $Type2 . "\");";
//echo $add_sql;
$add_sql="INSERT INTO pokedex(`Name`,`Height(m)`,`Weight(kg)`,`Type1`,`Type2`,`png`)VALUES(\"" . $Name . "\"," . $Height . "," . $Weight . ",\"" . $Type1 . "\",\"" . $Type2 . "\",'q.png');";

//echo $add_sql;
$rs=mysqli_query($dbconnect,$add_sql);


echo "Added successfully!!";
echo '<script type="text/javascript">',
     'Kong()',
	 '</script>'
;
	//echo "<br/>name:" . $Name;
//echo "<br/>Type1:" . $Type1;
//echo "<br/>Type2:" . $Type2;
//echo "<br/>Height:" . $Height;
//echo "<br/>Weight:" . $Weight;
	
}

}else{
	$update_sql="UPDATE pokedex SET `Name` =\"" . $Name . "\",`Height(m)` = " . $Height . ",`Weight(kg)` =" . $Weight . ",`Type1` =\"" . $Type1 . "\",`Type2` =\"" . $Type2 . "\",`image` = 'png'WHERE `no.` =" . $id . ";";
	$rs=mysqli_query($dbconnect,$update_sql);
    // echo $update_sql;
   	//echo "Update successfully!!";
}



?>