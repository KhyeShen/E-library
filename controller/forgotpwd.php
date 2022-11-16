<?php
	//DB connection
	include('../controller/conn.php');

	//Send OTP by email PHP
	include __DIR__.'/../vendor/sendVerificationCode.php';

	//Verify student ID
	if(isset($_POST['studentID']))
	{
		//Variables
		$studentID = strtoupper($_POST['studentID']);
		$_SESSION['task'] = 'resetpwd';
		$_SESSION['studentID'] = $studentID;
		
		//Check if student exist
		$acc = mysqli_query($conn,"select * from `student_acc` where student_ID='$studentID'");
		$student = mysqli_query($conn,"select email from `student` where student_ID='$studentID'");
		$row = mysqli_fetch_assoc($student);
		
		if (mysqli_num_rows($acc) >= 1)
		{
			$email = $row['email'];
			sendEMail($email);
		}
		
		else{
			echo '<script>alert("Account does not exist!");</script>';
		}
	}
	else{
		echo '<script>alert("Account does  exist!");</script>';
	}
?>