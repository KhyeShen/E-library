<?php
	session_start();

  //Check if valid to reset password
	if($_SESSION['task'] != 'resetpwd')
	{
		header('location:index.php');
	}
	unset($_SESSION['task']);

  //DB connection
	include('../controller/conn.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../src/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="../src/css/google_fonts_roboto.css"/>
    <!-- MDB -->
    <link rel="stylesheet" href="../src/css/mdb.min.css"/>
    <!-- Local CSS -->
    <link rel="stylesheet" href="../src/css/resetpwd.css"/>
</head>
<body>
	<?php
  //submit student ID to verify
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
				echo "<script>alert(Your Password Sucessfully Updated, Please Login Now');</script>";
			}
		}
		
		else{
			echo '<script>alert("Password and Confirm Password are not match!");</script>';
		}
	}
	?>

  <!-- Input Form -->
	<form action="resetpwd.php" method="post">
		<div class="container">
      <div class="box">
        <br><h1>Reset Password</h1>
        <hr class="mb-3">
        <label for="studentID"><b>New Password</b></label>
        <input onkeyup="check()" type="password" class="form-control" value="<?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" name="password" placeholder="New Password" autofocus><br>
        <label for="studentID"><b>Confirm Password</b></label>
        <input type="password" class="form-control" value="<?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" name="conp" placeholder="Confirm Password"><br>
        
        <div class="row">
          <div class="col-6" style="text-align:left;">
            <b><input class="btn btn-primary" type="submit" value="Confirm" name="confirm" id="confirm" disabled></b>
          </div>
          <div class="col-6" style="text-align:right;">
            <button type="button" class="btn btn-danger" onclick="document.location='home.php'">Cancel</button>
          </div>
        </div>

        <div class="indicator">
            <span class="weak"></span>
            <span class="medium"></span>
            <span class="strong"></span>
        </div>
        <div class="text"></div>
      </div>
      <div class="rules">
        <p>
          -At least one letter<br/>
          -At least one digit<br/>
          -At least 6 characters<br/>
          -At least one special symbol (eg. !,@)
        </p>
      </div>
		</div>
	</form>

  <script>
    //get element
    const indicator = document.querySelector(".indicator");
    const input = document.querySelector("input");
    const weak = document.querySelector(".weak");
    const medium = document.querySelector(".medium");
    const strong = document.querySelector(".strong");
    const text = document.querySelector(".text");
    const showBtn = document.querySelector(".showBtn");

    //declare variables and criteria
    var no = 0;
    let regExpWeak = /[a-z]/;
    let regExpMedium = /\d+/;
    let regExpStrong = /.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/;

    //validate the password
    function check(){
      if(input.value != ""){
        indicator.style.display = "block";
        indicator.style.display = "flex";

        //identify the level of the password
        if(input.value.length <= 3 && (input.value.match(regExpWeak) || input.value.match(regExpMedium) || input.value.match(regExpStrong)))no=1;
        if(input.value.length >= 6 && ((input.value.match(regExpWeak) && input.value.match(regExpMedium)) || (input.value.match(regExpMedium) && input.value.match(regExpStrong)) || (input.value.match(regExpWeak) && input.value.match(regExpStrong))))no=2;
        if(input.value.length >= 6 && input.value.match(regExpWeak) && input.value.match(regExpMedium) && input.value.match(regExpStrong))no=3;
        
        //indicate the level of the password
        if(no==1){
          weak.classList.add("active");
          text.style.display = "block";
          text.textContent = "Your password is too week";
          text.classList.add("weak");
          document.querySelector('#confirm').disabled = true;
        }
        if(no==2){
          medium.classList.add("active");
          text.textContent = "Your password is medium";
          text.classList.add("medium");
          document.querySelector('#confirm').disabled = true;
        }else{
          medium.classList.remove("active");
          text.classList.remove("medium");
        }
        if(no==3){
          weak.classList.add("active");
          medium.classList.add("active");
          strong.classList.add("active");
          text.textContent = "Your password is strong";
          text.classList.add("strong");
          document.querySelector('#confirm').disabled = false;
        }else{
          strong.classList.remove("active");
          text.classList.remove("strong");
        }
        
      }
      //no input password
      else{
        indicator.style.display = "none";
        text.style.display = "none";
        showBtn.style.display = "none";
      }
    }
  </script>
</body>
</html>