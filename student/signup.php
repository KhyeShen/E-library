<?php
session_start();
include('../controller/conn.php');
include __DIR__.'/../vendor/sendVerificationCode.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<style>
	.reg{
		width: 600px;
		margin-left: auto;
		margin-right: auto;
	}
	</style>
</head>
<body>

<div>
	<?php
	
	if(isset($_POST['create']))
	{
		$studentID		= $_POST['studentID'];
		$password		= $_POST['password'];
		$cpassword		= $_POST['cpassword'];
		//$email			= $_POST['email'];
		
		$student = mysqli_query($conn,"select * from `student` where student_ID='$studentID'");
		$acc = mysqli_query($conn,"select * from `student_acc` where student_ID='$studentID'");

		if (mysqli_num_rows($acc) >= 1)
		{
			echo '<script>alert("You have signed up an account")</script>'; 
		}
		
		else if (mysqli_num_rows($acc) == 0 && mysqli_num_rows($student) >= 1)
		{
			if($password == $cpassword)
			{
				date_default_timezone_set("Asia/Kuala_Lumpur");
				$current = date("Y-m-d h:i:s");
				$row = mysqli_fetch_assoc($student);
				$email = $row['email']; 
				echo '<script>alert("'.$email.'")</script>'; 
				
				$hash = password_hash($password, PASSWORD_DEFAULT);
				$sql = "INSERT INTO student_acc (student_ID,password,created_datetime,updated_datetime) VALUES 
								('$studentID', '$hash' , '$current', '$current')";
								
				if(!mysqli_query($conn,$sql)){
					echo '<script>alert("Sign up failed, please try again")</script>'; 
				}
				else{
					echo '<script>alert("Successfully Sign Up")</script>';
					$_SESSION['task'] = "verify";
					sendMail($email);
				}

				if (isset($_COOKIE["email"]) AND isset($_COOKIE["password"])){
					setcookie("email", '', time() - (3600));
					setcookie("password", '', time() - (3600));
				}
			 
					//header('location:loginpage.php');
				
			}
			else{
				echo '<script>alert("Password and Confirm Password Does Not Match");</script>';
			}
		}
	}
?>
</div>

<div class="reg">
	<form action="signup.php" method="post">
		<div class="container">

			<h1>Registration</h1><br/>
			<p>Fill up the form with correct values.</p>
			<hr class="mb-3">
			<label for="studentID"><b>Student ID</b></label>
			<input class="form-control" id="studentID"  type="text" name="studentID" required><br/>
			
			<label for="password"><b>Password</b></label>
			<input class="form-control" id="password"  type="password" name="password" required><br/>
			
			<label for="cpassword"><b>Confirm Password</b></label>
			<input class="form-control" id="cpassword"  type="password" name="cpassword" required><br/>
			<span id="message"></span>
			
			<br>
			<input class="btn btn-primary" type="submit" style="float:right;" id="register" name="create" value="Sign Up">

		</div>
	</form>
</div>
</body>
</html>