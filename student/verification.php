<?php
//DB connection
require('../controller/conn.php');
//send email php
include __DIR__.'/../vendor/sendVerificationCode.php';

//Check if the email has been sent
if(!$_SESSION['email'])
{
	header('location:index.php');
}
echo '<script>alert("Please enter the OTP code received by '.$_SESSION['email'].' to verify your account.")</script>';
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<!-- Font Awesome -->
    <link rel="stylesheet" href="../src/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="../src/css/google_fonts_roboto.css"/>
    <!-- MDB -->
    <link rel="stylesheet" href="../src/css/mdb.min.css"/>
	<!-- Local CSS -->
    <link rel="stylesheet" href="../src/css/resetpwd.css"/>
</head>
<style>
	body {
  	background: #eee;
	}
</style>
<body>
<?php
//Verify OTP
if(isset($_POST['verify']))
{
	$otp = $_POST['otp'];
	
	if($_SESSION['otp'] == $otp)
	{
		if($_SESSION['task'] == 'resetpwd'){
			header('location:resetpwd.php');
		}
		else{
			header('location:index.php');
		}
	}
	else if($_SESSION['otp'] != $otp)
	{
		echo '<script>alert("Invalid OTP Code")</script>'; 
	}
}
?>

<!-- OTP Input Form -->
<form action="verification.php" method="post">
	<div class="container">
		<div class="box">
			<br><h1>OTP Verification</h1>
			<hr class="mb-3">
			<label for="studentID"><b>OTP Code</b></label>
			
			<input class="form-control" id="otp"  type="number" name="otp" required><br/>
			<div class="row">
				<div class="col-6" style="text-align:left;">
					<input class="btn btn-primary" type="submit" id="verify" name="verify" value="Verify">
					</form>
					</div>
					<div class="col-6" style="text-align:right;">
					<form action="../vendor/sendVerificationCode.php" method="post" style="margin: 0;">
					<button class="btn btn-outline-success" stle="display:inline;" type="submit" name="resend" value="<?php echo $_SESSION['email']; ?>">Resend</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
</body>
</html>