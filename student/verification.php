<?php
//session_start();
include('../controller/conn.php');
include __DIR__.'/../vendor/sendVerificationCode.php';
echo '<script>alert("Please enter the OTP code received by '.$_SESSION['email'].' to verify your account.")</script>';
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="../src/css/mdb.min.css"/>
</head>
<style>
	body {
  background: #eee;
}
</style>
<body>
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
					header('location:index.php');
				}
                
            }
        }
        else
        {
            echo '<script>alert("Invalid OTP Code")</script>'; 
        }
	}
?>
<div class="reg">
	
		<div class="container">

			<br><h1>OTP Verification</h1>
			<hr class="mb-3">
			<label for="studentID"><b>OTP Code</b></label>
			<form action="verification.php" method="post">
			<input class="form-control" id="otp"  type="password" name="otp" required><br/>
			<div class="row">
				<div class="col-6" style="text-align:left;">
				<input class="btn btn-primary" type="submit" id="verify" name="verify" value="Verify">
				</form>
				</div>
				<div class="col-6" style="text-align:right;">
				<form action="../vendor/sendVerificationCode.php" method="post">
					<button class="btn btn-outline-success" stle="display:inline;" type="submit" name="resend" value="<?php echo $_SESSION['email']; ?>">Resend</button>
				</form>
				</div>
				
			</div>
			

		</div>
	</form>
</div>
</body>
</html>