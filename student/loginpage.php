<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
</head>
<body>
	<h1 style="text-align: center;"><b>SEGi College Penang E-library<b></h1>
	<div class="content">
	<div class="box">
	<form method="POST" action="../controller/login.php">
		<b><strong>Sign In</strong></b><br><br>
		
		<div class="row">
		<input type="text" class="w3-input" value="<?php if (isset($_COOKIE["studentID"])){echo $_COOKIE["studentID"];}?>" name="student_ID" placeholder="Student ID" required><br>

		<input type="password" class="w3-input" value="<?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" name="password" placeholder="Password" required><br>
		
		<input style="float:right" type="submit" name="login">
		<a  style="float:left; font-size:17px;" href="forgotpwd.php"><b>Forgot Password?</b></a>
		</div><br><br>
		<p>Don't have an account?  <a href="signup.php"><b>Sign Up</b></a></p>
	</form>
	</div>
	</div>
</body>
</html>