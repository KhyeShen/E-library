<?php
	//DB connection
	include('../controller/conn.php');

	//Send OTP by email PHP
	include __DIR__.'/../vendor/admin_sendVerificationCode.php';

	//Verify student ID
	if(isset($_POST['email']))
	{
		//Variables
		$admin_email = $_POST['email'];
		$_SESSION['task'] = 'admin resetpwd';
		
		//Check if student exist
		$admin_sql = mysqli_query($conn,"select * from `admin` where email='$admin_email'");
        $row = mysqli_fetch_assoc($admin_sql);
		
		if (mysqli_num_rows($admin_sql) >= 1)
		{
            $_SESSION['admin_ID'] = $row['admin_ID'];
			$email = $admin_email;
			sendEMail($email);
		}
		
		else{
			echo '<script>alert("Account does not exist!");</script>';
		}
	}
	else{
		header('location:../administrator/index.php');
	}
?>