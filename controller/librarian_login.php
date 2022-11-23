<?php
	session_start();

	//DB connection
	include('conn.php');

	//student login
    if(isset($_POST['login']))
	{
		if(isset($_POST['email']))
		{
			//Variables
			$email 	= $_POST['email'];
			$password 	= $_POST['password'];
			
			//Select student's data
			$query = mysqli_query($conn,"select * from `librarian` where email='$email'");
			
			//Verify if student exist
			if (mysqli_num_rows($query) != 0)
			{
				//Verify password
				$row = mysqli_fetch_array($query);
				$hashed_pass = $row['password'];
				
				if(password_verify($password, $hashed_pass)) 
				{
					$_SESSION['librarian_email'] 	        = $row['email'];
					$_SESSION['librarian_name'] 	        = $row['librarian_name'];
					$_SESSION['librarian_ID'] 	            = $row['librarian_ID'];
					$_SESSION['librarian_loginstatus'] 	    = "active"; 

					header("Location: ../librarian/upload_form.php");
				}
				else 
				{
					echo '<script type="text/javascript">'; 
					echo 'alert("Invalid Password!");'; 
					echo 'window.location.href = "../librarian/index.php";';
					echo '</script>';
				}	
			}
			else{
				echo '<script type="text/javascript">'; 
				echo 'alert("Invalid Email Address or Invalid Password!");'; 
				echo 'window.location.href = "../librarian/index.php";';
				echo '</script>';
			}
		}
	}
?>

