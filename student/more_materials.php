<?php 
session_start();

//DB connection
require('../controller/conn.php');

//Variables
$sql='';
$type="";
$value="";

//determine what should be displayed
if (!isset($_GET['type'])) {
    $type = "All Materials";
} else if(isset($_GET['type']) & isset($_GET['value'])){
    $type = $_GET['type'];
    $value = $_GET['value'];
} 

//Select material
if($value=="Recent Added"){
    $sql='SELECT * FROM material ORDER BY created_datetime DESC';
}  
else if($value=="Trending"){
    $sql='select * from `material` INNER JOIN download ON material.material_ID=download.material_ID group by material.material_ID ORDER by COUNT(download.material_ID) DESC'; 
}  
else{
    $sql='SELECT * FROM material';
}
$result = mysqli_query($conn, $sql);

// determine number of total pages available
$number_of_results = mysqli_num_rows($result);
$results_per_page = 8; 
$number_of_pages = ceil($number_of_results/$results_per_page);

// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
} 

// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;

// retrieve selected results from database and display them on page
$sql=$sql.' LIMIT ' . $this_page_first_result . ',' .  $results_per_page ;
$pageresult = mysqli_query($conn, $sql);
$count = mysqli_num_rows($pageresult);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SCPG E-library</title>
    <!-- Tab icon -->
    <link href="../src/image/segi_logo.png" rel="icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Local CSS -->
    <link rel="stylesheet" href="../src/css/style.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet"/>
</head>
<body>
    <?php require 'nav.php' ?>
    <div class="container" style="margin:20px auto;">
        <!-- Header -->
        <div class="row">
            <h2><b><?php echo $_GET['value']; ?></b></h2>
        </div>

        <!-- Materials Found -->
        <div class="row" style="min-height: 30vh;">
            <?php
                while($row = mysqli_fetch_array($pageresult)) {
                    $average_rating = 0;
                    $download_times = 0;
                    $total_review = 0;
                    $total_user_rating = 0;

                    //Get the times of downloaded
                    $query_download = "SELECT * FROM download WHERE material_ID = '".$row['material_ID']."'";
                    $download = mysqli_query($conn, $query_download);
                    $download_times = mysqli_num_rows($download);

                    //extract the others' review data
                    $review_query = "SELECT * FROM review WHERE material_ID = '".$row['material_ID']."'";
                    $review_result = mysqli_query($conn, $review_query);
                    $total_reviews = mysqli_num_rows($review_result);
                    while($review_row = mysqli_fetch_assoc($review_result)) {
                    $total_user_rating = $total_user_rating + $review_row["score"];
                    }
                    if($total_reviews > 0)
                    {
                        $average_rating = $total_user_rating / $total_reviews;
                        $average_rating = number_format($average_rating, 1);
                    }
            ?>
            <div class="col-md-3">
                <div class="" style="margin-bottom:15px;height:600px;">
                    <div class="product-image" style="height: 459px;">
                        <a href="material_details.php?material_ID=<?php echo $row['material_ID'];?>" target="_blank">
                            <img class="product-thumb" src="../material/cover/<?php echo $row['cover_name'];?>" onerror=this.src="../src/image/HQM.jpg" alt="">
                        </a>
                    </div>
                    <div class="product-info">
                        <b><?php echo substr($row['material_title'],0,100);?></b>
                        <p class="product-short-description"><?php echo $row['author_name'];?></p>
                        <b><?php echo $average_rating; ?>&nbsp;<i class="fas fa-star" style="color:#e6e600;"></i></b>
                        <b>&nbsp;<?php echo $download_times;?>&nbsp;<i class="fas fa-cloud-download-alt" ></i></b>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        
        <?php
        if($number_of_results>0)
        {
        ?>
        <!-- Pagination Button -->
        <nav aria-label="Page navigation example" style="float:right;">
            <ul class="pagination pagination-circle">
                <li class="page-item">
                    <a class="page-link" href="more_materials.php?page=1&type=<?php echo $_GET['type']; ?>&value=<?php echo $_GET['value']; ?>">First</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="more_materials.php?page=<?php if($page==1){echo $page;}else{echo ($page-1);} ?>&type=<?php echo $_GET['type']; ?>&value=<?php echo $_GET['value']; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                    // display the number of navigation button
                    $last_five = $page+4;
                    if($last_five>=$number_of_pages)
                    {
                        $first_num=$number_of_pages-4;
                        if($first_num<=0)
                        {
                            $first_num = 1;
                        }
                        for ($page_num=$first_num;$page_num<=$number_of_pages;$page_num++)
                        {
                            if($page_num!=0)
                            {
                                if($page_num == $page)
                                {
                                    echo '<li class="page-item active" aria-current="page"> <a class="page-link" href="more_materials.php?page='
                                    .$page_num.'&type='.$_GET['type'].'&value='.$_GET['value'].'">'.$page_num.'<span class="visually-hidden">(current)</span></a></li>';
                                }
                                else{
                                    echo '<li class="page-item"><a class="page-link" href="more_materials.php?page='.$page_num.'&type='.$_GET['type'].'&value='
                                    .$_GET['value'].'">' . $page_num . '</a></li>';
                                }
                            }
                        }
                    }
                    else
                    {
                        for ($page_num=$page;$page_num<=($page+4);$page_num++) {
                            if($page_num<=$number_of_pages)
                            {
                                if($page_num == $page)
                                {
                                    echo '<li class="page-item active" aria-current="page"> <a class="page-link" href="more_materials.php?page='.$page_num.'&type='.$_GET['type'].'&value='.$_GET['value'].'">'.$page_num.'<span class="visually-hidden">(current)</span></a></li>';
                                }
                                else{
                                    echo '<li class="page-item"><a class="page-link" href="more_materials.php?page='.$page_num.'&type='.$_GET['type'].'&value='.$_GET['value'].'">' . $page_num . '</a></li>';
                                }
                            }
                        }
                    }
                ?>
                <li class="page-item">
                    <a class="page-link" href="more_materials.php?page=<?php if($page==$number_of_pages){echo $page;}else{echo ($page+1);} ?>&type=<?php echo $_GET['type']; ?>&value=<?php echo $_GET['value']; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="more_materials.php?page=<?php echo $number_of_pages; ?>&type=<?php echo $_GET['type']; ?>&value=<?php echo $_GET['value']; ?>">Last</a>
                </li>
            </ul>
        </nav>
        <?php
        }
        ?>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>
</body>
</html>