 <html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<title>Pokedex</title>
</head>

<?php
//$conn=mysql_connect("localhost","root","950707") or die(mysql_error());
//$conn=mysqli_connect("sql200.0fees.us","0fe_20295141","950707","0fe_20295141_database");
//mysql_query("set names utf-8");
$dbconnect = mysqli_connect("localhost","root","950707","database");
//mysql_select_db("database",$dbconnect);
 $pageSize=10;
   $rowCount=0;
   $pageNow=1;
   if(!empty($_GET['currpage'])){
       $pageNow=$_GET['currpage'];//current page
   }
   
   $pageCount=0;//total # of pages
   $sql="select count(*) from pokedex";
   $res2=mysqli_query($dbconnect,$sql);
   if($row=mysqli_fetch_row($res2)){
       $rowCount=$row[0];
   }
   //echo $rowCount;
   
   //calculate # of pages
   $pageCount=ceil($rowCount/$pageSize);
   $sql="select * from pokedex limit ".($pageNow-1)*$pageSize.",$pageSize";
   $res=mysqli_query($dbconnect,$sql);
   echo "<table id=tb border=1 bordercolor=green cellspacing=0px>";
   echo "<tr bgcolor=red ><th>No.</th><th>Name</th><th>Type1</th><th>Type2</th><th>Height ( /m )</th><th>Weight ( /kg )</th><th colspan=\"2\" >Function</th></tr>";
   while($row=mysqli_fetch_assoc($res)){
       $str= "pm/" . $row['png'];
       $id=$row['no.'];
       echo "<tr>";
       echo "<td><img src ='".$str."'  />".$row['no.']."</td>";
       echo "<td>".$row['Name']."</td>";
       echo "<td>".$row['Type1']."</td>";
       echo "<td>".$row['Type2']."</td>";
       echo "<td>".$row['Height(m)']."</td>";
       echo "<td>".$row['Weight(kg)']."</td>";
       echo "<td><input id=".$id." type=button value=Delete onclick= disp_data(this)></td>";
       echo "<td><a href='index.php?page=category&categoryID=2&updateid=".$row['no.']."'><input type=button value=update></a></td>";
       echo "</tr>";
       
   }
   echo "<h1>List of Pokemon</h1>";
   echo "</table>";
   /*
   for($i=1; $i<$pageCount;$i++){
       echo "<a href='List.php?page=$i'>$i</a>&nbsp;";
   }
   */
   echo "</br></br>";
   if($pageNow>1){
       $prePage=$pageNow-1;
       echo "<a href='index.php?page=category&categoryID=5&currpage=$prePage'>Previous</a>&nbsp;";
   }
   echo "&nbsp;&nbsp;";
   for($i=1; $i<5; $i++){
       $p=$pageNow-5+$i;
       //$p=$p+$i;
       if($p>0){
           echo "<a href='index.php?page=category&categoryID=5&currpage=$p'>[$p]</a>&nbsp;";
       }
       
   }
   echo "&nbsp;&nbsp;";
   echo "<b>$pageNow</b>";
   echo "&nbsp;&nbsp;";
   for($i=1; $i<=5; $i++){
       $p=$pageNow+$i;
       if($p<=$pageCount){
           echo "<a href='index.php?page=category&categoryID=5&currpage=$p'>[$p]</a>&nbsp;";
       }
        
   }
   echo "&nbsp;&nbsp;";
   if($pageNow<$pageCount){
       $nextPage=$pageNow+1;
       echo "<a href='index.php?page=category&categoryID=5&currpage=$nextPage'>Next</a>&nbsp;";
   }
  // echo "<a href='#'><<</a>&nbsp;&nbsp;";
   //echo "<a href='List.php?page=$pageNow'>$pageNow</a>";
   echo "&nbsp;&nbsp;";
   //echo "<a href='#'>>></a>";
   echo "&nbsp;&nbsp;&nbsp<br/><br/>";
   echo "Current Page:$pageNow/";
   echo "Total: $pageCount pages";
   echo "&nbsp;&nbsp;&nbsp<br/><br/>";
   ?>
   <form action="" method="post">
   Jump To: <input type="text" name="pg" id="pg">
   <input type="button"  value="Go" onclick="fanye()">
   </form>
   <script>
   function fanye(){
	   var val=document.getElementById("pg").value;
	   re=new RegExp("^[0-9]+$");
	   if(val==""){
		   alert("Input Cannot Be Empty!");
	   }else{
		   if(re.test(val)){
			   if(val><?php echo $pageCount;?>||val<1){
				   alert("Please Type In an Integer between 1 and <?php echo $pageCount;?>");
			   }else{
			   window.location.href="index.php?page=category&categoryID=5&currpage="+val;
			   }
			   //alert();
		   }else{
			   alert("Please Type in an integer number!!");
		   }
	   }
	   //alert(val);
	   document.getElementById("pg").value="";
	   
   }
   </script>
   <?php
   mysql_free_result($res);
   mysql_free_result($res2);
   mysql_close($conn);
?>
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

function cdelete(val){
    return window.confirm("Are you sure you want to delete the no."+val+"?");
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
</html>
