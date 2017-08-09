<html>
<head>
<title></title>
<!--  <link rel="stylesheet" href="bootstrap.css"/> -->
</head>
<body>

<div id="disp_data"></div>

<script type="text/javascript">
//disp_data();
function disp_data(r){
	
	var id=r.id;
	alert("delete no."+id+" successfully!");
	//alert("delete no"id);
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","del.php?status=disp&id="+id,false);
	xmlhttp.send(null);
	document.getElementById("disp_data").innerHTML=xmlhttp.responseText;
    var i = r.parentNode.parentNode.rowIndex;
	
	document.getElementById('tb').deleteRow(i);
	//document.getElementById('tb').deleteRow(i);
	
}
function del(r){
	
	
	var DeletId=r.id;
	alert(DeletId);
	
	var i = r.parentNode.parentNode.rowIndex;
	
	document.getElementById('tb').deleteRow(i);
	
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","del.php?status=disp&id="+id,false);
	xmlhttp.send(null);
	document.getElementById("disp_data").innerHTML=xmlhttp.responseText;
	//disp_data();
	/*
	$.ajax({
		type:"post",
		url:"del.php",
		data:DeletId,
		cache:false,
		success:function(html){
			$.('msg').html(html);
		}
	});
	*/
	
}


</script>
</body>
<script>

function CheckRes(){
	
    var e1 = document.getElementById("Type1");
    var strUser1 = e1.options[e1.selectedIndex].text;

    var e2 = document.getElementById("Type2");
    var strUser2 = e2.options[e2.selectedIndex].text;

    var e3=document.forms['myf']['Name'].value;
    if(e3=="" && strUser1=='N/A' && strUser2=='N/A'){
	    alert("Use at least one tool to search!!");
        }else{
	     if(strUser1==strUser2 &&strUser1!='N/A'){
	        alert("Duplicated Types!!");
	         Kong();
         }
        }
}
</script>
</html>

<script type="text/javascript" ></script>
<?php
$dbconnect = mysqli_connect("localhost","root","950707","database");
  // mysqli_close($dbconnect);
     //$cat_sql="SELECT * FROM `database`.types;";
     $cat_sql="CALL `database`.`PrintTypes`();";
	 $cat_query=mysqli_query($dbconnect,$cat_sql);
	 $cat_rs=mysqli_fetch_assoc($cat_query);

	 $Type1=$_POST['Type1'];
	 $Type2=$_POST['Type2'];
	 $Name=$_POST['Name'];
	 	 if($Type1==""){
	      $Type1="N/A";
        }

       if($Type2==""){
	      $Type2="N/A";
       }

?>
<script>
function Kong(){
	
	document.getElementById("Name").value="";
	document.getElementById("Type1").value="N/A";
	document.getElementById("Type2").value="N/A";
	
	
}


</script>

<form name ="myf" method="post" action="">
<table width="600" border="0" cellpadding="0" cellspacing="0">
   <tr>
      <!--<td width="280" height="41" align="center"><span class="style2">Select Types:</span></td>-->
	  Search By Name or Prefix:
	  <input type="text" name = "Name" id="Name" value= "<?php echo $Name;?>"><span class="error"><?php echo $Err;?></span><br><br>
	  
	   <td width="300">Filter By Types:
	       <select name="Type1" id="Type1" Onchange="http://localhost/Web/index.php" size=1>
		    <?php
			    do{
			?><option value=<?php echo $cat_rs['TypeName']?> <?php if($Type1==$cat_rs['TypeName']){?> selected="selected"<?php }?>><?php echo $cat_rs['TypeName']?></option><?php
					
				}while($cat_rs=mysqli_fetch_assoc($cat_query));
				mysqli_free_result($cat_query);
				$dbconnect->next_result();
				//mysqli_close($dbconnect);
				//$dbconnect = mysqli_connect("localhost","root","950707","database");
			?>
		   </select>&nbsp;&nbsp;&nbsp
		   <?php
		    
             //$cat_sql="SELECT * FROM `database`.types;";
		     $cat_sql="CALL `database`.`PrintTypes`();";
	         $cat_query=mysqli_query($dbconnect,$cat_sql);
	         $cat_rs=mysqli_fetch_assoc($cat_query);
	        

           ?>
           <select name="Type2" id="Type2" size=1>
		   <?php
			    do{
			?><option value=<?php echo $cat_rs['TypeName']?> <?php if($Type2==$cat_rs['TypeName']){?> selected="selected"<?php }?>><?php echo $cat_rs['TypeName']?></option><?php
					
				}while($cat_rs=mysqli_fetch_assoc($cat_query));
				
				$dbconnect->next_result();
				    
			?>
		    
		   </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
		   <script>document.write('<br>');</script>

           <script>document.write('<br>');</script>
		   <input type = "Submit" name ="Submit" value="Submit"  onclick ="CheckRes()"/>&nbsp;&nbsp;&nbsp;&nbsp;
		   <input type = "button" value="Reset" onclick="Kong()"/>
		   </td>
		   
		   
	</tr>
	
</table>

</form><br/><br/>
<?php
     if($Type1!=$Type2){
		 if($Type1=='N/A'){
		    $pm_sql="Select * From pokedex where (Type1=\"" . $Type2 . "\" or Type2=\"" . $Type2 ."\")";
	     }else if($Type2=='N/A'){
		    $pm_sql="Select * From pokedex where (Type1=\"" . $Type1 . "\" or Type2=\"" . $Type1 ."\")";
	     }else{
		    $pm_sql="Select * From pokedex where ((Type1=\"" . $Type1 . "\" and Type2=\"" . $Type2 ."\") or ( Type1=\"" . $Type2 . "\" and Type2=\"" . $Type1 ."\"))";
	     }
	 //$pm_sql="CALL `database`.`Search_PM`(\"" . $Type1 . "\",\"" . $Type2 . "\");";
	 $pm_sql2="and Name LIKE CONCAT(\"". $Name . "\",'%')";
	 $pm_sql=$pm_sql . $pm_sql2;
	 //echo $pm_sql;
		 
	 }else{
		 if($Name!=""){
			 $pm_sql="SELECT * FROM pokedex WHERE Name LIKE CONCAT(\"". $Name . "\",'%');";
		 }
		 
	 }
	 
	// echo $Type1 . "  " . $Type2;
	
	//$pm_sql="SELECT * FROM pokedex WHERE Name LIKE CONCAT(\"". $Name . "\",'%');";
	//$result = mysqli_query($dbconnect,$pm_sql);
	
	 //echo $pm_sql2;
	 /*
	 if($Type1=='N/A' && $Type2=='N/A'){
		 $pm_sql=$pm_sql2;
		 
	 }else{
		 $pm_sql3=$pm_sql . "intersect " . $pm_sql2;
		 echo $pm_sql3;
	 }*/
	$result = mysqli_query($dbconnect,$pm_sql);
	if($result->num_rows==0){
	    if($Type1!="N/A" || $Type2!="N/A" || $Name!=""){
	        echo "<b><font color=red>0 RESULTS!! PLEASE TRY SOME OTHER KEYWORDS</font></b>";
	    }
	    
	}
	?>
	

	<link rel="stylesheet" href="jpage.css"> 
<script type="text/javascript" src="jquery.js"></script> 
<script src="jpage.js"></script>
 <script>
  $(function(){
    $("div.holder").jPages({
      containerID : "movies", 
      previous : "Previous", 
      next : "Next",
      perPage : 5,
      delay : 20 
    });
  });
  </script>
  <div class="holder"></div>

      <table border="1" id="tb" bordercolor="green" cellspacing="0px" class=table>
        <thead><tr bgcolor=red><th>No.</th><th>Name</th><th>Type1</th><th>Type2</th><th>Height ( /m )</th><th>Weight ( /kg )</th><th colspan=2 >Function</th></tr></thead>
        <tbody id="movies">
        	<script>
        	<?php
        	if($result->num_rows>0){
        	while($row=mysqli_fetch_array($result)){
        	    $str= "pm/" . $row['png'];
        	    $id=$row['no.'];
        	    
        	    ?>
        	
     
			$("#movies").append("<tr><td><img src=<?php echo $str;?>><?php echo $row['no.'];?></td><td><?php echo $row['Name'];?></td><td><?php echo $row['Type1'];?></td><td><?php echo $row['Type2'];?></td><td><?php echo $row['Height(m)'];?></td><td><?php echo $row['Weight(kg)'];?></td><td><input id=<?php echo $id; ?> type=button value=Delete onclick= disp_data(this)></td><td><a href='index.php?page=category&categoryID=2&updateid=<?php echo $row['no.'];?>' target='__blank'><input type=button value=update></td></tr>");
        	
		
      <?php }
        	    
        	    
        	    ?>
         
  <?php }else{
    if($Type1!="N/A" || $Type2!="N/A" || $Name!=""){
        echo "<b><font color=red>0 RESULTS!! PLEASE TRY SOME OTHER KEYWORDS</font></b>";
    }
  }
    ?>
    </script>
    </tbody>
  </table>
<!--! end of #container -->
	<?php
	/*
	$i=0;
	
	echo "<table id=tb border=1 border=1 bordercolor=green cellspacing=0px class=table>";
	echo "<tr bgcolor=red><th>No.</th><th>Name</th><th>Type1</th><th>Type2</th><th>Height ( /m )</th><th>Weight ( /kg )</th><th colspan=\"2\" >Function</th></tr>";
	if($result->num_rows>0){
	while($row=mysqli_fetch_array($result)){
		$str= "pm/" . $row['png'];
		$id=$row['no.'];
		
		//if($i>=$start && $i<=$end){
		        echo "<tr>";
		        echo "<td>$str= "pm/" . $row['png'];
		$id=$row['no.'];".$row['no.']."</td>";
		        echo "<td>".$row['Name']."</td>";
		        echo "<td>".$row['Type1']."</td>";
		        echo "<td>".$row['Type2']."</td>";
		        echo "<td>".$row['Height(m)']."</td>";
		        echo "<td>".$row['Weight(kg)']."</td>";
		        echo "<td><input id=".$id." type=button value=Delete onclick= disp_data(this)></td>";
		        echo "<td><a href='index.php?page=category&categoryID=2&updateid=".$row['no.']."'><input type=button value=update></a></td>";
		        echo "</tr>";
		//}        
		 $i++;
		
		}
		
		
	}else{
	    if($Type1!="N/A" || $Type2!="N/A" || $Name!=""){
	        echo "<b><font color=red>0 RESULTS!! PLEASE TRY SOME OTHER KEYWORDS</font></b>";
	    }
	}
	//onclick=del(this) 
	echo "</table>";
	echo "</br></br>";
	/*
	if($pageNow>1){
	    $prePage=$pageNow-1;
	    echo "<a href='index.php?page=category&categoryID=1?currpage=$prePage'>Previous</a>&nbsp;";
	}
	echo "&nbsp;&nbsp;";
	*/
?>



 
