<?php
	session_start();
	require_once("config.php");
	
	// Fetch web data
	$Password = $_POST["Password"];
	print "From PHP, I got password ($Password) <br>";
	$Email = $_SESSION["UserEmail"];
	print "User Email ($Email) <br>";
	
		// Connect
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if(!$con){
		$_SESSION["Message"] = "Connection failed: ".mysqli_connect_error();
		$_SESSION["RegState"]= -1;
		header("location: ../index.php");
		exit();
	}
	print "Database connected !!! <br>";
	
	$query = "select * from Users where Email='$Email';";
	$result = mysqli_query($con, $query);
	
	if ($result){
		
		$query2 = "UPDATE Users set Status=3, Password='$Password';";
		
		$result2=mysqli_query($con, $query2);
		
		if (!result2) {
			$_SESSION["Message"] = "Client update failure: ".mysqli_connect_error();
			$_SESSION["RegState"]= -2;
			header("location: ../index.php");
			exit();
		}
		
		// Password Set, Status Updated
		$_SESSION["Message"] = "Password set";
		$_SESSION["RegState"] = 3;
		header("location: ../index.php");
		exit();
	}
	
	// Query Failed
	$_SESSION["Message"] =  "Failed to set password :".mysqli_error($con);
	$_SESSION["RegState"] = -3;
	header("location: ../index.php");
	exit();
?>