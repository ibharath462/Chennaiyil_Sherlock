<?php
	
	$host="localhost"; // Host name 
	$username="gauthack"; // Mysql username 
	$password="jomithaM1"; // Mysql password 
	$db_name="HOD_vision17"; // Database name 
	$tbl_name="HOD_vision17_users"; // Table name 

	$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
	mysqli_select_db($con,$db_name)or die("cannot select DB");


?>