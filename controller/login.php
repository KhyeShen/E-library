<?php
	session_start();
	include('conn.php');

	//student login
    if(isset($_POST['login']))
	{
		if(isset($_POST['student_ID']))
	{
		$studentID = $_POST['student_ID'];
		$password = $_POST['password'];
		
		$query = mysqli_query($conn,"select * from `student` where student_ID='$studentID'");
		
		if (mysqli_num_rows($query) != 0)
		{
			$row = mysqli_fetch_array($query);
			$hashed_pass = $row['password'];
	 
			if(password_verify($password, $hashed_pass)) 
			{
				$_SESSION['studentID'] = $row['student_ID'];
				$_SESSION['student_name'] = $row['student_name'];
				$_SESSION['student_email'] = $row['email'];
				$_SESSION['loginstatus'] = "active"; 

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
				echo '<script>alert("'.$hashed_pass.','.$password.'")</script>'; 
			}	
		}
		else if(mysqli_num_rows($query) == 0){
			header("Location: ../index.php");
			$_SESSION['message'] = "Invalid Account";
		}
	}
	}
?>

