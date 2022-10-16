<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- MDB -->
    <link rel="stylesheet" href="../src/css/mdb.min.css" />
  </head>
  <body>
    <div id="myModal" class="modal" style="padding-top: 10%; width: 100%; height: 100%; overflow: auto; background-color: rgb(0,0,0,0.4);">
        <!-- Modal content -->
        <div class="card" style="border-radius: 15px; width:250px; margin: auto auto ; padding: 15px;">
          <div class="card-body text-center">
            <h3>My Profile</h3>
            <div class="mt-3 mb-4" style="margin:auto auto;">
              <img src="../src/image/45.jpeg"
                class="rounded-circle" height="141" width="141"/>
            </div>
            <h6 class="mb-2"><?php echo $_SESSION['student_name']; ?></h6>
            <h6 class="mb-2"><?php echo $_SESSION['studentID']; ?></h6><br>
            <p style="font-size:12px;"><?php echo $_SESSION['student_email']; ?></p>
          </div>
        </div>
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark " style="margin:0 0; width: 100%;background: #a31f37;">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.php" style="color:white; margin:0 3%;">SCPG E-library</a>
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
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item" style="margin-left:3%;">
              <form class="d-flex input-group w-auto" method="POSt" action="search_result.php">
                <input
                  type="search"
                  class="form-control rounded"
                  placeholder="Search"
                  aria-label="Search"
                  aria-describedby="search-addon"
                  name="search"
                />
                <span class="input-group-text border-0" id="search-addon">
                <i class="fas fa-search"  style="color:white;"></i>
                </span>
              </form>
            </li>
          </ul>
          <div class="row"  style="margin: 0 0 0 0;">
            <div class="col-4">
            <a class="fas fa-home" href="home.php" style="color:white;"></a>
            </div>
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
                    <a class="dropdown-item" href="#">Horror</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">Romance</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">High Quality Materials</a>
                  </li>
                </ul>
              </div>
            
            </div>
            <div class="col-4">
              <div class="dropdown">
                <a
                  class="dropdown-toggle d-flex align-items-center hidden-arrow"
                  href="#"
                  id="navbarDropdownMenuAvatar"
                  role="button"
                  data-mdb-toggle="dropdown"
                  aria-expanded="false"
                >
                  <img
                    src="img/46.JPG"
                    onerror=this.src="../src/image/profile.jpg"
                    class="rounded-circle"
                    height="25"
                    width="25"
                    alt="Black and White Portrait of a Man"
                    loading="lazy" 
                  />
                </a>
                <ul
                  class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="navbarDropdownMenuAvatar"
                >
                  <li>
                    <a class="dropdown-item" onclick="openModal()" href="#">My profile</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">Settings</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../controller/logout.php">Logout</a>
                  </li>
                </ul>
              </div>
            
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- MDB -->
    <script type="text/javascript" src="../src/js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
    <!-- Profile modal -->
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        function openModal() {
        modal.style.display = "block";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
    </script>
  </body>
</html>
