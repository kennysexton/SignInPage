<?php
	session_start();
	require_once("config.php");
	
		// Fetch web data
	$Email = $_POST["Email"];
	print "From PHP, I got email ($Email) <br>";
	$Password = $_POST["Password"];
	print "From PHP, I got password ($Password) <br>";
	
	// Conect to MYSQL
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con){
		die("Connection Failure".mysqli_connect_error());
	}
	print "Database connected !!! <br>";
	
	// Create a query
	$query = "select * from Users where Email='$Email'";
	$result = mysqli_query($con, $query);
	
	
	$row = mysqli_fetch_assoc($result);
	echo "You have {$row['Users']} left! <br>";
		
	print "anything <br>";

	if (!$result){
		print "error : mysqli_error($con)";
		$_SESSION["Message"] = "login failed!";
	}
	
	if ($result){
		print "worked";
		$_SESSION["Message"] = "loged-in!";
		$_SESSION["RegState"] = 4;
		header("location: ../php/service.php");
		exit();
	}
	
	
?>