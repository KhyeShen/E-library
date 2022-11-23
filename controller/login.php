<?php
	session_start();

	//DB connection
	include('conn.php');

	//student login
    if(isset($_POST['login']))
	{
		if(isset($_POST['student_ID']))
		{
			//Variables
			$studentID 	= $_POST['student_ID'];
			$password 	= $_POST['password'];
			
			//Select student's data
			$query = mysqli_query($conn,"select * from `student` where student_ID='$studentID'");
			
			//Verify if student exist
			if (mysqli_num_rows($query) != 0)
			{
				//Verify password
				$row = mysqli_fetch_array($query);
				$hashed_pass = $row['password'];
				$status = $row['status'];
				
				if($status == "Frozen")
				{
					echo '<script type="text/javascript">'; 
					echo 'alert("Your Account Has Been Frozen, Please Email to scpgelibrary@gmail.com for more information.");'; 
					echo 'window.location.href = "../student/index.php";';
					echo '</script>';
				}

				if(password_verify($password, $hashed_pass)) 
				{
					$_SESSION['studentID'] 		= $row['student_ID'];
					$_SESSION['student_name'] 	= $row['student_name'];
					$_SESSION['student_email'] 	= $row['email'];
					$_SESSION['loginstatus'] 	= "active"; 

					if(isset($_SESSION['page']) && $_SESSION['page'] != "")
					{
						header("Location: ../student/".$_SESSION['page']);
					}
					else{
						header("Location: ../student/home.php");
						echo '<script>alert("Welcome")</script>';
					}
				}
				else 
				{
					echo '<script type="text/javascript">'; 
					echo 'alert("Invalid Password!");'; 
					echo 'window.location.href = "../student/index.php";';
					echo '</script>';
				}	
			}
			else if(mysqli_num_rows($query) == 0){
				echo '<script type="text/javascript">'; 
				echo 'alert("Invalid Student ID!");'; 
				echo 'window.location.href = "../student/index.php";';
				echo '</script>';
			}
		}
	}
?>

