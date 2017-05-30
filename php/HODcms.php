<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	header("Access-Control-Allow-Origin: http://hodcms.visionceg.in");


	function getDetails($v17EventCategory){

		$host="localhost"; // Host name 
		$username="gauthack"; // Mysql username 
		$password="jomithaM1"; // Mysql password 
		$db_name="HOD_vision17"; // Database name 
		$tbl_name="HOD_vision17_events"; // Table name 

		$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
	    mysqli_select_db($con,$db_name)or die("cannot select DB");

	    if($v17EventCategory == "Technical"){

	    	$sql="SELECT * FROM $tbl_name WHERE v17EventCategory='$v17EventCategory'";
			

	    }

	    else if($v17EventCategory == "General"){

	    	$sql="SELECT * FROM $tbl_name WHERE v17EventCategory='$v17EventCategory'";
			
	    }

	    else{

	    	$sql="SELECT * FROM $tbl_name WHERE v17EventCategory='$v17EventCategory'";
			

	    }

		$res=mysqli_query($con,$sql);
		$json_array = null;

		while($result = mysqli_fetch_array($res)) {
        	
			if($json_array == null){

				$json_array[0] = 	["v17EventName" => $result["v17EventName"], "v17EventShort" => $result["v17EventShort"], "v17EventImageUrl" => $result["v17EventImageUrl"]];
				

			}
			else{
					$t = ["v17EventName" => $result["v17EventName"], "v17EventShort" => $result["v17EventShort"], "v17EventImageUrl" => $result["v17EventImageUrl"]];
					array_push($json_array, $t);
				
			}



      	}


		echo json_encode($json_array);

	}


	function getEventDetails($v17EventName){

		$host="localhost"; // Host name 
		$username="gauthack"; // Mysql username 
		$password="jomithaM1"; // Mysql password 
		$db_name="HOD_vision17"; // Database name 
		$tbl_name="HOD_vision17_events"; // Table name 

		$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
	    mysqli_select_db($con,$db_name)or die("cannot select DB");

	    $sql="SELECT * FROM $tbl_name WHERE v17EventName='$v17EventName'";


		$res=mysqli_query($con,$sql);
		$json_array = null;

		while($result = mysqli_fetch_array($res)) {
        	
			if($json_array == null){

				$json_array[0] = 	["v17EventName" => $result["v17EventName"], "v17EventImageUrl" => $result["v17EventImageUrl"], "v17EventLong" => $result["v17EventLong"], "v17EventRules" => $result["v17EventRules"], "v17EventContact" => $result["v17EventContact"]];
				

			}
			else{
					$t = ["v17EventName" => $result["v17EventName"], "v17EventImageUrl" => $result["v17EventImageUrl"], "v17EventLong" => $result["v17EventLong"], "v17EventRules" => $result["v17EventRules"], "v17EventContact" => $result["v17EventContact"]];
					array_push($json_array, $t);
				
			}



      	}


		echo json_encode($json_array);

	}



	function subscribe($v17EventName){


		$host="localhost"; // Host name 
		$username="gauthack"; // Mysql username 
		$password="jomithaM1"; // Mysql password 
		$db_name="HOD_vision17"; // Database name 
		$tbl_name="HOD_vision17_users"; // Table name 

		$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
	    mysqli_select_db($con,$db_name)or die("cannot select DB");

	    $v17Id = $_COOKIE['v17Id'];


	    $sql="UPDATE $tbl_name SET v17Subscriptions=CONCAT(v17Subscriptions,'$v17EventName+') WHERE v17Id = '$v17Id'";

	    $res=mysqli_query($con,$sql);



	    if(! $res ) {
	      die('Could not enter data: ' . mysqli_error($con));
	   }

	   else{
	   	echo "Success";
	   }

	}

	if(isset($_POST["getDetails"])){

		$v17EventCategory = $_POST["getDetails"];
		getDetails($v17EventCategory);
	}

	if(isset($_POST["getEventDetails"])){
		$v17EventName = $_POST["getEventDetails"];
		getEventDetails($v17EventName);
	}

	if(isset($_POST["subscribe"])){
		subscribe($_POST["subscribe"]);
	}

?>