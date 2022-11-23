<?php 
session_start();
//check if student login
if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
	$_SESSION['message'] = 'Please Login!!';
	header('location:index.php');
	exit();
}

//DB connection
include('../controller/conn.php');

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
if($type=="type"){
    $sql='SELECT * FROM material ORDER BY created_datetime DESC';
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
$sql='SELECT * FROM material ORDER BY created_datetime DESC LIMIT ' . $this_page_first_result . ',' .  $results_per_page ;
$pageresult = mysqli_query($conn, $sql);
$count = mysqli_num_rows($pageresult);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Local CSS -->
    <link rel="stylesheet" href="../src/css/style.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet"/>
</head>
<body>
    <?php include 'nav.php' ?>
    <div class="container" style="margin:20px auto;">
        <!-- Header -->
        <div class="row">
            <h2><b><?php echo $_GET['value']; ?></b></h2>
        </div>

        <!-- Materials Found -->
        <div class="row">
            <?php
                while($row = mysqli_fetch_array($pageresult)) {
            ?>
            <div class="col-md-3">
                <div class="" style="margin-bottom:15px;">
                    <div class="product-image" style="height: 459px;">
                        <a href="material_details.php?material_ID=<?php echo $row['material_ID'];?>" target="_blank">
                            <img class="product-thumb" src="../material/cover/<?php echo $row['cover_name'];?>" onerror=this.src="../src/image/HQM.jpg" alt="">
                        </a>
                    </div>
                    <div class="product-info">
                        <b><?php echo $row['material_title'];?></b>
                        <p class="product-short-description"><?php echo $row['author_name'];?></p>
                        <b>4.0&nbsp;<i class="fas fa-star" style="color:#e6e600;"></i></b>
                        <b>&nbsp;<?php echo $row['download_times'];?>&nbsp;<i class="fas fa-cloud-download-alt" ></i></b>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        
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
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>
</body>
</html>