<?php 
session_start();
if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
	$_SESSION['message'] = 'Please Login!!';
	header('location:loginpage.php');
	exit();
}
include('../controller/conn.php');
//query
$query = mysqli_query($conn,"SELECT * FROM material WHERE material_title LIKE '%omputer%' ");
if (mysqli_num_rows($query) != 0)
		{
			$row = mysqli_fetch_array($query);
			$material_ID = $row['material_ID'];
      $material_title = $row['material_title'];
      $cover_name = $row['cover_name'];
      $author_name = $row['author_name'];
      $description = $row['description'];
      $genre = $row['material_genre'];
      $page_num = $row['page_num'];
      $publish_year = $row['publish_year'];
      $average_rating = $row['average_rating'];
      $download_times = $row['download_times'];
    }
else if(mysqli_num_rows($query) == 0){
  header("Location: home.php");
  //$_SESSION['message'] = "Invalid Account";
}

// Include configuration file  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />

</head>
<body>
    <?php include 'nav.php' ?>
    <div class="container" style="margin:30px auto ;">
      <div class="row">
          <div class="col-md-5" style="text-align:center;">
            <div class="product-image">
              <img src="../material/cover/<?php echo $cover_name; ?>" alt="" class="agent-avatar img-fluid" style="height:330px;width: 220px;">
            </div>
            <b>4.0<i class="fas fa-star" style="color:#e6e600;"></i></b>
            <b>&nbsp;<?php echo $download_times; ?>&nbsp;<i class="fas fa-cloud-download-alt" ></i></b>
            <div>
            
            </div>
          </div>
          <div class="col-md-7 section-md-t3" style="padding:0 0px 0 30px;">
            <div class="agent-info-box">
              <div class="agent-title">
                <div class="title-box-d">
                  <h3 class="title-d"><b><?php echo $material_title; ?> </b>
                  </h3>
                </div>
              </div>
              <div class="agent-content mb-3">
                <p class="content-d color-text-a">
                <!-- Sed porttitor lectus nibh. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus suscipit tortor eget felis porttitor volutpat. 
                Vivamus suscipit tortor eget felis porttitor volutpat. Sed porttitor lectus nibh. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.
                 Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus suscipit tortor eget felis porttitor volutpat. Sed porttitor lectus nibh. Praesent sapien
                massa, convallis a pellentesque nec, egestas non nisi. Vivamus suscipit tortor eget felis porttitor volutpat. Vivamus suscipit tortor eget felis porttitor
                 volutpat.Sed porttitor lectus nibh. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus suscipit tortor eget felis porttitor. -->
                <?php echo $description; ?>
                </p>
                <div class="info-agents color-a">
                  <p>
                    <strong>Author: </strong>
                    <span class="color-text-a"><a href="#"><?php echo $author_name; ?></a></span>
                  </p>
                  <p>
                    <strong>Genre: </strong>
                    <span class="color-text-a"><a href="#"><?php echo $genre; ?></a></span>
                  </p>
                  <p>
                    <strong>Pages: </strong>
                    <span class="color-text-a"><?php echo $page_num; ?></span>
                  </p>
                  <p>
                    <strong>Published Year: </strong>
                    <span class="color-text-a"><?php echo $publish_year; ?></span>
                  </p>
                  <button type="button" class="btn btn-primary">View</button>
                  <button type="button" class="btn btn-primary">Download</button>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <?php include 'footer.php' ?>
<!-- Carousel wrapper -->
    <script src="script.js"></script>
</body>
</html>