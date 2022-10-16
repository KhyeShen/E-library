<?php 
session_start();
if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
	$_SESSION['message'] = 'Please Login!!';
	header('location:loginpage.php');
	exit();
}
include('../controller/conn.php');
//query
$query = mysqli_query($conn,"select * from material WHERE material_ID=".$_GET['material_ID']);
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
      <div class="card" style="background-color:#d9d9d9;">
    		<div class="card-body">
    			<div class="row">
    				<div class="col-sm-4 text-center">
    					<h1 class="text-warning mt-4 mb-4">
    						<b><span id="average_rating">0.0</span> / 5</b>
    					</h1>
    					<div class="mb-3">
    						<i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
	    				</div>
    					<h3><span id="total_review">0</span> Review</h3>
    				</div>
    				<div class="col-sm-4">
    					<p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>               
                        </p>
    				</div>
    				<div class="col-sm-4 text-center">
    					<h3 class="mt-4 mb-3">Write Review Here</h3>
    					<button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
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