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
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="all.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <!-- Review Module -->
    <script src="../src/js/jquery-3.6.0.min.js"></script>
    <script src="../src/js/popper.min.js"></script>
    <script src="../src/js/bootstrap.min.js"></script>

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
                  <button type="button" class="btn btn-primary" onclick="location.href='../material/file/161.pdf';">View</button>
                  <button type="button" class="btn btn-primary">Download</button>
                </div>
              </div>
            </div>
          </div>
      </div>
    	<div class="card" style="background-color:#e6e6e6;">
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
                            <div class="progress" style="height:15px;">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress" ></div>
                            </div>
                        </p>
    					<p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress" style="height:15px;">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress" style="height:15px;">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress" style="height:15px;">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress" style="height:15px;">
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
    	<div class="mt-5" id="review_content"></div>
        <div id="review_modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Submit Review</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center mt-2 mb-4">
                            <i class="fas fa-star star-light submit_star mr-1 text-warning" id="submit_star_1" data-rating="1"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                        </h4>
                        <div class="form-group">
                            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
                        </div>
                        <div class="form-group">
                            <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                        </div>
                        <div class="form-group text-center mt-4">
                            <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
    <style>
    .progress-label-left
    {
        float: left;
        margin-right: 0.5em;
        line-height: 1em;
    }
    .progress-label-right
    {
        float: right;
        margin-left: 0.3em;
        line-height: 1em;
    }
    .star-light
    {
        color:#e9ecef;
    }
    </style>
    
    <script>

    $(document).ready(function(){

        var rating_data = 1;

        $('#add_review').click(function(){

            $('#review_modal').modal('show');

        });

        $(document).on('mouseenter', '.submit_star', function(){

            var rating = $(this).data('rating');

            reset_background();

            for(var count = 1; count <= rating; count++)
            {

                $('#submit_star_'+count).addClass('text-warning');

            }

        });

        function reset_background()
        {
            for(var count = 1; count <= 5; count++)
            {

                $('#submit_star_'+count).addClass('star-light');

                $('#submit_star_'+count).removeClass('text-warning');

            }
        }

        $(document).on('mouseleave', '.submit_star', function(){

            reset_background();

            for(var count = 1; count <= rating_data; count++)
            {

                $('#submit_star_'+count).removeClass('star-light');

                $('#submit_star_'+count).addClass('text-warning');
            }

        });

        $(document).on('click', '.submit_star', function(){

            rating_data = $(this).data('rating');

        });

        $('#save_review').click(function(){

            var user_name = $('#user_name').val();
            var material_ID = <?php echo $_GET['material_ID']; ?>;
            var user_review = $('#user_review').val();

            if(user_name == '' || user_review == '')
            {
                alert("Please Fill Both Field");
                return false;
            }
            else
            {
                $.ajax({
                    url:"controller/submit_review.php",
                    method:"POST",
                    data:{rating_data:rating_data, user_name:user_name, material_ID:material_ID, user_reviews:user_review},
                    success:function(data)
                    {
                        $('#review_modal').modal('hide');

                        load_rating_data();

                        alert(data);
                    }
                })
            }

        });

        load_rating_data();

        function load_rating_data()
        {
            $.ajax({
                url:"controller/submit_review.php",
                method:"POST",
                data:{action:'load_data',material_ID:<?php echo $_GET['material_ID']; ?>},
                dataType:"JSON",
                success:function(data)
                {
                    $('#average_rating').text(data.average_rating);
                    $('#total_review').text(data.total_review);

                    var count_star = 0;

                    $('.main_star').each(function(){
                        count_star++;
                        if(Math.ceil(data.average_rating) >= count_star)
                        {
                            $(this).addClass('text-warning');
                            $(this).addClass('star-light');
                        }
                    });

                    $('#total_five_star_review').text(data.five_star_review);

                    $('#total_four_star_review').text(data.four_star_review);

                    $('#total_three_star_review').text(data.three_star_review);

                    $('#total_two_star_review').text(data.two_star_review);

                    $('#total_one_star_review').text(data.one_star_review);

                    $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                    $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                    $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                    $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                    $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

                    if(data.review_data.length > 0)
                    {
                        var html = '';

                        for(var count = 0; count < data.review_data.length; count++)
                        {
                            html += '<div class="row mb-3">';


                            html += '<div class="col-sm-12">';

                            html += '<div class="card">';

                            html += '<div class="card-header"><b>'+data.review_data[count].student_ID+'</b></div>';

                            html += '<div class="card-body">';

                            for(var star = 1; star <= 5; star++)
                            {
                                var class_name = '';

                                if(data.review_data[count].rating >= star)
                                {
                                    class_name = 'text-warning';
                                }
                                else
                                {
                                    class_name = 'star-light';
                                }

                                html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                            }

                            html += '<br />';

                            html += data.review_data[count].user_review;

                            html += '</div>';

                            html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';

                            html += '</div>';

                            html += '</div>';

                            html += '</div>';
                        }

                        $('#review_content').html(html);
                    }
                }
            })
        }

    });

    </script>
    <!-- Carousel wrapper -->
    <script src="script.js"></script>
</body>
</html>