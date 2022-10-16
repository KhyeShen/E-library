<?php 
session_start();
// if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
// 	$_SESSION['message'] = 'Please Login!!';
// 	header('location:loginpage.php');
// 	exit();
// }
include('conn.php');
//query
$result = mysqli_query($conn,"select * from `material` order by download_times DESC LIMIT 5");
	
// Include configuration file  
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">

    <!-- material list -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>
<body style="background: #f1f7fc; padding-bottom:15px;">
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="glyphicon glyphicon-menu-hamburger"></i>
        </label>
        <label class="logo">SEGI College Penang E-library</label>
        <ul>
            <li><a class="active" href="index.php">Home</a><li>
            <li><a href="#">Home</a><li>
            <li><a href="logout.php">LOGOUT</a><li>
        </ul>
    </nav>
    <div style="background: #f1f7fc;">
        <div class="container" style="height: auto;">
            <form action="../controller/adduser.php" method="post">
                <div class="row">
                    <div class="col" style="height: 78px;">
                        <h1 style="font-size: 20px;margin-top: 12px;font-weight: bold;">UPLOAD NEW MATERIAL</h1>
                        <input class="form-control" type="text" name="material_name" placeholder="Material Name" required>
                    </div>
                </div>
                <div class="row" style="margin-top: 17px;">
                    <div class="col">
                        <input class="form-control" type="text" name="author" placeholder="Author" style="margin-top: 3px;" required>
                    </div>
                </div>
                <div class="row" style="margin-top: 17px;">
                    <div class="col">
                        <input class="form-control" type="number" name="pages" placeholder="Pages" style="margin-top: 3px;" required>
                    </div>
                </div>
                <div class="row" style="margin-top: 14px;">
                    <div class="col">
                        <select id="ddlYears" name="publish_year" >
                        <option selected disabled>-YEARS-</option>
                        <option value="Unknown">Unknown</option>
                        </select>
                    </div>
                    <div class="col">
                        <select id="type" name="Genre">
                            <option selected disabled>-GENRE-</option>
                            <option value="Horror">Horror</option>
                            <option value="Romance">Romance</option>
                            <option value="HQ Material">High Quality Material</option>
                        </select>
                    </div>
                    <div class="col text-end" style="padding-top: 11px;">
                        <button class="btn btn-primary" type="submit" name="createAcc" style="padding-top: 5px;margin-top: -12px;background: #ff655b;">UPLOAD</button>
                    </div>
                </div>
            </form>
                

                <!-- material list -->
                <div class="row" style="margin-top: 17px;background: #f1f7fc;">
                    <div class="col">
                        <div class="table-responsive">
                            <h3>Material List</h3>
                            <table id="material_list" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Material ID</th>
                                        <th>Material Title</th>
                                        <th>Author Name</th>
                                        <th>Publish Year</th>
                                        <th>Genre</th>
                                        <th>Pages</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $sql_material = "SELECT * FROM material ORDER BY material_ID ASC";

                                    $query_material = mysqli_query($conn, $sql_material);

                                    while ($material = mysqli_fetch_array($query_material)) {
                                        echo "
                                            <tr>
                                                <td>".$material['material_ID']."</td>
                                                <td>".$material['material_title']."</td>
                                                <td>".$material['author_name']."</td>
                                                <td>".$material['publish_year']."</td>
                                                <td>".$material['material_genre']."</td>
                                                <td>".$material['page_num']."</td>
                                            </tr>
                                        ";
                                    }
                                ?>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Material ID</th>
                                        <th>Material Title</th>
                                        <th>Author Name</th>
                                        <th>Publish Year</th>
                                        <th>Genre</th>
                                        <th>Pages</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <script>
        //material list
        let material_list = new DataTable('#material_list', {
            pageLength : 5,
            lengthMenu: [[5, 10, 20], [5, 10, 20]]
        });

        //drop down list of years selection
        window.onload = function () {
            //Reference the DropDownList.
            var ddlYears = document.getElementById("ddlYears");

            //Determine the Current Year.
            var currentYear = (new Date()).getFullYear();

            //Loop and add the Year values to DropDownList.
            for (var i = currentYear; i >= 1930 ; i--) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;
                ddlYears.appendChild(option);
            }
        };
    </script>
</body>
</html>