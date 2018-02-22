<?php
	session_start();
	require_once("config.php");
	$Email = $_GET["Email"];
	$Acode = $_GET["Acode"];
	$_SESSION["UserEmail"]="$Email";
	
	print "checkpoint 1 <br>";
	
	// Connect
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if(!$con){
		$_SESSION["Message"] = "Connection failed: ".mysqli_connect_error();
		$_SESSION["RegState"]= -1;
		header("location: ../index.php");
		exit();
	}
	print "checkpoint 2 <br>";
	
	// Query
	$query = "select * from Users where Email='$Email' and ".
		"Acode='$Acode';";
	$result = mysqli_query($con, $query);
	
	// Check for number of returns
	$rows = mysqli_num_rows($result);
	print "$row <br>"; 
	
	if ($rows == 1){
		// Email and Acode checked out.  Set Adatetime new timestamp
		
		$Adatetime = date("Y-m-d h:i:s");
		
		$Acode2 = rand();
		
		$query2 = "UPDATE Users set Status=2, Acode='$Acode2', ".
			"Adatetime='$Adatetime';";
			
		$result2= mysqli_query($con, $query2);
		print "checkpoint 4 <br>";
		
		if (!result2) {
			$_SESSION["Message"] = "Client update failure: ".mysqli_connect_error();
			$_SESSION["RegState"]= -1;
			header("location: ../index.php");
			exit();
		}
		
		print "checkpoint 5 <br>";
		
		// Authenticated. Redirect to set password.
		$_SESSION["Message"] = "Authenticated.  Please set password";
		$_SESSION["RegState"] = 2;
		header("location: ../index.php");
		exit();
	}
	
	// Query Failed
	$_SESSION["Message"] =  "Authentication query failed: ".mysqli_error($con);
	$_SESSION["RegState"] = -1;
	header("location: ../index.php");
	exit();
	

?>