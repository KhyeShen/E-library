<?php 
session_start();
// if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
// 	$_SESSION['message'] = 'Please Login!!';
// 	header('location:loginpage.php');
// 	exit();
// }

//DB connection
include('../controller/conn.php');

//Current Year
date_default_timezone_set("Asia/Kuala_Lumpur");
$current_year = date("Y");

//Monthly Sales
$jan_sql  = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 1 and YEAR(payment_datetime) = $current_year");
$feb_sql  = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 2 and YEAR(payment_datetime) = $current_year");
$mar_sql  = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 3 and YEAR(payment_datetime) = $current_year");
$april_sql = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 4 and YEAR(payment_datetime) = $current_year");
$may_sql  = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 5 and YEAR(payment_datetime) = $current_year");
$june_sql = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 6 and YEAR(payment_datetime) = $current_year");
$july_sql = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 7 and YEAR(payment_datetime) = $current_year");
$aug_sql = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 8 and YEAR(payment_datetime) = $current_year");
$sep_sql = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 9 and YEAR(payment_datetime) = $current_year");
$oct_sql = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 10 and YEAR(payment_datetime) = $current_year");
$nov_sql = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 11 and YEAR(payment_datetime) = $current_year");
$dec_sql = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 12 and YEAR(payment_datetime) = $current_year");
$jan_sales = mysqli_num_rows($jan_sql);
$feb_sales = mysqli_num_rows($feb_sql);
$mar_sales = mysqli_num_rows($mar_sql);
$april_sales = mysqli_num_rows($april_sql);
$may_sales = mysqli_num_rows($may_sql);
$june_sales = mysqli_num_rows($june_sql);
$july_sales = mysqli_num_rows($july_sql);
$aug_sales = mysqli_num_rows($aug_sql);
$sep_sales = mysqli_num_rows($sep_sql);
$oct_sales = mysqli_num_rows($oct_sql);
$nov_sales = mysqli_num_rows($nov_sql);
$dec_sales = mysqli_num_rows($dec_sql);

//Total of *
$download_sql = mysqli_query($conn,"select * from download");
$download = mysqli_num_rows($download_sql);
$review_sql = mysqli_query($conn,"select * from review");
$review = mysqli_num_rows($review_sql);
$student_sql = mysqli_query($conn,"select * from student");
$student = mysqli_num_rows($student_sql);
$material_sql = mysqli_query($conn,"select * from material");
$material = mysqli_num_rows($material_sql);

//Download Times Genre
$horror_download_sql = mysqli_query($conn,"select * from download join material on download.material_ID=material.material_ID where material.material_genre = 'horror' and download.material_ID =  material.material_ID");
$romance_download_sql = mysqli_query($conn,"select * from download join material on download.material_ID=material.material_ID where material.material_genre = 'romance' and download.material_ID =  material.material_ID");
$fantasy_download_sql = mysqli_query($conn,"select * from download join material on download.material_ID=material.material_ID where material.material_genre = 'fantasy' and download.material_ID =  material.material_ID");
$historical_download_sql = mysqli_query($conn,"select * from download join material on download.material_ID=material.material_ID where material.material_genre = 'historical' and download.material_ID =  material.material_ID");
$hqm_download_sql = mysqli_query($conn,"select * from download join material on download.material_ID=material.material_ID where material.material_genre = 'high quality material' and download.material_ID =  material.material_ID");
$horror_download = mysqli_num_rows($horror_download_sql);
$romance_download = mysqli_num_rows($romance_download_sql);
$fantasy_download = mysqli_num_rows($fantasy_download_sql);
$historical_download = mysqli_num_rows($historical_download_sql);
$hqm_download = mysqli_num_rows($hqm_download_sql);

//Student Pie Chart
$subscribed_sql = mysqli_query($conn,"select * from student where subscription = Premium");
$subscribed = mysqli_num_rows($subscribed_sql);
$unsubscribed_sql = mysqli_query($conn,"select * from student where subscription = None");
$unsubscribed = mysqli_num_rows($unsubscribed_sql);
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
        <a class="nav-link " href="dashboard.php">
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

  <!-- Main Contents -->
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <!-- Total Download Times -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total Downloads</h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $download; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Reviews -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total Reviews</h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $review; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Subscriptions -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total Students</h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $student; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Students -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total Materials</h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $material; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
      <div class="row">
        <!-- Pie Chart -->
        <div class="col-xxl-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Comparison</h5>
              <!-- Download Times Pie Chart -->
              <div id="download_piechart"></div>
              <!-- Student by Subscription Pie Chart -->
              <div id="student_subscription_piechart"></div>
            </div>
          </div>
        </div>

        <!-- Bar Chart -->
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Monthly Revenue</h5>

              <!-- Monthly Revenue Bar Chart -->
              <div id="barChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#barChart"), {
                    series: [{
                      data: [<?php echo json_encode($jan_sales); ?>, <?php echo json_encode($feb_sales); ?>, <?php echo json_encode($mar_sales); ?>, 
                      <?php echo json_encode($april_sales); ?>, <?php echo json_encode($may_sales); ?>, <?php echo json_encode($june_sales); ?>, 
                      <?php echo json_encode($july_sales); ?>, <?php echo json_encode($aug_sales); ?>, <?php echo json_encode($sep_sales); ?>, 
                      <?php echo json_encode($oct_sales); ?>, <?php echo json_encode($nov_sales); ?>, <?php echo json_encode($dec_sales); ?>]
                    }],
                    chart: {
                      type: 'bar',
                      height: 350
                    },
                    plotOptions: {
                      bar: {
                        borderRadius: 4,
                        horizontal: true,
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    xaxis: {
                      categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                      ],
                    }
                  }).render();
                });
              </script>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Bar Chart JS Files -->
  <script src="../src/js/apexcharts.min.js"></script>
  <!-- Bootstrap JS Files -->
  <script src="../src/js/bootstrap.bundle.min.js"></script> 
  <!-- UI JS File -->
  <script src="../src/js/main.js"></script>
  <!-- Google Pie Chart JS File -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script type="text/javascript">
    //Download Times By Genre Pie Chart
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Horror',     <?php echo json_encode($horror_download); ?>],
        ['Fantasy',      <?php echo json_encode($fantasy_download); ?>],
        ['Historical',  <?php echo json_encode($historical_download); ?>],
        ['Romance', <?php echo json_encode($romance_download); ?>],
        ['High Quality Material',    <?php echo json_encode($hqm_download); ?>]
      ]);

      var options = {
        title: 'Download Times By Genre',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('download_piechart'));
      chart.draw(data, options);
    }

    //Students Pie Chart
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart2);
    function drawChart2() {
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Subscribed',     <?php echo json_encode($subscribed); ?>],
        ['Unsubscribed',    <?php echo json_encode($unsubscribed); ?>]
      ]);

      var options = {
        title: 'Students',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('student_subscription_piechart'));
      chart.draw(data, options);
    }
  </script>
</body>

</html>