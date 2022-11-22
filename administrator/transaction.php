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

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  
  <!-- Favicons -->
  <link href="../src/image/segi_logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../src/css/bootstrap_dashboard.css" rel="stylesheet">
  <link href="../src/css/bootstrap-icons.css" rel="stylesheet">
  <!-- <link href="../src/css/boxicons.min.css" rel="stylesheet">
  <link href="../src/css/quill.snow.css" rel="stylesheet">
  <link href="../src/css/quill.bubble.css" rel="stylesheet">
  <link href="../src/css/remixicon.css" rel="stylesheet">
  <link href="../src/css/style.css" rel="stylesheet"> -->

  
  <!-- Template Main CSS File -->
  <link href="../src/css/dashboard.css" rel="stylesheet">

  
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  <!-- datatables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="../src/image/segi_logo.png" alt="">
            <span class="d-none d-lg-block">SCPG E-Library</span>
        </a>
        <i class="fas fa-bars toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Administrator</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <span>Change Password</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard.php">
            <span>Dashboard</span>
        </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
        <a class="nav-link collapsed" href="transaction.php">
            <span>Transaction</span>
        </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
        <a class="nav-link collapsed" href="subscription.php">
            <span>Subscription</span>
        </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
        <a class="nav-link" href="manage_librarian.php">
            <span>Librarian</span>
        </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
        <a class="nav-link collapsed" href="manage_student.php">
            <span>Student</span>
        </a>
        </li><!-- End Profile Page Nav -->  

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Librarian Account Management</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <!-- librarian list -->
          <div class="table-responsive">
                    <table id="student_list" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Student ID</th>
                                <th>Stripe Subscription ID</th>
                                <th>Amount</th>
                                <th>Date Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql_material = "SELECT * FROM payment ORDER BY payment_ID ASC";

                            $query_material = mysqli_query($conn, $sql_material);

                            while ($material = mysqli_fetch_array($query_material)) {
                                echo "
                                    <tr>
                                        <td>".$material['payment_ID']."</td>
                                        <td>".$material['student_ID']."</td>
                                        <td>".$material['stripe_subscription_ID']."</td>
                                        <td>".$material['amount']."</td>
                                        <td>".$material['payment_datetime']."</td>
                                        <td>".$material['status']."</td>
                                            </tr>
                                            ";
                                        
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- Vendor JS Files -->
  <!-- <script src="../src/js/bootstrap.bundle.min.js"></script>
  <script src="../src/js/apexcharts.min.js"></script>
  <script src="../src/js/chart.min.js"></script>
  <script src="../src/js/echarts.min.js"></script>
  <script src="../src/js/quill.min.js"></script>
  <script src="../src/js/simple-datatables.js"></script>
  <script src="../src/js/tinymce.min.js"></script>
  <script src="../src/js/validate.js"></script> -->

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

  <!-- Template Main JS File -->
  <script src="../src/js/main.js"></script>

</body>

</html>