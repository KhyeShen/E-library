<?php
	session_start();
	if($_SESSION['task'] != 'resetpwd')
	{
		header('location:index.php');
	}
	unset($_SESSION['task']);
	include('../controller/conn.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
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
	if(isset($_POST['confirm']))
	{
		$password	= $_POST['password'];
		$conp		= $_POST['conp'];
		$studentID 		= $_SESSION['studentID'];
		if($password == $conp)
		{
			date_default_timezone_set("Asia/Kuala_Lumpur");
			$current = date("Y-m-d h:i:s");
				
			$hash = password_hash($conp, PASSWORD_DEFAULT);
			
			$sql = "update student set password='$hash',updated_datetime='$current' where student_ID ='$studentID'";
	
			if(!mysqli_query($conn,$sql))
			{
			  echo '<script>alert("Reset Password Fail, please try again")</script>'; 
			}
			else if(mysqli_query($conn,$sql))
			{
				$_SESSION['message'] = 'Password has been reset';
				session_destroy();
 
				if (isset($_COOKIE["email"]) AND isset($_COOKIE["password"])){
					setcookie("email", '', time() - (3600));
					setcookie("password", '', time() - (3600));
				}
				echo "<script>if(confirm('Your Record Sucessfully Inserted. Now Login')){document.location.href='index.php'};</script>";
				//header('location:index.php');
			}
		}
		
		else{
			echo '<script>alert("Password and Confirm Password are not match!");</script>';
		}
	}
	?>
	<div class="reg">
	<form action="resetpwd.php" method="post">
		<div class="container">

			<br><h1>Reset Password</h1>
			<hr class="mb-3">
			<label for="studentID"><b>New Password</b></label>
			<input type="password" class="form-control" value="<?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" name="password" placeholder="New Password" autofocus><br>
			<label for="studentID"><b>Confirm Password</b></label>
			<input type="password" class="form-control" value="<?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" name="conp" placeholder="Confirm Password"><br>
		
			<div class="row">
				<div class="col-12" style="text-align:left;">
				<b><input class="btn btn-primary"type="submit" value="Confirm" name="confirm"></b>
				<button type="button" class="btn btn-danger" onclick="history.back()">Cancel</button>
				</div>
			</div>

		</div>
	</form>
</div>
</body>
</html>