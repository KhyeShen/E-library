<?php 
session_start();
if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
	$_SESSION['message'] = 'Please Login!!';
	header('location:loginpage.php');
	exit();
}
include('../controller/conn.php');

// $sql='';
// $type="";
// $value="";

// //determine what should be displayed
// if (!isset($_GET['type'])) {
//     $type = "All Materials";
// } else if(isset($_GET['type']) & isset($_GET['value'])){
//     $type = $_GET['type'];
//     $value = $_GET['value'];
// } 
if (isset($_POST['search'])) {
    $_SESSION['search'] = $_POST['search'];
}else if(!isset($_SESSION['search']))
{
    header('location:home.php');
}
    $filtervalues = $_SESSION['search'];
// if($type=="type"){
    $sql="SELECT * FROM material WHERE CONCAT(material_title,author_name) LIKE '%$filtervalues%' ";
//}  

$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);
$results_per_page = 8; 

// determine number of total pages available
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
$sql='SELECT * FROM material WHERE CONCAT(material_title,author_name) LIKE "%'.$filtervalues.'%" LIMIT ' . $this_page_first_result . ',' .  $results_per_page ;
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
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet"/>
</head>
<body>
    <?php include 'nav.php' ?>
    <div class="container" style="margin:20px auto;">
        <div class="row">
            <!-- <div class="col-5"> -->
                <h2><b>Search Results: </b><?php echo $number_of_results; ?></h2>
            <!-- </div> -->
        </div>
        <div class="row">
            <?php
                while($row = mysqli_fetch_array($pageresult)) {
            ?>
            <div class="col-md-3">
                <div class="" style="margin-bottom:15px;">
                    <div class="product-image" style="height: 459px;">
                        <a href="material_detail.php?material_ID=<?php echo $row['material_ID'];?>" target="_blank">
                            <img class="product-thumb" src="../material/cover/<?php echo $row['cover_name'];?>" alt="">
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
        
        <nav aria-label="Page navigation example" style="float:right;">
            <ul class="pagination pagination-circle">
                <li class="page-item">
                    <a class="page-link" href="search_result.php?page=1">First</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="search_result.php?page=<?php if($page==1){echo $page;}else{echo ($page-1);} ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                    // display the links to the pages
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
                                    echo '<li class="page-item active" aria-current="page"> <a class="page-link" href="search_result.php?page='
                                    .$page_num.'">'.$page_num.'<span class="visually-hidden">(current)</span></a></li>';
                                }
                                else{
                                    echo '<li class="page-item"><a class="page-link" href="search_result.php?page='.$page_num.'">' . $page_num . '</a></li>';
                                }
                            }
                        }
                    }
                    else
                    {
                        for ($page_num=$page;$page_num<=($page+4);$page_num++) {
                            //echo '<a href="index.php?page=' . $page . '">' . $page . '</a> ';
                            if($page_num<=$number_of_pages)
                            {
                                if($page_num == $page)
                                {
                                    echo '<li class="page-item active" aria-current="page"> <a class="page-link" href="search_result.php?page='.$page_num.'">'.$page_num.'<span class="visually-hidden">(current)</span></a></li>';
                                }
                                else{
                                    echo '<li class="page-item"><a class="page-link" href="search_result.php?page='.$page_num.'">' . $page_num . '</a></li>';
                                }
                            }
                        }
                    }
                ?>
                <li class="page-item">
                    <a class="page-link" href="search_result.php?page=<?php if($page==$number_of_pages){echo $page;}else{echo ($page+1);} ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="search_result.php?page=<?php echo $number_of_pages; ?>">Last</a>
                </li>
            </ul>
        </nav>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>