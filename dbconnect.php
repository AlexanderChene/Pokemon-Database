<?php
     //$dbconnect = mysqli_connect("mysql.hostinger.com.hk","u629420208_root","950707DuoDuo","u629420208_pmdb");
	 $dbconnect = mysqli_connect("localhost","root","950707","database");
	 //$dbconnect = mysqli_connect("sql200.0fees.us","0fe_20295141","950707","0fe_20295141_database");
	  if(mysqli_connect_errno()){
		  echo "Connection failed:".mysqli_connect_error();
		  exit;
	  }

?>