<?php

	
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	$host="localhost"; // Host name 
	$username="gauthack"; // Mysql username 
	$password="jomithaM1"; // Mysql password 
	$db_name="HOD_vision17"; // Database name 
	$tbl_name="HOD_vision17_updates"; // Table name 



	if(isset($_POST["update"])){

		$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
		mysqli_select_db($con,$db_name)or die("cannot select DB");


		$sql="SELECT * FROM $tbl_name";
		$res=mysqli_query($con,$sql);
		$json_array = null;
		while($result = mysqli_fetch_array($res)) {
	    	
			if($json_array == null){

				$json_array[0] = 	["v17Updates" => $result["v17Updates"]];
				

			}
			else{
					$t = ["v17Updates" => $result["v17Updates"]];
					array_push($json_array, $t);
				
			}

	     }

	     echo json_encode($json_array);
	     //echo "Helo";


	}

	//echo "Helo";
	


?>