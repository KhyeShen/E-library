<?php
//DB connection
include('../controller/conn.php');
//Login PHP
// include('../controller/login.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <!-- MDB -->
    <link rel="stylesheet" href="../src/css/mdb.min.css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../src/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="../src/css/google_fonts_roboto.css"/><!-- Local CSS -->
    <link rel="stylesheet" href="../src/css/resetpwd.css"/>
  </head>
  <body style="background-color:black;">
  
    <!-- Login Modal -->
    <div id="" class="" style="background-color:black;">
    <div style=" margin-bottom:20px; text-align:center;">
        <h1 style="color:white;">SCPG E-library</h1>
        <h9>Admin</h9>
      </div>
        <!-- Modal content -->
        <div class="modal-content" style="width:250px; margin: auto auto ; padding: 30px;">
            <form method="POST" action="../controller/admin_login.php">
            <h2 style="margin:0 0 6% 0; text-align:center;">Login Form</h2>
            <!-- Email input -->
            <div class="form-outline mb-4" style="background-color:#cccccc; border-radius:10px;">
                <input type="email" id="form1Example1" value="<?php if (isset($_COOKIE["email"])){echo $_COOKIE["email"];}?>" name="email" class="form-control" required/>
                <label class="form-label" for="form1Example1">Email</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4" style="background-color:#cccccc; border-radius:10px;">
                <input type="password" id="form1Example2" value="<?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" name="password" class="form-control" required/>
                <label class="form-label" for="form1Example2">Password</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4" style="text-align:center;">

                <div class="col">
                <!-- Simple link -->
                <a onclick="forgotpwd()" href="#" style="text-decoration: underline;">Forgot password?</a>
                </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block" value="login" name="login">LOGIN</button>
            </form>
        </div>
    </div>
  </body>
</html>
