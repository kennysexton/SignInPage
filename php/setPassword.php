<?php
	session_start();
	require_once("config.php");
	
	// Fetch web data
	$Password = $_POST["Password"];
	print "From PHP, I got password ($Password) <br>";
	
?>