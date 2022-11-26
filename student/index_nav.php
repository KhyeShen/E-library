<?php
//DB connection
require('../controller/conn.php');
//Login PHP
require('../controller/login.php');
//Variables
$search_value = "";

//Get the search value
if(isset($_GET['search_value']))
{
  $search_value = $_GET['search_value'];
}
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
    <link rel="stylesheet" href="../src/css/google_fonts_roboto.css"/>
  </head>
  <body>
    <!-- Forgot Password Modal -->
    <div id="forgotModal" class="modal" style="padding-top: 10%; width: 100%; height: 100%; overflow: auto; background-color: rgb(0,0,0,0.4);">
        <!-- Modal content -->
        <div class="modal-content" style="width:250px; margin: auto auto ; padding: 30px;">
            <form method="POST" action="../controller/forgotpwd.php">
            <h4 style="margin:0 0 6% 0; text-align:center;">Verify Student ID</h4>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="text" id="form1Example1" name="studentID" value="<?php if (isset($_COOKIE["student_ID"])){echo $_COOKIE["studentID"];}?>" name="student_ID" class="form-control" required/>
                <label class="form-label" for="form1Example1">Student ID</label>
            </div>

            <!-- Confirm button -->
            <button type="submit" class="btn btn-primary btn-block" value="login" name="confirm">CONFIRM</button>
            </form>
        </div>
    </div>

    <!-- Login Modal -->
    <div id="myModal" class="modal" style="padding-top: 10%; width: 100%; height: 100%; overflow: auto; background-color: rgb(0,0,0,0.4);">
        <!-- Modal content -->
        <div class="modal-content" style="width:250px; margin: auto auto ; padding: 30px;">
            <form method="POST" action="../controller/login.php">
            <h2 style="margin:0 0 6% 0; text-align:center;">Login Form</h2>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="text" id="form1Example1" value="<?php if (isset($_COOKIE["student_ID"])){echo $_COOKIE["studentID"];}?>" name="student_ID" class="form-control" required/>
                <label class="form-label" for="form1Example1">Student ID</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4" >
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

    <!-- Nav -->
    <nav class="navbar navbar-expand-lg navbar-dark " style="background: #a31f37; margin-bottom:30px;">
      <div class="container-fluid">
        <!-- Institute Name -->
        <a class="navbar-brand" href="index.php" style="color:white; margin:0 3%;">SCPG E-library</a>

        <!-- Menu Bar -->
        <button
          class="navbar-toggler"
          type="button"
          data-mdb-toggle="collapse"
          data-mdb-target="#navbarTogglerDemo02"
          aria-controls="navbarTogglerDemo02"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars" style="color:white;"></i>
        </button>

        <!-- Item in Nav -->
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <!-- Search Bar -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item" style="margin-left:3%;">
              <form class="d-flex input-group w-auto" method="POSt" action="../controller/search.php">
                <input
                  type="search"
                  class="form-control rounded"
                  placeholder="Search"
                  aria-label="Search"
                  aria-describedby="search-addon"
                  name="search"
                  value="<?php echo $search_value; ?>"
                /><?php $search_value = ""; ?>
                <span class="input-group-text border-0" id="search-addon">
                <button type="submit" name="search_btn" style="background-color:transparent; border:none;">
                <i class="fas fa-search" style="color:white;"></i>
                </button>
                </span>
              </form>
            </li>
          </ul>

          <div class="row"  style="margin: 0 3% 0 0;">
            <!-- Home Button -->
            <div class="col-4">
              <a class="fas fa-home" href="index.php" style="color:white;"></a>
            </div>

            <!-- Genre Button -->
            <div class="col-4">
              <div class="dropdown">
                <a
                  class="text-reset me-3 dropdown-toggle hidden-arrow"
                  href="#"
                  id="navbarDropdownMenuLink"
                  role="button"
                  data-mdb-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="fas fa-book-open" style="color:white;"></i>
                </a>
                <ul
                  class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="navbarDropdownMenuLink"
                >
                  <li>
                    <a class="dropdown-item"><b>Genre</b></a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="genre.php?type=Horror">Horror</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="genre.php?type=Romance">Romance</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="genre.php?type=Fantasy">Fantasy</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="genre.php?type=Historical">Historical</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="genre.php?type=High Quality Material">High Quality Material</a>
                  </li>
                </ul>
              </div>
            </div>

            <!-- Login Button -->
            <div class="col-4" >
            <button type="button" onclick="openModal()" href="#myBtn"class="btn btn-light btn-rounded" style="padding: 5px 8px;">Login</button>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- MDB -->
    <script type="text/javascript" src="../src/js/mdb.min.js"></script>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");
        var forgotmodal = document.getElementById("forgotModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        function openModal() {
        modal.style.display = "block";
        }

        // When the user clicks the button, open the modal 
        function forgotpwd() {
          modal.style.display = "none";
          forgotmodal.style.display = "block";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal) {
              modal.style.display = "none";
          }
          if (event.target == forgotmodal) {
              forgotmodal.style.display = "none";
          }
        }
    </script>
  </body>
</html>
