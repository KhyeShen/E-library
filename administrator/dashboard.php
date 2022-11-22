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
$jan_sql = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 1 and YEAR(payment_datetime) = $current_year");
$feb_sql = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 2 and YEAR(payment_datetime) = $current_year");
$mar_sql = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 3 and YEAR(payment_datetime) = $current_year");
$april_sql = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 4 and YEAR(payment_datetime) = $current_year");
$may_sql = mysqli_query($conn,"select * from payment WHERE MONTH(payment_datetime) = 5 and YEAR(payment_datetime) = $current_year");
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
$subscription_sql = mysqli_query($conn,"select * from subscription");
$subscription = mysqli_num_rows($subscription_sql);
$student_sql = mysqli_query($conn,"select * from student");
$student = mysqli_num_rows($student_sql);

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
$subscribed_sql = mysqli_query($conn,"select * from subscription where status != 'expired'");
$subscribed = mysqli_num_rows($subscribed_sql);
$unsubscribe = $student - $subscribed;
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
  <link href="../src/css/boxicons.min.css" rel="stylesheet">
  <link href="../src/css/quill.snow.css" rel="stylesheet">
  <link href="../src/css/quill.bubble.css" rel="stylesheet">
  <link href="../src/css/remixicon.css" rel="stylesheet">
  <link href="../src/css/style.css" rel="stylesheet">

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

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="dashboard.php">
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
        <a class="nav-link collapsed" href="manage_librarian.php">
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
      <h1>Dashboard</h1>
      <nav>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    <div class="row">
      <!-- Left side columns -->
      <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total Download</h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $download; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total Review</h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $review; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total Subscription</h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $subscription; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total Student</h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <h6><?php echo $student; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->
          </div>
      </div>
    </div>  
        <div class="row">
            <!-- Sales Card -->
            <div class="col-xxl-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Data Comparison</h5>

                  <!-- Pie Chart -->
                  <!-- End Pie CHart -->

                  <div id="piechart1"></div>
                  <div id="piechart2"></div>
                </div>
              </div>
            </div><!-- End Sales Card -->

            <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Monthly Sales</h5>

              <!-- Bar Chart -->
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
              <!-- End Bar Chart -->

            </div>
          </div>
        </div>
            
        </div><!-- End Left side columns -->

        
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../src/js/apexcharts.min.js"></script>
  <script src="../src/js/bootstrap.bundle.min.js"></script> 
  <!-- Template Main JS File -->
  <script src="../src/js/main.js"></script>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
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

        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
        chart.draw(data, options);
      }

      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Subscribed',     <?php echo json_encode($subscribed); ?>],
          ['Unsubscribed',    <?php echo json_encode($unsubscribe); ?>]
        ]);

        var options = {
          title: 'Students',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart.draw(data, options);
      }
    </script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Opening Move', 'Percentage'],
          ["King's pawn (e4)", 44],
          ["Queen's pawn (d4)", 31],
          ["Knight to King 3 (Nf3)", 12],
          ["Queen's bishop pawn (c4)", 10],
          ['Other', 3]
        ]);

        var options = {
          title: 'Chess opening moves',
          width: 900,
          legend: { position: 'none' },
          chart: { title: 'Chess opening moves',
                   subtitle: 'popularity by percentage' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Percentage'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
</body>

</html>