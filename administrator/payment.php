<?php 
    session_start();

    //Check login status
    require('../controller/admin_login_status.php');
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
        <a class="nav-link" href="payment.php">
          <span>Payment</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="subscription.php">
          <span>Subscription</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="manage_librarian.php">
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
      <h1>Payment List</h1>
    </div>

    <section class="section dashboard">
      <div class="row">

        <!-- Payment List -->
        <div class="col-lg-12">
          <div class="table-responsive">
            <table id="payment_list" class="table table-bordered table-striped" style="width:100%">
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
      </div>
    </section>
  </main>

  <!-- Bootstrap JS Files -->
  <script src="../src/js/bootstrap.bundle.min.js"></script> 
  <!-- UI JS File -->
  <script src="../src/js/main.js"></script>

  <script>
      //payment list
      let payment_list = new DataTable('#payment_list', {
          pageLength : 5,
          lengthMenu: [[5, 10, 20], [5, 10, 20]]
      });
  </script>
</body>
</html>