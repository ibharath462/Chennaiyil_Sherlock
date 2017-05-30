<?php




	error_reporting(E_ALL);
	ini_set('display_errors', 'On');



	if(isset($_POST["bw"])){

		
		$host="localhost"; // Host name 
		$username="gauthack"; // Mysql username 
		$password="jomithaM1"; // Mysql password 
		$db_name="HOD_vision17"; // Database name 
		$tbl_name="HOD_vision17_bw"; // Table name 

		$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
	    mysqli_select_db($con,$db_name)or die("cannot select DB");

	    $decoded = json_decode($_POST["bw"]);

	    $sql="INSERT INTO $tbl_name(v17P1Name,v17P1College,v17P1Mail,v17P1Mobile,v17P2Name,v17P2College,v17P2Mail,v17P2Mobile,v17P3Name,v17P3College,v17P3Mail,v17P3Mobile,v17P4Name,v17P4College,v17P4Mail,v17P4Mobile) VALUES('$decoded->v17P1Name,'$decoded->v17P1College','$decoded->v17P1Mail','$decoded->v17P1Mobile','$decoded->v17P2Name,'$decoded->v17P2College','$decoded->v17P2Mail','$decoded->v17P2Mobile','$decoded->v17P3Name,'$decoded->v17P3College','$decoded->v17P3Mail','$decoded->v17P3Mobile','$decoded->v17P4Name,'$decoded->v17P4College','$decoded->v17P4Mail','$decoded->v17P4Mobile')";

	   $result=mysqli_query($con,$sql);

	   if(! $result ) {
	      die('Could not enter data: ' . mysqli_error($con));
	   }

	   else{
	   	echo "Inserted";
	   }


	}



?>