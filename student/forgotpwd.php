<?php
	session_start();
	include('../controller/conn.php');
	include __DIR__.'/../vendor/sendVerificationCode.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/resetp.css">
</head>
<body>
	<div>
	<?php
	if(isset($_POST['submit']))
	{
		$studentID = $_POST['studentID'];
		$_SESSION['task'] = 'resetpwd';
		$_SESSION['studentID'] = $studentID;
		
		$acc = mysqli_query($conn,"select * from `student_acc` where student_ID='$studentID'");
		$student = mysqli_query($conn,"select email from `student` where student_ID='$studentID'");
		$row = mysqli_fetch_assoc($student);
		
		if (mysqli_num_rows($acc) >= 1)
		{
			$email = $row['email'];
			sendMail($email);
		}
		
		else{
			echo '<script>alert("Account does not exist!");</script>';
		}
	}
	?>
	</div>
	<h1 style="text-align: center;"><b>SEGi College Penang E-library<b></h1>
	<div class="content">
	<div class="box">
	<form method="POST" action="forgotpwd.php">
		<b><strong>Enter Your Email Address</strong></b><br><br><br>
		
		<div class="row">
		<input type="text" class="w3-input" value="<?php if (isset($_COOKIE["studentID"])){echo $_COOKIE["studentID"];}?>" name="studentID" placeholder="Student ID" required autofocus><br>
		<br>
		
		<button type="button" style="float:left" onclick="location.href='loginpage.php'"><b>Cancel</b></button>
		<b><input style="float:right" type="submit" value="Submit" name="submit"></b>
		</div><br><br>
		
	</form>
	</div>
	</div>
</body>
</html>