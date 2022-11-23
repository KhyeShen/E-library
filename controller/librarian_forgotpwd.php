<?php
	//DB connection
	include('../controller/conn.php');

	//Send OTP by email PHP
	include __DIR__.'/../vendor/librarian_sendVerificationCode.php';

	//Verify student ID
	if(isset($_POST['email']))
	{
		//Variables
		$librarian_email = $_POST['email'];
		$_SESSION['task'] = 'librarian resetpwd';
		
		//Check if student exist
		$librarian_sql = mysqli_query($conn,"select * from `librarian` where email='$librarian_email'");
        $row = mysqli_fetch_assoc($librarian_sql);
		
		if (mysqli_num_rows($librarian_sql) >= 1)
		{
            $_SESSION['librarian_ID'] = $row['librarian_ID'];
			$email = $librarian_email;
			sendEMail($email);
		}
		
		else{
            echo '<script type="text/javascript">'; 
			echo 'alert("Account does not exist!");'; 
			echo 'history.back();';
			echo '</script>';
		}
	}
	else{
		header('location:../librarian/index.php');
	}
?>