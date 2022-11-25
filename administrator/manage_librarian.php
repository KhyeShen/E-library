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
  <title>SCPG E-library</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">

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
        <a href="dashboard.php" class="logo d-flex align-items-center">
            <img src="../src/image/segi_logo.png" alt="">
            <span class="d-none d-lg-block">SCPG E-Library</span>
        </a>
        <i class="fas fa-bars toggle-sidebar-btn"></i>
    </div>

    <!-- Dropdown Menu -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['admin_name']; ?></h6>
              <span>Administrator</span>
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
              <a class="dropdown-item d-flex align-items-center" href="../controller/admin_logout.php">
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
        <a class="nav-link collapsed" href="dashboard.php">
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="payment.php">
          <span>Payment</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="subscription.php">
          <span>Subscription</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="manage_librarian.php">
          <span>Librarian</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="manage_student.php">
          <span>Student</span>
        </a>
      </li>
    </ul>
  </aside>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Librarian Account Management</h1>
    </div>

    <!-- Librarian -->
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <!-- Librarian Form -->
            <form action="../controller/librarian_control.php" method="post" enctype="multipart/form-data">
                <div class="" style="margin-top: 17px;">
                    <b>Librarian Name</b>
                    <div class="col">
                        <input class="form-control" type="text" name="librarian_name" placeholder="Librarian Name" style="margin-top: 3px;" required>
                    </div>
                </div>
                <div class="" style="margin-top: 17px;">
                    <b>Email Address</b>
                    <div class="col">
                        <input class="form-control" type="email" name="librarian_email" placeholder="Librarian Email" style="margin-top: 3px;" autocomplete="new-password" required>
                    </div>
                </div>
                <div class="" style="margin-top: 17px;">
                    <b>Password</b>
                    <div class="col">
                        <input class="form-control" type="password" name="password" placeholder="Password" style="margin-top: 3px;" autocomplete="off" required>
                    </div>
                </div>
                <div class="" style="margin-top: 14px; text-align:right;">
                    <div class="col text-end" style="padding-top: 11px;">
                        <button class="btn btn-primary" type="submit" name="add" style="padding-top: 5px;margin-top: -12px;background: blue;">ADD</button>
                    </div>
                </div>
            </form>
          </div>
          
          <hr>

          <!-- Librarian list -->
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
                                            <form action='../controller/librarian_control.php' method='post'>
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
      let student_list = new DataTable('#librarian_list', {
          pageLength : 5,
          lengthMenu: [[5, 10, 20], [5, 10, 20]]
      });
  </script>
</body>
</html>