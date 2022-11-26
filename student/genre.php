<?php 
    session_start();

    //DB connection
    require('../controller/conn.php');

    //Variables
    $search_value = "";

    //Determine what should be displayed
    if(isset($_GET['type'])){
        $_SESSION['type'] = $_GET['type'];
    } 
    $filtervalues = $_SESSION['type'];
    $sql="SELECT * FROM material WHERE material_genre = '".$filtervalues."'";

    //Materials Type
    if($filtervalues != "High Quality Materials")
    {
        $title = $filtervalues." Books";
    }else{
        $title = $filtervalues;
    }
    
    // determine number of total pages available
    $result = mysqli_query($conn, $sql);
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

    // retrieve selected results from database and display them page by page
    $sql='SELECT * FROM material WHERE  material_genre = "'.$filtervalues.'" LIMIT ' . $this_page_first_result . ',' .  $results_per_page ;
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
<body >
    <!-- Nav -->
    <?php
    if (isset($_SESSION['studentID']))
    {
        require 'nav.php';
    }  
    else
    {
        require 'index_nav.php';
    }?>

    <!-- Container -->
    <div class="container" style="margin:20px auto;">
        <!-- Materials -->
        <div class="row">
            <h2><b><?php echo $title; ?> </b>(<?php echo $number_of_results; ?>)</h2>
        </div>
        <div class="row">
            <?php
                while($row_search = mysqli_fetch_array($pageresult)) {
                $average_rating = 0;
                $download_times = 0;
                $total_review = 0;
                $total_user_rating = 0;
                $query1 = "SELECT * FROM review WHERE material_ID = '".$row_search['material_ID']."'";
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
                $query_download = "SELECT * FROM download WHERE material_ID = '".$row_search['material_ID']."'";
                $download = mysqli_query($conn, $query_download);
                $download_times = mysqli_num_rows($download);
            ?>
            <div class="col-md-3">
                <div class="" style="margin-bottom:15px;height:600px;">
                    <div class="product-image" style="height: 459px;">
                        <a href="material_details.php?material_ID=<?php echo $row_search['material_ID'];?>" target="_blank">
                            <img class="product-thumb" src="../material/cover/<?php echo $row_search['cover_name'];?>" onerror=this.src="../src/image/HQM.jpg" alt="">
                        </a>
                    </div>
                    <div class="product-info">
                        <b><?php echo substr($row_search['material_title'],0,100);?></b>
                        <p class="product-short-description"><?php echo $row_search['author_name'];?></p>
                        <b><?php echo number_format($average_rating, 1); ?>&nbsp;<i class="fas fa-star" style="color:#e6e600;"></i></b>
                        <b>&nbsp;&nbsp;<?php echo $download_times;?>&nbsp;<i class="fas fa-cloud-download-alt" ></i></b>
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
                    <a class="page-link" href="genre.php?page=1">First</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="genre.php?page=<?php if($page==1){echo $page;}else{echo ($page-1);} ?>" aria-label="Previous">
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
                                    echo '<li class="page-item active" aria-current="page"> <a class="page-link" href="genre.php?page='
                                    .$page_num.'">'.$page_num.'<span class="visually-hidden">(current)</span></a></li>';
                                }
                                else{
                                    echo '<li class="page-item"><a class="page-link" href="genre.php?page='.$page_num.'">' . $page_num . '</a></li>';
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
                                    echo '<li class="page-item active" aria-current="page"> <a class="page-link" href="genre.php?page='.$page_num.'">'.$page_num.'<span class="visually-hidden">(current)</span></a></li>';
                                }
                                else{
                                    echo '<li class="page-item"><a class="page-link" href="genre.php?page='.$page_num.'">' . $page_num . '</a></li>';
                                }
                            }
                        }
                    }
                ?>
                <li class="page-item">
                    <a class="page-link" href="genre.php?page=<?php if($page==$number_of_pages){echo $page;}else{echo ($page+1);} ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="genre.php?page=<?php echo $number_of_pages; ?>">Last</a>
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