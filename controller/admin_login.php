<?php
	session_start();

	//DB connection
	include('conn.php');

	//student login
    if(isset($_POST['login']))
	{
		if (isset($_COOKIE['email'])) {
			unset($_COOKIE['email']); 
		}

		if(isset($_POST['email']))
		{
			//Variables
			$email 	= $_POST['email'];
			$password 	= $_POST['password'];
			
			//Select student's data
			$query = mysqli_query($conn,"select * from `admin` where email='$email'");
			
			//Verify if student exist
			if (mysqli_num_rows($query) != 0)
			{
				//Verify password
				$row = mysqli_fetch_array($query);
				$hashed_pass = $row['password'];
				
				if(password_verify($password, $hashed_pass)) 
				{
					$_SESSION['admin_email'] 		= $row['email'];
					$_SESSION['admin_name'] 	= $row['admin_name'];
					$_SESSION['admin_ID'] 	= $row['admin_ID'];
					$_SESSION['loginstatus'] 	= "active"; 

					header("Location: ../administrator/dashboard.php");
					echo '<script>alert("Welcome")</script>';
				}
				else 
				{
					echo '<script type="text/javascript">'; 
					echo 'alert("Invalid Email Address or Invalid Password!");'; 
					echo 'window.location.href = "../administrator/index.php";';
					echo '</script>';
				}	
			}
			else{
				echo '<script type="text/javascript">'; 
				echo 'alert("Invalid Email Address or Invalid Password!");'; 
				echo 'window.location.href = "../administrator/index.php";';
				echo '</script>';
			}
		}
	}
?>

