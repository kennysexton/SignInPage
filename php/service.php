<?php
	session_start();
	if ($_SESSION["RegState"] != 4){
		// Redirect to an illegal access page
		$_SESSION["Message"] = "Please Login first";
		header("location: ../index.php");
		exit();
	}
?>