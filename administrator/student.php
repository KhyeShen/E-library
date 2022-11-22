<?php 
session_start();
// if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
// 	$_SESSION['message'] = 'Please Login!!';
// 	header('location:loginpage.php');
// 	exit();
// }
include('../controller/conn.php');
	
// Include configuration file  
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Local CSS -->
    <link rel="stylesheet" href="../src/css/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
            
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
            <h1 style="font-size: 20px;margin-top: 12px;font-weight: bold;">Student Account Management</h1>
            <!-- student account list -->
        <div class="row" style="margin-top: 10px;background: #f1f7fc; margin:20px 0;">
            <div class="col">
                <div class="table-responsive">
                    <table id="student_acc" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Email Address</th>
                                <th>Course Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql_material = "SELECT * FROM student ORDER BY student_ID ASC";

                            $query_material = mysqli_query($conn, $sql_material);

                            while ($material = mysqli_fetch_array($query_material)) {
                                if($material['gender']=1)
                                { $gender = "Male"; }
                                else
                                { $gender = "Female"; }

                                
                                echo "
                                    <tr>
                                        <td>".$material['student_ID']."</td>
                                        <td>".$material['student_name']."</td>
                                        <td>".$material['email']."</td>
                                        <td>".$material['course_name']."</td>
                                        <td>".$gender."</td>
                                        <td>".$material['age']."</td>
                                        <td>".$material['status']."</td>
                                        <td>
                                        <form action='../controller/manage_material.php' method='post' style='width: 80px;'>";
                                        if($material['status']=="Frozen")
                                        { 
                                            echo  "<button type='submit' onclick='remove_librarian()' class='btn btn-default fas fa-check' name='delete' value='' style='background-color:#00ff00;'></button>
                                            </form>
                                            </td>
                                            </tr>
                                            ";
                                        }
                                        else if($material['status']=="Active")
                                        { 
                                            echo "<button type='submit' onclick='remove_librarian()' class='btn btn-default fas fa-ban' name='delete' value='' style='background-color:red;'></button>
                                            </form>
                                            </td>
                                            </tr>
                                            ";
                                        }
                                        
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
function myFunction() {
  let text;
  if (confirm("Press a button!") == true) {
    window.location.href = 'update_form.php';
  } else {
    window.location.href = 'upload_form.php';
  }
  document.getElementById("demo").innerHTML = text;
}
        //material list
        let student_acc = new DataTable('#student_acc', {
            pageLength : 5,
            lengthMenu: [[5, 10, 20], [5, 10, 20]]
        });

        let student_list = new DataTable('#student_list', {
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
    <script src="../controller/cover_preview.js"></script>
</body>
</html>