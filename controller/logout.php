<?php
	session_start();
	//Clear session to logout
	session_destroy();
 
	if (isset($_COOKIE["studentID"]) AND isset($_COOKIE["password"])){
		setcookie("studentID", '', time() - (3600));
		setcookie("password", '', time() - (3600));
	}
 
	header('location:../student/index.php');
?>