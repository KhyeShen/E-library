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
        <a class="nav-link collapsed" href="upload_form.php">
            <span>Material</span>
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="subscription_list.php">
            <span>Subscription</span>
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="manage_student.php">
            <span>Student</span>
        </a>
        </li>
    </ul>
  </aside>

  <!-- Main Content -->
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Librarian Account Management</h1>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <!-- librarian list -->
          <div class="table-responsive">
                    <table id="student_list" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Email Address</th>
                                <th>Course Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql_material = "SELECT * FROM student ORDER BY student_ID ASC";

                            $query_material = mysqli_query($conn, $sql_material);

                            while ($material = mysqli_fetch_array($query_material)) {
                                if($material['gender']=1)
                                { $gender = "Male"; }
                                else
                                { $gender = "Female"; }

                                
                                echo "
                                    <tr>
                                        <td>".$material['student_ID']."</td>
                                        <td>".$material['student_name']."</td>
                                        <td>".$material['email']."</td>
                                        <td>".$material['course_name']."</td>
                                        <td>".$gender."</td>
                                        <td>".$material['age']."</td>
                                        <td>".$material['status']."</td>
                                        <td>
                                        <form action='../controller/manage_material.php' method='post' style='width: 80px;'>";
                                        if($material['status']=="Frozen")
                                        { 
                                            echo  "<button type='submit' onclick='remove_librarian()' class='btn btn-default fas fa-check' name='delete' value='' style='background-color:#00ff00;'></button>
                                            </form>
                                            </td>
                                            </tr>
                                            ";
                                        }
                                        else if($material['status']=="Active")
                                        { 
                                            echo "<button type='submit' onclick='remove_librarian()' class='btn btn-default fas fa-ban' name='delete' value='' style='background-color:red;'></button>
                                            </form>
                                            </td>
                                    </tr>
                                    ";
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

      </div>
    </section>

  </main>
  <!-- Bootstrap JS Files -->
  <script src="../src/js/bootstrap.bundle.min.js"></script> 
  <!-- UI JS File -->
  <script src="../src/js/main.js"></script>
  <script>
        //prompt confirmation box to delete material
        function remove_librarian(){
                var delete_material = confirm('Are you sure you want to remove this librarian?');
                if(delete_material == false){
                event.preventDefault();
                }
            }

        //librarian list
        let student_list = new DataTable('#student_list', {
            pageLength : 5,
            lengthMenu: [[5, 10, 20], [5, 10, 20]]
        });
    </script>
</body>
</html>