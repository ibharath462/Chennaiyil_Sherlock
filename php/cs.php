<?php




	error_reporting(E_ALL);
	ini_set('display_errors', 'On');


	if(isset($_POST["isCorrectLevel"])){


		session_start();


		$level1 = $_POST["isCorrectLevel"];
		


		if(! isset($_SESSION['v17User'])){
			echo "Error";
		}

		else{

			$level2 = $_SESSION['v17Level'];
			if($level2 == $level1){
				echo "Success";
			}
			else{
				echo "Error";
			}
		}

		




	}

	else if(isset($_POST["nextMap"])){


		$host="localhost"; // Host name 
		$username="gauthack"; // Mysql username 
		$password="jomithaM1"; // Mysql password 
		$db_name="HOD_vision17"; // Database name 
		$tbl_name="HOD_cs_answers"; // Table name 

		$answer = $_POST["nextMap"];

		$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
		mysqli_select_db($con,$db_name)or die("cannot select DB");

		session_start();
		$level = $_SESSION['v17Level'];

		$sql="SELECT * FROM $tbl_name WHERE v17Level='$level'";

		$result=mysqli_query($con,$sql);

		$value = mysqli_fetch_object($result);

		$result = $value->v17Answer;



		if($answer == $result){

			$tbl_name="HOD_cs_users"; // Table name 
			$_SESSION['v17Level'] = $_SESSION['v17Level'] + 1;
			$level = $_SESSION['v17Level'];
			$user = $_SESSION['v17User'];
			$tbl_name="HOD_cs_users"; // Table name 
			$sql="SELECT * FROM $tbl_name WHERE v17Mail='$user'";
			$result=mysqli_query($con,$sql);
			$value = mysqli_fetch_object($result);
			$lat = $value->v17Lat;
	    	$lon = $value->v17Lon;
	    	setcookie('lat', $lat, time() + 3600, '/');
	    	setcookie('lon', $lon, time() + 3600, '/');
	    	$timeStamp = date('Y-m-d H:i:s');
	    	$sql = "UPDATE $tbl_name SET v17Time='$timeStamp' WHERE v17Mail='$user'";
			$result=mysqli_query($con,$sql);
			$sql = "UPDATE $tbl_name SET v17Level='$level' WHERE v17Mail='$user'";
			$result=mysqli_query($con,$sql);
			if($result){
				
				switch ($level) {

					case 2:
	    				echo "level1b.html";
						break;

					case 4:
						echo "level2b.html";
						break;					

					case 6:
						echo "level3b.html";
						break;

					case 8:
						echo "level4b.html";
						break;

					case 10:
						echo "level5b.html";
						break;

					case 12:
						echo "level6b.html";
						break;

					case 14:
						echo "level7b.html";
						break;

					case 16:
						echo "level8b.html";
						break;
					
					case 18:
						echo "level9b.html";
						break;

					default:
						# code...
						break;
				}

			}
			else{
				echo "".$result;
			}
		}

		else{
			echo "Wrong";
		}


	}

	else if(isset($_POST["registerUser"])){

		$host="localhost"; // Host name 
		$username="gauthack"; // Mysql username 
		$password="jomithaM1"; // Mysql password 
		$db_name="HOD_vision17"; // Database name 
		$tbl_name="HOD_cs_users"; // Table name 

		$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
		mysqli_select_db($con,$db_name)or die("cannot select DB");

		session_start();
		$user = $_SESSION['v17User'];

		$sql="SELECT * FROM $tbl_name WHERE v17Mail='$user'";

		$result=mysqli_query($con,$sql);
		$count=mysqli_num_rows($result);
	    if($count == 1){

	    	$value = mysqli_fetch_object($result);
	    	$_SESSION['v17Level'] = $value->v17Level;
	    	$lat = $value->v17Lat;
	    	$lon = $value->v17Lon;
	    	setcookie('lat', $lat, time() + 3600, '/');
	    	setcookie('lon', $lon, time() + 3600, '/');
	    	switch ($value->v17Level) {

	    		case 0:
	    			echo "game.html";
	    			break;

	    		case 1:
	    			echo "inner/level1a.html";
	    			break;

	    		case 2:
	    			echo "inner/level1b.html";
	    			break;

	    		case 3:
	    			echo "inner/level2a.html";
	    			break;

	    		case 4:
	    			echo "inner/level2b.html";
	    			break;

	    		case 5:
	    			echo "inner/level3a.html";
	    			break;

	    		case 6:
	    			echo "inner/level3b.html";
	    			break;

	    		case 7:
	    			echo "inner/level4a.html";
	    			break;

	    		case 8:
	    			echo "inner/level4b.html";
	    			break;

	    		case 9:
	    			echo "inner/level5a.html";
	    			break;

	    		case 10:
	    			echo "inner/level5b.html";
	    			break;

	    		case 11:
	    			echo "inner/level6a.html";
	    			break;

	    		case 12:
	    			echo "inner/level6b.html";
	    			break;

	    		case 13:
	    			echo "inner/level7a.html";
	    			break;

	    		case 14:
	    			echo "inner/level7b.html";
	    			break;

	    		case 15:
	    			echo "inner/level8a.html";
	    			break;

	    		case 16:
	    			echo "inner/level8b.html";
	    			break;

	    		case 17:
	    			echo "inner/level9a.html";
	    			break;

	    		case 18:
	    			echo "inner/level9b.html";
	    			break;

	    		case 19:
	    			echo "inner/level10a.html";
	    			break;

	    		case 20:
	    			echo "inner/level10b.html";
	    			break;
	    		
	    		default:
	    			# code...
	    			break;
	    	}
	    	//echo "ExistingUser".$value->v17Level;
	    	
	    }

	    else{

	    	$sql="INSERT INTO $tbl_name(v17Mail,v17Level,v17Lat,v17Lon,v17Time) VALUES('$user','0','13.008','80.213','0')";

	   		$result=mysqli_query($con,$sql);

	   		if(! $result ) {
	      		die('Could not enter data: ' . mysqli_error($con));
	   		}

	   		else{

	   			$_SESSION['v17Level'] = 0;
	   			echo "../game.html";
	   		}

	    }




	}	

	else if(isset($_POST["nextPuzzle"])){

		$host="localhost"; // Host name 
		$username="gauthack"; // Mysql username 
		$password="jomithaM1"; // Mysql password 
		$db_name="HOD_vision17"; // Database name 
		$tbl_name="HOD_cs_users"; // Table name 

		$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
		mysqli_select_db($con,$db_name)or die("cannot select DB");

		session_start();
		$user = $_SESSION['v17User'];
		$level = $_SESSION['v17Level'];
		$level = $level + 1;
		$_SESSION['v17Level'] = $_SESSION['v17Level'] + 1;
		$lat = $_COOKIE['lat'];
		$lon = $_COOKIE['lng'];
		$timeStamp = date('Y-m-d H:i:s');

		$sql = "UPDATE $tbl_name SET v17Level='$level' , v17Time='$timeStamp' , v17Lat='$lat' , v17Lon='$lon' WHERE v17Mail='$user'";

		$result=mysqli_query($con,$sql);



		switch ($level) {

			case 3:
				echo "level2a.html";
				break;

			case 5:
				echo "level3a.html";
				break;					

			case 7:
				echo "level4a.html";
				break;

			case 9:
				echo "level5a.html";
				break;

			case 11:
				echo "level6a.html";
				break;

			case 13:
				echo "level7a.html";
				break;

			case 15:
				echo "level8a.html";
				break;

			case 17:
				echo "level9a.html";
				break;
			
			default:
				# code...
				break;
		}



	}

	else if(isset($_POST["getLeaderBoard"])){
	}

	else if(isset($_POST["skipLevel"])){


		session_start();

		if(isset($_SESSION['v17Level'])){

			switch ($_SESSION['v17Level']) {

	    		case 0:
	    			echo "game.html";
	    			break;

	    		case 1:
	    			echo "inner/level1a.html";
	    			break;

	    		case 2:
	    			echo "inner/level1b.html";
	    			break;

	    		case 3:
	    			echo "inner/level2a.html";
	    			break;

	    		case 4:
	    			echo "inner/level2b.html";
	    			break;

	    		case 5:
	    			echo "inner/level3a.html";
	    			break;

	    		case 6:
	    			echo "inner/level3b.html";
	    			break;

	    		case 7:
	    			echo "inner/level4a.html";
	    			break;

	    		case 8:
	    			echo "inner/level4b.html";
	    			break;

	    		case 9:
	    			echo "inner/level5a.html";
	    			break;

	    		case 10:
	    			echo "inner/level5b.html";
	    			break;

	    		case 11:
	    			echo "inner/level6a.html";
	    			break;

	    		case 12:
	    			echo "inner/level6b.html";
	    			break;

	    		case 13:
	    			echo "inner/level7a.html";
	    			break;

	    		case 14:
	    			echo "inner/level7b.html";
	    			break;

	    		case 15:
	    			echo "inner/level8a.html";
	    			break;

	    		case 16:
	    			echo "inner/level8b.html";
	    			break;

	    		case 17:
	    			echo "inner/level9a.html";
	    			break;

	    		case 18:
	    			echo "inner/level9b.html";
	    			break;

	    		case 19:
	    			echo "inner/level10a.html";
	    			break;

	    		case 20:
	    			echo "inner/level10b.html";
	    			break;
	    		
	    		default:
	    			# code...
	    			break;
	    	}
	    	

		}
		else{
			echo "Error";
		}


	}

	else if(isset($_POST["go"])){


		$host="localhost"; // Host name 
		$username="gauthack"; // Mysql username 
		$password="jomithaM1"; // Mysql password 
		$db_name="HOD_vision17"; // Database name 
		$tbl_name="HOD_cs_users"; // Table name 


		$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
		mysqli_select_db($con,$db_name)or die("cannot select DB");

		session_start();

		if( $_SESSION['v17Level'] == 0){

			$_SESSION['v17Level'] = $_SESSION['v17Level'] + 1;
			$level = $_SESSION['v17Level'];
			$user = $_SESSION['v17User'];
			$sql = "UPDATE $tbl_name SET v17Level='$level' WHERE v17Mail='$user'";
			$result=mysqli_query($con,$sql);
			if($result){
				echo "Get Sherlocked.....";
			}
			else{
				echo "".$result;
			}
				
		}
		


	}

	else if(isset($_POST["save"])){

		$host="localhost"; // Host name 
		$username="gauthack"; // Mysql username 
		$password="jomithaM1"; // Mysql password 
		$db_name="HOD_vision17"; // Database name 
		$tbl_name="HOD_cs_users"; // Table name 

		$con = mysqli_connect($host, $username, $password)or die("cannot connect"); 
		mysqli_select_db($con,$db_name)or die("cannot select DB");

		session_start();
		$user = $_SESSION['v17User'];
		$lat = $_COOKIE['lat'];
		$lng = $_COOKIE['lng'];

		$sql = "UPDATE $tbl_name SET v17Lat='$lat' , v17Lon='$lng' WHERE v17Mail='$user'";

		$result=mysqli_query($con,$sql);


		if(!$result){
			echo "Error";
		}

		else{

			echo "Saved!";
		}




	}


?>