<?php




	error_reporting(E_ALL);
	ini_set('display_errors', 'On');


	function gSignOut(){

		include 'config.php';

	    unset($_SESSION['vision17_UserSession']);
		$_SESSION = array();
		session_destroy();
		unset($_COOKIE['PHPSESSID']);
		setcookie('PHPSESSID', '', time() - 3600, '/');
		unset($_COOKIE['v17Mail']);
		setcookie('v17Mail', '', time() - 3600, '/');
		unset($_COOKIE['v17Name']);
		setcookie('v17Name', '', time() - 3600, '/');
		unset($_COOKIE['v17Id']);
		setcookie('v17Id', '', time() - 3600, '/');
		unset($_COOKIE['v17Image']);
		setcookie('v17Image', '', time() - 3600, '/');
		unset($_COOKIE['v17Subscriptions']);
		setcookie('v17Subscriptions', '', time() - 3600, '/');
		echo "Session destroyed";
	}

	

	if(isset($_POST["param"])){

		include 'config.php';
		session_start();
		gSignOut();
	}

	if(isset($_POST["v17setCookie"])){

		include 'config.php';
		$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
	    mysqli_select_db($con,$db_name)or die("cannot select DB");

	    $sql="SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = '$tbl_name' AND table_schema = '$db_name'";

	    $result=mysqli_query($con,$sql);
	    if (!$result) {
		    die('Could not query:' . mysql_error());
		}


		$maxId = mysqli_fetch_row($result);
    	$maxId = $maxId[0];

    	
    	$vId = str_pad($maxId, 4, '0', STR_PAD_LEFT);
    	$vId = "V".$vId;
    	setcookie('v17Id', $vId, time() + 3600, '/');
    	$result = ["result" => "vId cookie set"];
	    echo json_encode($result);
	}

	if(isset($_POST["isLoggedIn"])){

		include 'config.php';
		
		session_start();
		if(isset($_SESSION["v17User"])){
			$result = ["result" => "true","status" => $_SESSION['v17User']];
			echo json_encode($result);	
		}
		else{
			$result = ["result" => "false"];
			echo json_encode($result);	
		}
	}


	if(isset($_POST["vId"])){

		$host="localhost"; // Host name 
		$username="gauthack"; // Mysql username 
		$password="jomithaM1"; // Mysql password 
		$db_name="HOD_vision17"; // Database name 
		$tbl_name="HOD_vision17_users"; // Table name 

		$mail = $_POST["mail"];
		$vId = $_POST["vId"];

		$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
	    mysqli_select_db($con,$db_name)or die("cannot select DB");

	    $sql="SELECT * FROM $tbl_name WHERE v17Mail='$mail' AND v17Id='$vId'";
	    $result=mysqli_query($con,$sql);

	    
	    if($result){

	    	$count=mysqli_num_rows($result);

		    if($count == 1){
		    	echo "true";
		    }
		    else{
		    	echo "false";
		    }

	    }

	    else{
	    	echo "Error";
	    }
	    

	    //echo "Hello";


	}

	

	if(isset($_POST["userMail"])){

		include 'config.php';
		$mail = $_POST["userMail"];
		$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
	    mysqli_select_db($con,$db_name)or die("cannot select DB");
	    $sql="SELECT * FROM $tbl_name WHERE v17Mail='$mail'";
	    $result=mysqli_query($con,$sql);
	    $value = mysqli_fetch_object($result);
	    $count=mysqli_num_rows($result);
	    if($count == 1){
	    	session_start();
	    	$_SESSION['v17User'] = $mail;
	    	setcookie('v17Id', $value->v17Id, time() + 3600, '/');
	    	$result = ["result" => "RegisteredAlready"	,"status" => $_SESSION['v17User']];
	    	setcookie('v17Subscriptions', $value->v17Subscriptions, time() + 3600, '/');
	    	echo json_encode($result);	
	    }
	    else{


	    	$sql="SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = '$tbl_name' AND table_schema = '$db_name'";
		    $result=mysqli_query($con,$sql);
		    if (!$result) {
			    die('Could not query:' . mysql_error());
			}
			$maxId = mysqli_fetch_row($result);
	    	$maxId = $maxId[0];
	    	$vId = str_pad($maxId, 4, '0', STR_PAD_LEFT);
	    	$vId = "V".$vId;
	    	setcookie('v17Id', $vId, time() + 3600, '/');
	    	$result = ["result" => "PleaseRegister"];
	    	echo json_encode($result);
	    	
	    }
	}

	if(isset($_POST["registrationDetails"])){

		include 'config.php';

		$sql="SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = '$tbl_name' AND table_schema = '$db_name'";

	    $result=mysqli_query($con,$sql);
	    if (!$result) {
		    die('Could not query:' . mysql_error());
		}


		$maxId = mysqli_fetch_row($result);
    	$maxId = $maxId[0];

    	
    	$v17Id = str_pad($maxId, 4, '0', STR_PAD_LEFT);
    	$v17Id = "V".$v17Id;

		$decoded = json_decode($_POST["registrationDetails"]);

		$sql="INSERT INTO $tbl_name(v17Id,v17Name,v17Mail,v17Mobile,v17College,v17CollegeOther,v17SA,v17Image,v17Subscriptions,v17Year,v17Department) VALUES('$v17Id','$decoded->v17Name','$decoded->v17Mail','$decoded->v17Mobile','$decoded->v17College','$decoded->v17CollegeOther','$decoded->v17SA','$decoded->v17Image','Yet','$decoded->v17Year','$decoded->v17Department')";

	   $result=mysqli_query($con,$sql);

	   if(! $result ) {
	      die('Could not enter data: ' . mysqli_error($con));
	   }

	   $sql="SELECT * FROM $tbl_name WHERE v17Mail='$decoded->v17Mail'";
	   $result=mysqli_query($con,$sql);

	   $value = mysqli_fetch_object($result);

	   setcookie('v17Subscriptions', $value->v17Subscriptions, time() + 3600, '/');

	   

	  session_start();
	  $_SESSION['v17User'] = $decoded->v17Mail;
	  unset($_COOKIE['v17Register']);
	  setcookie('v17Register', '', time() - 3600, '/');
	  setcookie('v17Id', $v17Id, time() + 3600, '/');
		
	  echo "Inserted";

	}
    

?>