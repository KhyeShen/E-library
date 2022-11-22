<?php
	session_start();
	//Clear session to logout
	session_destroy();
 
	if (isset($_COOKIE["email"]) AND isset($_COOKIE["password"])){
		setcookie("email", '', time() - (3600));
		setcookie("password", '', time() - (3600));
	}
 
	header('location:../administrator/index.php');
?>