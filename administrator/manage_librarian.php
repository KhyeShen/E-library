<?php 
session_start();
// if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
// 	$_SESSION['message'] = 'Please Login!!';
// 	header('location:loginpage.php');
// 	exit();
// }

//DB connection
include('../controller/conn.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- datatables -->
    <link rel="stylesheet" href="../src/css/jquery.dataTables.css">
    <script src="../src/js/jquery-3.5.1.js"></script>
    <script src="../src/js/jquery.dataTables.js"></script>  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <!-- Local CSS -->
    <link rel="stylesheet" href="../src/css/styles.css">
</head>
<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="glyphicon glyphicon-menu-hamburger"></i>
        </label>
        <label class="logo">SCPG E-library</label>
        <ul>
            <li><a class="active" href="index.php">Home</a><li>
            <li><a href="#">Home</a><li>
            <li><a href="logout.php">LOGOUT</a><li>
        </ul>
    </nav>
    <div>
        <div class="container" style="height: auto;">
            <h1 style="font-size: 20px;margin-top: 12px;font-weight: bold;">Librarian Account Management</h1>
            <form action="../controller/upload_material.php" method="post" enctype="multipart/form-data">
                <div class="" style="margin-top: 17px;">
                    <b>Librarian Name</b>
                    <div class="col">
                        <input class="form-control" type="text" name="material_title" placeholder="Librarian ID" style="margin-top: 3px;" required>
                    </div>
                </div>
                <div class="" style="margin-top: 17px;">
                    <b>Email Address</b>
                    <div class="col">
                        <input class="form-control" type="text" name="author" placeholder="Librarian Email" style="margin-top: 3px;" required>
                    </div>
                </div>
                <div class="" style="margin-top: 17px;">
                    <b>Password</b>
                    <div class="col">
                        <input class="form-control" type="text" name="author" placeholder="Librarian Email" style="margin-top: 3px;" required>
                    </div>
                </div>
                <div class="" style="margin-top: 14px; text-align:right;">
                    <div class="col text-end" style="padding-top: 11px;">
                        <button class="btn btn-primary" type="submit" name="btn" style="padding-top: 5px;margin-top: -12px;background: #a31f37;">ADD</button>
                    </div>
                </div>
            </form>
                
            <hr>

            <!-- librarian list -->
            <div class="row" style="margin-top: 10px;background: #f1f7fc; margin:20px 0; padding:5px 5px;">
                <div class="col">
                    <div class="table-responsive">
                        <h3 style="margin-top:0;">Librarian List</h3>
                        <table id="librarian_list" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Librarian ID</th>
                                    <th>Librarian Name</th>
                                    <th>Email Address</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql_material = "SELECT * FROM librarian ORDER BY librarian_ID ASC";

                                    $query_material = mysqli_query($conn, $sql_material);

                                    while ($material = mysqli_fetch_array($query_material)) {
                                        echo "
                                            <tr>
                                                <td>".$material['librarian_ID']."</td>
                                                <td>".$material['librarian_name']."</td>
                                                <td>".$material['email']."</td>
                                                <td>".$material['password']."</td>
                                                <td>
                                                <form action='../controller/manage_material.php' method='post'>
                                                    <a class='btn btn-default fas fa-edit' href='update_form.php?material_ID='></a>
                                                    <button type='submit'  class='btn btn-default fas fa-trash-alt' name='delete' value=''></button>
                                                </form>
                                                </td>
                                            </tr>
                                        ";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //librarian list
        let student_list = new DataTable('#librarian_list', {
            pageLength : 5,
            lengthMenu: [[5, 10, 20], [5, 10, 20]]
        });
    </script>
    <script src="../src/js/cover_preview.js"></script>
</body>
</html>