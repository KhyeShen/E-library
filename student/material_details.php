<?php 
session_start();

//Check login status
require('../controller/login_status.php');
//DB connection
require('../controller/conn.php');
//Submit Review PHP
include('../controller/submit_review.php');

//query
$query = mysqli_query($conn,"select * from material WHERE material_ID=".$_GET['material_ID']);
if (mysqli_num_rows($query) != 0){
    $row = mysqli_fetch_array($query);
    $material_ID = $row['material_ID'];
    $material_title = $row['material_title'];
    $cover_name = $row['cover_name'];
    $author_name = $row['author_name'];
    $description = $row['description'];
    $genre = $row['material_genre'];
    $page_num = $row['page_num'];
    $publish_year = $row['publish_year'];
}
else if(mysqli_num_rows($query) == 0){
  header("Location: home.php");
}

//get user's existing review
$review_ID = 0;
$comment = "";
$score = 0;
$review_before = false;
$review = mysqli_query($conn,"select * from review WHERE material_ID=".$_GET['material_ID']." AND student_ID='".$_SESSION['studentID']."'");
if (mysqli_num_rows($review) != 0)
{
    $row = mysqli_fetch_array($review);
    $review_ID = $row['review_ID'];
    $score = $row['score'];
    $comment = $row['comment'];
    $review_before = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Review Module -->
    <link rel="stylesheet" href="../src/css/4.0.0 bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/all.css">
    <script src="../src/js/jquery-3.6.0.min.js"></script>
    <script src="../src/js/popper.min.js"></script>
    <script src="../src/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Nav -->
    <?php include 'nav.php' ?>

    <!-- Scroll To Top Button -->
    <button onclick="topFunction()" class="fas fa-angle-double-up" id="myBtn" title="Go to top"></button>

    <!-- Material Details -->
    <div class="container" style="margin:30px auto ;">
        <div class="row" style="margin-bottom:30px;">
          <div class="col-md-1">
          </div>
          <div class="col-md-3" style="text-align:center; padding-bottom:20px;">
            <div class="product-image">
                <img src="../material/cover/<?php echo $cover_name; ?>" onerror=this.src="../src/image/HQM.jpg" alt="" class="agent-avatar img-fluid" style="height:330px;width: 220px;">
            </div>
            <b id="average_score"></b>&nbsp;<i class="fas fa-star" style="color:#e6e600;">&nbsp;&nbsp;</i>
            <b id="download_times"></b>&nbsp;<i class="fas fa-cloud-download-alt" ></i>
          </div>
          <div class="col-md-7" style="padding:0 0 0 30px;">
            <div class="agent-info-box">
                <div class="agent-title">
                  <div class="title-box-d">
                      <h3 class="title-d"><b><?php echo $material_title; ?> </b>
                      </h3>
                  </div>
                </div>
                <div class="agent-content mb-3">
                  <div style="margin-right:30px;">
                  <p class="content-d color-text-a" style="text-align:justify;">
                      <?php echo $description; ?>
                  </p>
                  </div>
                  <div class="info-agents color-a">
                      <p>
                      <strong>Author: </strong>
                      <span class="color-text-a"><a href="author.php?author=<?php echo $author_name; ?>"><?php echo $author_name; ?></a></span>
                      </p>
                      <p>
                      <strong>Genre: </strong>
                      <span class="color-text-a"><a href="genre.php?type=<?php echo $genre; ?>"><?php echo $genre; ?></a></span>
                      </p>
                      <p>
                      <strong>Pages: </strong>
                      <span class="color-text-a"><?php echo $page_num; ?></span>
                      </p>
                      <p>
                      <strong>Published Year: </strong>
                      <span class="color-text-a"><?php echo $publish_year; ?></span>
                      </p>
                      <button type="button" class="btn btn-primary" onclick="location.href='../controller/view.php?materialID=<?php echo $material_ID; ?>';">View</button>&nbsp;&nbsp;
                      <button type="button" class="btn btn-primary" onclick="location.href='../controller/download.php?materialID=<?php echo $material_ID; ?>&title=<?php echo $material_title; ?>';">Download</button>
                  </div>
                </div>
            </div>
          </div>
        </div>

        <!-- Score Card -->
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

        <!-- List of Review -->
    	<div class="mt-5" id="review_content"></div>
        
        <!-- Review Modal -->
        <div id="review_modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Submit Review</h5>
                        <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center mt-2 mb-4">
                            <i class="fas fa-star star-light-grey submit_star mr-1 text-warning" id="submit_star_1" data-rating="1"></i>
                            <i class="fas fa-star star-light-grey submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                            <i class="fas fa-star star-light-grey submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                            <i class="fas fa-star star-light-grey submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                            <i class="fas fa-star star-light-grey submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                        </h4>
                        <div class="form-group">
                            <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here" maxlength = "600"><?php if($review_before == true){echo $comment;} ?></textarea>
                        </div>
                        <div class="form-group text-center mt-4">
                            <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>

    <style>
    .progress
    {
        background-color:#ffffff;
    }
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
        color:#ffffff;
    }
    .star-light-grey
    {
        color:#e6e6e6;
    }
    .card-body
    {
        background-color: #e6e6e6;
    }
    .card
    {
        background-color: #f2f2f2;
    }
    #myBtn {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 99;
      font-size: 18px;
      border: none;
      outline: none;
      background-color: #A31F37;
      color: white;
      cursor: pointer;
      padding: 15px;
      border-radius: 4px;
    }

    #myBtn:hover {
      background-color: black;
    }
    </style>
    
    <script>
    //load page
    $(document).ready(function(){
        var review_before = false;
        var review_before = "<?= $review_before ?>";
        var review_ID = 0;
        var review_ID = <?= $review_ID ?>;
        var rating_data = 1;
        var user_rating = 0;
        
        //close modal
        $('#close').click(function(){
            $('#review_modal').modal('hide');
        });

        //open review modal
        $('#add_review').click(function(){
                if(review_before == true)
                {
                    reset_background();

                    rating_data = user_rating;
                    for(var count = 1; count <= rating_data; count++)
                    {

                        $('#submit_star_'+count).addClass('text-warning');
                        

                    }
                }
                $('#review_modal').modal('show');
        });

        //click the star to rate the material
        $(document).on('mouseenter', '.submit_star', function(){

            var rating = $(this).data('rating');

            reset_background();

            for(var count = 1; count <= rating; count++)
            {

                $('#submit_star_'+count).addClass('text-warning');

            }

        });

        //clear all the star
        function reset_background()
        {
            for(var count = 1; count <= 5; count++)
            {

                $('#submit_star_'+count).addClass('star-light');

                $('#submit_star_'+count).removeClass('text-warning');

            }
        }

        //hover the star
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

        //submit review
        $('#save_review').click(function(){

            //var user_name = $('#user_name').val();
            var material_ID = <?php echo $_GET['material_ID']; ?>;
            var user_review = $('#user_review').val();

            if(user_review == '')
            {
                alert("Please Fill Both Field");
                return false;
            }
            else
            {
                $.ajax({
                    url:"../controller/submit_review.php",
                    method:"POST",
                    data:{rating_data:rating_data, material_ID:material_ID, user_reviews:user_review, review_ID:<?= $review_ID ?>, student_ID:"<?= $_SESSION['studentID'] ?>"},
                    success:function(data)
                    {
                        $('#review_modal').modal('hide');

                        load_rating_data();

                        alert(data);
                    }
                })
            }
        });

        //load the review's data
        load_rating_data();

        function load_rating_data()
        {
            
            $.ajax({
                url:"../controller/submit_review.php",
                method:"POST",
                data:{action:'load_data',material_ID:<?php echo $_GET['material_ID']; ?>, student_ID:"<?= $_SESSION['studentID']; ?>"},
                dataType:"JSON",
                success:function(data)
                {
                    //Display score card
                    $('#average_score').text(data.average_rating);
                    $('#download_times').text(data.download_times);
                    $('#average_rating').text(data.average_rating);
                    $('#total_review').text(data.total_review);
                    user_rating = data.user_rating;
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

                    //Display the list of review
                    if(data.review_data.length > 0)
                    {
                        var html = '';

                        for(var count = 0; count < data.review_data.length; count++)
                        {
                            html += '<div class="row mb-3"">';

                            html += '<div class="col-sm-12">';

                            html += '<div class="card">';

                            if(data.review_data[count].student_ID == "<?= $_SESSION['studentID'] ?>"){
                            html += '<div class="card-header"><b>'+data.review_data[count].student_ID+' (You)</b></div>';
                            }
                            else{
                            html += '<div class="card-header"><b>'+data.review_data[count].student_ID+'</b></div>';
                            }

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

                            html += '<p align="justify">'+data.review_data[count].user_review+'</p>';

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

    // Get the button
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
      if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
    </script>
</body>
</html>