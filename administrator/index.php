<?php
//DB connection
include('../controller/conn.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SCPG E-library</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    <!-- Tab icon -->
    <link href="../src/image/segi_logo.png" rel="icon">
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
            <div class="form-outline mb-4">
                <input type="email" id="form1Example1" value="<?php if (isset($_COOKIE["email"])){echo $_COOKIE["email"];}?>"  required/>
                <label class="form-label" for="form1Example1">Email</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
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

    <!-- Forgot Password Modal -->
    <div id="forgotModal" class="modal" style="padding-top: 10%; width: 100%; height: 100%; overflow: auto; background-color: rgb(0,0,0,0.4);">
        <!-- Modal content -->
        <div class="modal-content" style="width:250px; margin: auto auto ; padding: 30px;">
            <form method="POST" action="../controller/admin_forgotpwd.php">
            <h5 style="margin:0 0 6% 0; text-align:center;">Verification</h5>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="form1Example1" value="<?php if (isset($_COOKIE["email"])){echo $_COOKIE["email"];}?>" name="email" class="form-control" required/>
                <label class="form-label" for="form1Example1">Email Address</label>
            </div>

            <!-- Confirm button -->
            <button type="submit" class="btn btn-primary btn-block" value="login" name="confirm">CONFIRM</button>
            </form>
        </div>
    </div>
    
    <script>
      // Get the modal
      var forgotmodal = document.getElementById("forgotModal");

      // When the user clicks the button, open the modal 
      function forgotpwd() {
          forgotmodal.style.display = "block";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == forgotmodal) {
              forgotmodal.style.display = "none";
          }
        }
    </script>
    <!-- MDB -->
    <script type="text/javascript" src="../src/js/mdb.min.js"></script>
  </body>
</html>
