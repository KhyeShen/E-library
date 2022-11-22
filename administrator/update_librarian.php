<?php 
session_start();
// if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
// 	$_SESSION['message'] = 'Please Login!!';
// 	header('location:loginpage.php');
// 	exit();
// }

//DB connection
include('../controller/conn.php');

//Get material's data
if(isset($_GET['librarian_ID'])){
    $librarian_ID = $_GET['librarian_ID'];
    $update = mysqli_query($conn,"select * from `librarian` where librarian_ID=".$librarian_ID);
    while ($update_item = mysqli_fetch_array($update)) {
        $librarian_name = $update_item['librarian_name'];
        $librarian_email = $update_item['email'];
        $hash = $update_item['password'];
        $password = password_hash($hash, PASSWORD_DEFAULT);
    };
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- datatables -->
  <link rel="stylesheet" href="../src/css/jquery.dataTables.css">
    <script src="../src/js/jquery-3.5.1.js"></script>
    <script src="../src/js/jquery.dataTables.js"></script>  

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
          <div class="row">
            <form action="../controller/librarian_control.php" method="post" enctype="multipart/form-data">
                <div class="" style="margin-top: 17px;">
                    <b>Librarian Name</b>
                    <div class="col">
                        <input class="form-control" type="text" name="librarian_name" placeholder="Librarian Name" value="<?php echo $librarian_name ?>" style="margin-top: 3px;" required>
                    </div>
                </div>
                <div class="" style="margin-top: 17px;">
                    <b>Email Address</b>
                    <div class="col">
                        <input class="form-control" type="text" name="librarian_email" placeholder="Librarian Email" value="<?php echo $librarian_email ?>" style="margin-top: 3px;" required>
                    </div>
                </div>
                <div class="" style="margin-top: 17px;">
                    <b>Password</b>
                    <div class="col">
                        <input class="form-control" type="password" name="password" placeholder="Password" style="margin-top: 3px;" required>
                    </div>
                </div>
                <div class="" style="margin-top: 14px; text-align:right;">
                    <div class="col text-end" style="padding-top: 11px;">
                        <button class="btn btn-primary" onclick="window.location.href='manage_librarian.php';" style="padding-top: 5px;background:black;float:right; margin-left:3px;">BACK</button>
                        <button class="btn btn-primary" type="submit" name="update" value="<?php echo $librarian_ID; ?>" style="padding-top: 5px;background: blue;float:right;">UPDATE</button>
                    </div>
                </div>
            </form>
          </div>
          
          <hr>

          <!-- librarian list -->
          <div class="row" style="background: #f1f7fc; margin:20px 0; padding:5px 5px;">
                <div class="col">
                    <div class="table-responsive">
                        <h3 style="margin-top:0;">Librarian List</h3>
                        <table id="librarian_list" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Librarian ID</th>
                                    <th>Librarian Name</th>
                                    <th>Email Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql_material = "SELECT * FROM librarian ORDER BY librarian_ID ASC";

                                    $query_material = mysqli_query($conn, $sql_material);

                                    while ($material = mysqli_fetch_array($query_material)) {
                                        echo "
                                            <tr>
                                            <td style='width: 130px;'>".$material['librarian_ID']."</td>
                                                <td>".$material['librarian_name']."</td>
                                                <td>".$material['email']."</td>
                                                <td style='width: 50px; padding:4px 0px 0px 0px;'>
                                                <form action='../controller/manage_material.php' method='post'>
                                                    <a class='btn btn-default fas fa-edit' href='update_librarian.php?librarian_ID=".$material['librarian_ID']."'></a>
                                                    <button type='submit' onclick='remove_librarian()' class='btn btn-default fas fa-trash-alt' name='delete' value='".$material['librarian_ID']."'></button>
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
        //librarian list
        let student_list = new DataTable('#librarian_list', {
            pageLength : 5,
            lengthMenu: [[5, 10, 20], [5, 10, 20]]
        });
    </script>

  <!-- Template Main JS File -->
  <script src="../src/js/main.js"></script>

</body>

</html>