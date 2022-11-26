<?php 
//DB connection
require('../controller/conn.php');

//Select material 
$recent_added = mysqli_query($conn,"select * from `material` order by created_datetime DESC LIMIT 15");
$trending = mysqli_query($conn,"select * from `material` INNER JOIN download ON material.material_ID=download.material_ID group by material.material_ID ORDER by COUNT(download.material_ID) DESC"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Local CSS -->
    <link rel="stylesheet" href="../src/css/style.css">
    <!-- MDB -->
    <link rel="stylesheet" href="../src/css/mdb.min.css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    
</head>
<body>
    <!-- Navigation Bar -->
    <?php require 'index_nav.php' ?>

    <!-- Recently Added Material -->
    <section class="product" style="margin-top:14px;"> 
        <h2 class="product-category" style="display: inline-block;padding-right:10px;"><b>recently added</b></h2>
        <a href="more_materials.php?type=type&value=Recent Added" style="display: inline-block;">(View All)</a>
        <div class="product-container">
            <button class="pre-btn"><img src="../src/image/arrow.png" alt=""></button>
            <button class="nxt-btn"><img src="../src/image/arrow.png" alt=""></button>
            
            <!-- Fetch material's data -->
            <?php
                $i=0;
                foreach($recent_added as $row_recent){
                $actives='';
                if($i==0){
                $actives='active';
                }
                $average_rating = 0;
                $download_times = 0;
                $total_review = 0;
                $total_user_rating = 0;
                $query1 = "SELECT * FROM review WHERE material_ID = '".$row_recent['material_ID']."'";
                $result = mysqli_query($conn, $query1);

                if (mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result)) {
                        $total_review++;
                        $total_user_rating = $total_user_rating + $row["score"];
                    }
                }
                if($total_user_rating > 0)
                {
                    $average_rating = $total_user_rating / $total_review;
                }
                $query_download = "SELECT * FROM download WHERE material_ID = '".$row_recent['material_ID']."'";
                $download = mysqli_query($conn, $query_download);
                $download_times = mysqli_num_rows($download);
            ?>

            <!-- Material Card -->
            <div class="product-card <?php echo $actives;?>">
                <div class="product-image" style="height:375px;">
                    <a href="material_details.php?material_ID=<?php echo $row_recent['material_ID']; ?>" target="_blank">
                        <img class="product-thumb" src="../material/cover/<?php echo $row_recent['cover_name'];?>" onerror=this.src="../src/image/HQM.jpg" alt="">
                    </a>
                </div>
                <div class="product-info">
                    <b><?php echo $row_recent['material_title'];?></b>
                    <p class="product-short-description"><?php echo $row_recent['author_name'];?></p>
                    <b><?php echo number_format($average_rating, 1); ?>&nbsp;<i class="fas fa-star" style="color:#e6e600;"></i></b>
                    <b>&nbsp;&nbsp;<?php echo $download_times;?>&nbsp;<i class="fas fa-cloud-download-alt" ></i></b>
                </div>
            </div>

            <?php 
            $i++;}
            ?>
        </div>
    </section>

    <!-- Trending Material -->
    <section class="product" style="margin-top:14px;"> 
        <h2 class="product-category" style="display: inline-block;padding-right:10px;"><b>trending</b></h2>
        <a href="more_materials.php?type=type&value=Recent Added" style="display: inline-block;">(View All)</a>
        <div class="product-container">
            <button class="pre-btn"><img src="../src/image/arrow.png" alt=""></button>
            <button class="nxt-btn"><img src="../src/image/arrow.png" alt=""></button>
            
            <!-- Fetch material's data -->
            <?php
                $i=0;
                foreach($trending as $row_trending){
                $actives='';
                if($i==0){
                $actives='active';
                }
                $average_rating = 0;
                $download_times = 0;
                $total_review = 0;
                $total_user_rating = 0;
                $query1 = "SELECT * FROM review WHERE material_ID = '".$row_trending['material_ID']."'";
                $result = mysqli_query($conn, $query1);

                if (mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result)) {
                        $total_review++;
                        $total_user_rating = $total_user_rating + $row["score"];
                    }
                }
                if($total_user_rating > 0)
                {
                    $average_rating = $total_user_rating / $total_review;
                }
                $query_download = "SELECT * FROM download WHERE material_ID = '".$row_trending['material_ID']."'";
                $download = mysqli_query($conn, $query_download);
                $download_times = mysqli_num_rows($download);
            ?>

            <!-- Material Card -->
            <div class="product-card <?php echo $actives;?>">
                <div class="product-image" style="height:375px;">
                    <a href="material_details.php?material_ID=<?php echo $row_trending['material_ID']; ?>" target="_blank">
                        <img class="product-thumb" src="../material/cover/<?php echo $row_trending['cover_name'];?>" onerror=this.src="../src/image/HQM.jpg" alt="">
                    </a>
                </div>
                <div class="product-info">
                    <b><?php echo $row_trending['material_title'];?></b>
                    <p class="product-short-description"><?php echo $row_trending['author_name'];?></p>
                    <b><?php echo number_format($average_rating, 1); ?>&nbsp;<i class="fas fa-star" style="color:#e6e600;"></i></b>
                    <b>&nbsp;&nbsp;<?php echo $download_times;?>&nbsp;<i class="fas fa-cloud-download-alt" ></i></b>
                </div>
            </div>
            <?php 
                $i++;}
            ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php' ?>

    <!-- Carousel wrapper -->
    <script src="../src/js/carousel.js"></script>
</body>
</html>