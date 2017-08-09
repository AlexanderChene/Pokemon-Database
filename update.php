<?php 
echo "working";
?>

	$.post('del.php',{postid:DeletId},
	fuction(data){
		$('#result').html(data);
	}
	
	
	);
<?php
//$update_Name="";

	echo "<h1>Let's update~~~</h1>";
        $id=$_GET['updateid'];
        //$update_sql="CALL `database`.`ID_Search`(" . $id . ");";
		$update_sql="Select * From `database`. `Pokedex` where `no.`=" . $id . ";";
        $update_query=mysqli_query($dbconnect,$update_sql);
        $update_rs=mysqli_fetch_array($update_query);
	$update_Name=$update_rs['Name'];
        $update_Weight=$update_rs['Weight(kg)'];
        $update_Height=$update_rs['Height(m)'];
        $update_Type1=$update_rs['Type1'];
        $update_Type2=$update_rs['Type2'];
		
        //echo $update_Type1;
        //echo $update_Type2;
        //echo $update_Name;
        




?>

<script>document.write('<br>');</script>
<script>document.write('<br>');</script>



<?php

//echo $update_Name;

$Name=$update_Name;
$Weight=$update_Weight;
$Height=$update_Height;
$Type1=$update_Type1;
if($Type1==""){
	$Type1="N/A";
}
$Type2=$update_Type2;
if($Type2==""){
	$Type2="N/A";
}
$heightErr="";
$nameErr="";
$typeErr="";
$typeCheck=0;
//echo $Type1;
//echo $Type2;
function format_input($data){
	return $data;
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	//

        if(empty($_POST['Name'])){
           $nameErr="Name can not be empty!!";
           //echo "66";
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

 
<?php
     $cat_sql="SELECT * FROM `database`.types";
	 $cat_query=mysqli_query($dbconnect,$cat_sql);
	 $cat_rs=mysqli_fetch_array($cat_query);
	 

?>
<script>
function validate_required(field, alerttxt){
	with(field){
		if(value==null||value==""){
			alert(alerttxt);
			return false
		}else{
			
			return true
		}
	}
}
function validationForm(thisform){
	with(thisform){
		if(validate_required(Name,"Name must be filled out!!")==false){
			name.focus();
			return false;
		}
	}
	
	
	
}


</script>


<form name = "UpdatePM" action =""  method="POST">

<tr><td>Name: <input type = "text" name="Name" id= "Name" value= "<?php echo $Name;?>"Size=20><span class="error"><?php echo $nameErr;?></span></td></tr>
<script>document.write('<br>');</script>

<script>document.write('<br>');</script>
<tr>
      <td width="280" height="41" align="center"><span class="style2">Select Types:</span></td>
	  
	   <td width="300">
	  
	       <select name="Type1" id="Type1" size=1>
		   <?php
			    do{
			?><option value=<?php echo $cat_rs['TypeName']?> <?php if($Type1==$cat_rs['TypeName']){?> selected="selected"<?php }?>><?php echo $cat_rs['TypeName']?></option><?php
					
				}while($cat_rs=mysqli_fetch_array($cat_query))	
			?>
		   </select>&nbsp;&nbsp;&nbsp
		   
		   
		   <?php
                 $cat_sql="SELECT * FROM `database`.types";
	         $cat_query=mysqli_query($dbconnect,$cat_sql);
	         $cat_rs=mysqli_fetch_array($cat_query);

           ?>
           <select name="Type2" id="Type2" size=1>
		   <?php
			    do{
			?><option value=<?php echo $cat_rs['TypeName']?> <?php if($Type2==$cat_rs['TypeName']){?> selected="selected"<?php }?>><?php echo $cat_rs['TypeName']?></option><?php
					
				}while($cat_rs=mysqli_fetch_array($cat_query))	
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
	
	
	<input type="submit" name="Update" value="Update" >

	
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
	<input type = "button" value="Clear" onclick="Kong()"/>
	
	
	
</form>

	





<?php

if($typeCheck==1 && $Name!='' && $Height!='' && $Weight!=''){
	
if($Type1=='N/A'){
	$Type1='';
}
if($Type2=='N/A'){
	$Type2='';
}

	
		$update_sql = "Call `database`.`Update_PM`(" . $id . ",\"" . $Name . "\"," . $Height . "," . $Weight . ",\"" . $Type1 . "\",\"" . $Type2 . "\");";
        echo $update_sql;
        $rs=mysqli_query($dbconnect,$add_sql);
		echo "Update successfully!!";


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





?>