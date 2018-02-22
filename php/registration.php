<?php
	session_start();
	require_once("config.php");
	
	// Fetch web data
	$Email = $_GET["Email"];
	print "From PHP, I got email ($Email) <br>";
	
	// Conect to MYSQL
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con){
		die("Connection Failure".mysqli_connect_error());
	}
	print "Database connected !!! <br>";
	
	// Create a query
	$Acode = rand();
	$Rdatetime = date("Y-m-d h:i:s");
	$query = "INSERT INTO Users (Email, Status, Acode, Rdatetime) VALUES ('$Email', 0, '$Acode', '$Rdatetime');";
	print "Query preped <br>";
	$result = mysqli_query($con, $query);
	if (!$result){
		$_SESSION["Message"] = "email already in use".mysqli_connect_error();
		header("location: ../index.php");
		exit();
	}
	print "Insert Worked !!! <br>";
	
	// Prepare email to authenticate
	$msg = "Please click on the link to set password for your account: "."http://cis-linux2.temple.edu/~tuf92968/lab2/php/authenticate.php?Email=$Email&Acode=$Acode";
	
	// Ready to send email
	$to = $Email;
	$subject = "Welcome";
	$headers = "From: kennys@temple.edu" . "\r\n" .
		"CC: ";
	mail($to,$subject,$msg,$headers);
	
	// Then What
	$_SESSION["Message"] = "Registration Email sent to ($Email)";
	$_SESSION["RegState"] = 1;
	header("location: ../index.php");
	exit();
	
?>