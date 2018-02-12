<?php
	session_start();
	require_once("config.php");
	
	// Fetch web data
	$Email = $_GET["Email"];
	print "From PHP, I got email ($Email) <br>";
	
	// Conect to MYSQL
	$con = my_sqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con){
		print "Connection Failed <br>";
		die("Connection Failure".mysqli_connect_error());
	}
	print "Database connected !!! <br>";
	
	// Create a query
	$Acode = rand();
	$Rdatetime = date("Y-m-d h:i:s");
	$query = "INSERT into Users (Email, Status, Acode, Rdatetime) values ('$Email', 0, '$Acode', '$Rdatetime');";
	$result = mysqli_query($con, $query);
	if (!$result){
			die("Insert Failied".mysqli_connect_error());
	}
	print "Insert Worked !!! <br>";
	
	// Prepare email to authenticate
	$msg = "Please click on the link to set password for your account:"."http://cis-linux2.temple.edu/~tuf92968/php/authenticate.php?Email=$Email&$Acode";
	
	// Ready to send email
	$to = $Email;
	$subject = "Welcome";
	$headers = "From: tuf92968@temple.edu" . "\r\n" .
		"CC: ";
	mail($to,$subject,$txt,$headers);
	
	// Then What
	$_SESSION["RegState"] = 1;
	header("location: ../index.php");
	exit();	
?>