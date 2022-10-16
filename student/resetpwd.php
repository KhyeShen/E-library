<?php
	session_start();
	if($_SESSION['task'] != 'resetpwd')
	{
		header('location:loginpage.php');
	}
	unset($_SESSION['task']);
	include('conn.php');
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
	<?php echo '<script>alert("'.$_SESSION['task'].'")</script>'; 
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
			
			$sql = "update student_acc set password='$hash',updated_datetime='$current' where student_ID ='$studentID'";
	
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
				
				header('location:loginpage.php');
			}
		}
		
		else{
			echo '<script>alert("Password and Confirm Password are not match!");</script>';
		}
	}
	?>
	</div>
	<h1 style="text-align: center;"><b>Malaysian Protection<b></h1>
	<div class="content">
	<div class="box">
	<form method="POST" action="resetpwd.php">
		<b><strong>Reset Password</strong></b><br><br><br>
		
		<div class="row">

		<input type="password" class="w3-input" value="<?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" name="password" placeholder="New Password" autofocus><br>
		<input type="password" class="w3-input" value="<?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" name="conp" placeholder="Confirm Password"><br>
		
		<button type="button" style="float:left" onclick="window.history.go(-1); return false;"><b>Cancel</b></button>
		<b><input style="float:right" type="submit" value="Confirm" name="confirm"></b>
		</div><br><br>
		
	</form>
	</div>
	</div>
</body>
</html>