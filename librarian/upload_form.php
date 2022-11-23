<?php 
session_start();
// if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
// 	$_SESSION['message'] = 'Please Login!!';
// 	header('location:loginpage.php');
// 	exit();
// }

//DB connection
include('../controller/conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <title>SCPG E-library</title>
  <!-- Tab icon -->
  <link href="../src/image/segi_logo.png" rel="icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="../src/css/bootstrap_dashboard.css" rel="stylesheet">
  <link rel="stylesheet" href="../src/css/bootstrap.min.css">
  <!-- Dashboard CSS -->
  <link href="../src/css/dashboard.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  <!-- datatables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<body>
<!-- Header -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <!-- Logo -->
    <div class="d-flex align-items-center justify-content-between">
      <a href="upload_form.php" class="logo d-flex align-items-center">
          <img src="../src/image/segi_logo.png" alt="">
          <span class="d-none d-lg-block">SCPG E-Library</span>
      </a>
      <i class="fas fa-bars toggle-sidebar-btn"></i>
    </div>

    <!-- Drop Down Menu -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">Librarian</span>
          </a>
          <!-- Profile -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['librarian_name']; ?></h6>
              <span>Librarian</span>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="authentication.php">
                <span>Change Password</span>
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../controller/librarian_logout.php">
                <span>Sign Out</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>

  <!-- Nav -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
        <a class="nav-link" href="upload_form.php">
            <span>Material</span>
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="subscription_list.php">
            <span>Subscription</span>
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="manage_student.php">
            <span>Student</span>
        </a>
        </li>
    </ul>
  </aside>

  <!-- Main Content -->
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Material Management</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    <div class="row">
            <div class="text-center" style="margin-bottom:20px;">
                    <b style="font-size: 28px;" >UPLOAD MATERIAL FORM</b>
            </div>
        </div>
        <!-- Material Input Form -->
        <div class="row">
            <form action="../controller/upload_material.php" method="post" enctype="multipart/form-data">
                <!-- Cover Photo -->
                <div class="col-md-3" style="margin-bottom:10px;">
                        <label for="coverImage">Choose Cover Image</label><br>
                        <img src="../src/image/placeholder.jpg" onclick="triggerClick()" id="coverDisplay" style="cursor: pointer;height:340px;width:228px;">
                        <input type="file" name="cover[]" accept=".jpg, .jpeg, .png" onchange="displayImage(this)" id="coverImage" style="display: none;">
                </div>
                <!-- Material File & Details -->
                <div class="col-md-9" style="padding:0 30px;">
                    <div class="row" style="margin-bottom:10px;">
                        <label for="file">Material File (Only PDF Supported)</label><br>
                        <input type="file" required name="files[]" accept=".pdf" class="form-control" id="file" placeholder="Material File" required/>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <b>Material Name</b>
                        <input class="form-control" type="text" name="material_title" placeholder="Material Name" style="margin-top: 3px;" required>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <b>Author Name</b>
                        <input class="form-control" type="text" name="author" placeholder="Author Name" style="margin-top: 3px;" required>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <b>Page Number</b>
                        <input class="form-control" type="number" name="pages" placeholder="Page Number" style="margin-top: 3px;" required>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <b>Description</b>
                        <input class="form-control" type="text" name="description" placeholder="Description" style="margin-top: 3px;" required>
                    </div>
                    <div class="row">
                        <div class="col-md-2" style="padding:0;">
                        <select id="ddlYears" name="publish_year" class="btn btn-secondary dropdown-toggle" style="background-color: grey;" required>
                            <option value="">-YEARS-</option>
                            <option value="Unknown">Unknown</option>
                        </select>
                        </div>
                        <div class="col-3" style="padding:0;">
                        <select id="type" name="genre" class="btn btn-secondary dropdown-toggle" style="background-color: grey;" required>
                            <option value="">-GENRE-</option>
                            <option value="Horror">Horror</option>
                            <option value="Romance">Romance</option>
                            <option value="High Quality Material">High Quality Material</option>
                        </select>
                        </div>
                        <div class="col-7" style="padding:0;">
                        <button class="btn btn-primary" type="submit" name="btn" style="padding-top: 5px;background-color: blue;float:right;">UPLOAD</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <hr>

        <!-- material list -->
        <div class="row" style="margin-top: 17px;background: #f1f7fc; margin:20px 0; padding:5px 5px;">
            <div class="col">
                <div class="table-responsive">
                    <h3>Material List</h3>
                    <table id="material_list" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Material ID</th>
                                <th>Material Title</th>
                                <th>Author Name</th>
                                <th>Publish Year</th>
                                <th>Genre</th>
                                <th>Pages</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql_material = "SELECT * FROM material ORDER BY material_ID ASC";

                            $query_material = mysqli_query($conn, $sql_material);

                            while ($material = mysqli_fetch_array($query_material)) {
                                echo "
                                    <tr>
                                        <td>".$material['material_ID']."</td>
                                        <td>".$material['material_title']."</td>
                                        <td>".$material['author_name']."</td>
                                        <td>".$material['publish_year']."</td>
                                        <td>".$material['material_genre']."</td>
                                        <td>".$material['page_num']."</td>
                                        <td><a href='../controller/download.php?materialID=".$material['material_ID']."&title=".$material['material_title']."&librarian=yes'>".$material['material_ID'].".pdf</a></td>
                                        <td>
                                        <form action='../controller/manage_material.php' method='post'>
                                            <a class='btn btn-default fas fa-edit' href='update_form.php?material_ID=".$material['material_ID']."'></a>
                                            <button type='submit' onclick='delete_material()' class='btn btn-default fas fa-trash-alt' name='delete' value='".$material['material_ID']."'></button>
                                        </form>
                                        </td>
                                    </tr>
                                ";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
  </main>

  <!-- Bootstrap JS Files -->
  <script src="../src/js/bootstrap.bundle.min.js"></script> 
  <!-- UI JS File -->
  <script src="../src/js/main.js"></script>
  
  <!-- Cover Image Preview JS -->
  <script src="../src/js/cover_preview.js"></script>
  <script>
        //material list
        let material_list = new DataTable('#material_list', {
            pageLength : 5,
            lengthMenu: [[5, 10, 20], [5, 10, 20]]
        });

        //drop down list of years selection
        window.onload = function () {
            //Reference the DropDownList.
            var ddlYears = document.getElementById("ddlYears");

            //Determine the Current Year.
            var currentYear = (new Date()).getFullYear();

            //Loop and add the Year values to DropDownList.
            for (var i = currentYear; i >= 1600 ; i--) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;
                ddlYears.appendChild(option);
            }
        };

        //prompt confirmation box to delete material
        function delete_material(){
            var delete_material = confirm('Are you sure you want to delete this material?');
            if(delete_material == false){
            event.preventDefault();
            }
        }
    </script>
</body>

</html>