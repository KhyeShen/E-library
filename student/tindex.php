<?php 
session_start();
if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
	$_SESSION['message'] = 'Please Login!!';
	header('location:loginpage.php');
	exit();
}
include('../controller/conn.php');
//query
$result = mysqli_query($conn,"select * from `material` order by created_datetime DESC LIMIT 15");
	
// Include configuration file  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Local CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

</head>
<body>
    <?php include 'nav.php' ?>
    <section class="product" style="margin-top:14px;"> 
        <h2 class="product-category" style="display: inline-block;padding-right:10px;"><b>recently added</b></h2>
        <a href="more_materials.php?type=type&value=Recent Added" style="display: inline-block;">(See All)</a>
        <div class="product-container">
            <button class="pre-btn"><img src="../src/image/arrow.png" alt=""></button>
            <button class="nxt-btn"><img src="../src/image/arrow.png" alt=""></button>
            
            <?php
                $i=0;
                foreach($result as $row){
                $actives='';
                if($i==0){
                $actives='active';
                }
              ?>
              <div class="product-card <?php echo $actives;?>">
                <div class="product-image" style="height:375px;">
                    <a href="" target="_blank">
                      <img class="product-thumb" src="../material/cover/<?php echo $row['cover_name'];?>" onerror=this.src="../src/image/placeholder.jpg" alt="">
                    </a>
                </div>
                <div class="product-info">
                    <b><?php echo $row['material_title'];?></b>
                    <p class="product-short-description"><?php echo $row['author_name'];?></p>
                    <!-- <span class="price">4.0</span> downloaded -->
                    <b>4.0&nbsp;<i class="fas fa-star" style="color:#e6e600;"></i></b>
                    <b>&nbsp;<?php echo $row['download_times'];?>&nbsp;<i class="fas fa-cloud-download-alt" ></i></b>
                </div>
              </div>
              <?php 
              $i++;}
              ?>
        </div>
    </section>
    <section class="product" style="margin-top:14px;"> 
        <h2 class="product-category" style="display: inline-block;padding-right:10px;"><b>trending</b></h2>
        <a href="more_materials.php?type=type&value=Recent Added" style="display: inline-block;">(See All)</a>
        <div class="product-container">
            <button class="pre-btn"><img src="../src/image/arrow.png" alt=""></button>
            <button class="nxt-btn"><img src="../src/image/arrow.png" alt=""></button>
            
            <?php
                $i=0;
                foreach($result as $row){
                $actives='';
                if($i==0){
                $actives='active';
                }
              ?>
              <div class="product-card <?php echo $actives;?>">
                <div class="product-image" style="height:375px;">
                    <a href="" target="_blank">
                      <img class="product-thumb" src="../material/cover/<?php echo $row['cover_name'];?>" onerror=this.src="../src/image/placeholder.jpg" alt="">
                    </a>
                </div>
                <div class="product-info">
                    <b><?php echo $row['material_title'];?></b>
                    <p class="product-short-description"><?php echo $row['author_name'];?></p>
                    <!-- <span class="price">4.0</span> downloaded -->
                    <b>4.0<i class="fas fa-star" style="color:#e6e600;"></i></b>
                    <b>&nbsp;<?php echo $row['download_times'];?>&nbsp;<i class="fas fa-cloud-download-alt" ></i></b>
                </div>
              </div>
              <?php 
              $i++;}
              ?>
        </div>
    </section>
    <section class="product" style="margin-top:14px;"> 
        <h2 class="product-category">trending</h2>
        
        <div class="product-container">
            <button class="pre-btn"><img src="images/arrow.png" alt=""></button>
            <button class="nxt-btn"><img src="images/arrow.png" alt=""></button>
            <div class="product-card">
                <div class="product-image">
                    <img src="images/card1.jpg" class="product-thumb" alt="">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <b>Alice in the wonderland the river at night</b>
                    <p class="product-short-description">Author Name</p>
                    <span class="product-short-description">15 downloaded</span><b style="float:right;">4.0<i class="fas fa-star" style="color:#e6e600;"></i></b>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="images/card2.jpg" class="product-thumb" alt="">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <b>Alice in the wonderland the </b>
                    <p class="product-short-description">Author Name</p>
                    <b style="margin-right: 100px;">4.0</b><span class="product-short-description">0 downloaded</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="images/card3.jpg" class="product-thumb" alt="">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-description">a short line about the cloth..</p>
                    <span class="price">$20</span><span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="images/card4.jpg" class="product-thumb" alt="">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-description">a short line about the cloth..</p>
                    <span class="price">$20</span><span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="images/card5.jpg" class="product-thumb" alt="">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-description">a short line about the cloth..</p>
                    <span class="price">$20</span><span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="images/card6.jpg" class="product-thumb" alt="">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-description">a short line about the cloth..</p>
                    <span class="price">$20</span><span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="images/card7.jpg" class="product-thumb" alt="">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-description">a short line about the cloth..</p>
                    <span class="price">$20</span><span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="images/card8.jpg" class="product-thumb" alt="">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-description">a short line about the cloth..</p>
                    <span class="price">$20</span><span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="images/card9.jpg" class="product-thumb" alt="">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-description">a short line about the cloth..</p>
                    <span class="price">$20</span><span class="actual-price">$40</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="images/card10.jpg" class="product-thumb" alt="">
                    <button class="card-btn">add to wishlist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-description">a short line about the cloth..</p>
                    <span class="price">$20</span><span class="actual-price">$40</span>
                </div>
            </div>
            <?php
                $i=0;
                foreach($result as $row){
                $actives='';
                if($i==0){
                $actives='active';
                }
              ?>
              <div class="product-card <?php echo $actives;?>">
                <div class="product-image">
                    <a href="https://www.youtube.com/c/devbanban" target="_blank">
                      <img class="product-thumb" src="../material/cover/<?php echo $row['cover_name'];?>" alt="">
                    </a>
                </div>
                <div class="product-info">
                    <h2 class="product-brand"><?php echo $row['material_title'];?></h2>
                    <p class="product-short-description"><?php echo $row['material_genre'];?></p>
                    <span class="price">4.0</span><?php echo $row['download_times'];?> downloaded
                </div>
              </div>
              <?php 
              $i++;}
              mysqli_close($conn);
              ?>
        </div>
    </section>
    <?php include 'footer.php' ?>
    <!-- Carousel wrapper -->
    <script src="../src/js/carousel.js"></script>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        function openModal() {
        modal.style.display = "block";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
    </script>
</body>
</html>