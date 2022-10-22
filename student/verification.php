<?php
session_start();
include('../controller/conn.php');
include __DIR__.'/../vendor/sendVerificationCode.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
</head>

<body>
<div>
	<?php
	if(isset($_POST['verify']))
	{
		$otp = $_POST['otp'];
		
        if($_SESSION['otp'] == $otp)
        {
            $verify = mysqli_query($conn,"update `student_acc` set verified='1'");
            if($verify)
            {
                if($_SESSION['task'] == 'resetpwd'){
					header('location:resetpwd.php');
				}
				else{
					header('location:loginpage.php');
				}
                
            }
        }
        else
        {
            echo '<script>alert("Invalid OTP Code")</script>'; 
        }
	}
	// else if(isset($_POST['sumbit'])){

	// }
?>
</div>

<div class="reg">
	<form action="verification.php" method="post">
		<div class="container">

			<h1>Verification</h1><br/>
			<hr class="mb-3">
			<label for="studentID"><b>OTP Code</b></label>
			<input class="form-control" id="otp"  type="text" name="otp" required><br/>
			
			<br>
			<input class="btn btn-primary" type="submit" style="float:right;" id="verify" name="verify" value="Verify">

		</div>
	</form>
</div>
</body>
</html>