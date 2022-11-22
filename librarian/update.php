<?php 
// if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
// 	$_SESSION['message'] = 'Please Login!!';
// 	header('location:loginpage.php');
// 	exit();
// }

//DB connection
include('../controller/conn.php');

//Get material's data
if(isset($_GET['material_ID'])){
    $material_ID = $_GET['material_ID'];
    $update = mysqli_query($conn,"select * from `material` where material_ID=".$material_ID);
    while ($update_item = mysqli_fetch_array($update)) {
        $current_cover = $update_item['cover_name'];
        $current_title = $update_item['material_title'];
        $current_author = $update_item['author_name'];
        $current_pages = $update_item['page_num'];
        $current_py = $update_item['publish_year'];
        $current_genre = $update_item['material_genre'];
        $description = $update_item['description'];
    };
}
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
    <div class="container" style="height: auto;">
        <div class="row">
            <div class="text-center" style="margin-bottom:20px;">
                    <b style="font-size: 28px;" >UPDATE MATERIAL FORM</b>
            </div>
        </div>
        <!-- Material Input Form -->
        <div class="row">
            <form action="../controller/manage_material.php?material_ID=161" method="post" enctype="multipart/form-data">
                <!-- Cover Photo -->
                <div class="col-md-3" style="margin-bottom:10px;">
                        <label for="coverImage">Choose Cover Image</label><br>
                        <img src="../src/image/placeholder.jpg" onclick="triggerClick()" id="coverDisplay" style="cursor: pointer;height:340px;width:228px;">
                        <input type="file" name="cover[]" accept=".jpg, .jpeg, .png" onchange="displayImage(this)" id="coverImage" style="display: none;">
                </div>
                <!-- Material File & Details -->
                <div class="col-md-9" style="padding:0 30px;">
                    <div class="row" style="margin-bottom:10px;">
                        <label for="file">Material File (Only PDF Supported)</label><br>
                        <input type="file" required name="files[]" accept=".pdf" class="form-control" id="file" placeholder="Material File" required/>
                    </div>
                    
                    <div class="row" style="margin-bottom:10px;">
                        <b>Material Name</b>
                        <input class="form-control" type="text" name="material_title" placeholder="Material Name" style="margin-top: 3px;" value="<?php echo $current_title ?>" required>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <b>Author Name</b>
                        <input class="form-control" type="text" name="author" placeholder="Author Name" style="margin-top: 3px;" value="<?php echo $current_author ?>" required>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <b>Page Number</b>
                        <input class="form-control" type="number" name="pages" placeholder="Page Number" style="margin-top: 3px;" value="<?php echo $current_pages ?>" required>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <b>Description</b>
                        <input class="form-control" type="text" name="description" placeholder="Description" style="margin-top: 3px;" value="<?php echo $description ?>" required>
                    </div>
                    <div class="row">
                        <select id="ddlYears" name="publish_year" class="btn btn-secondary dropdown-toggle" style="border:1px solid grey;width:26%;" required>
                        <option value="">-YEARS-</option>
                        <option value="Unknown">Unknown</option>
                        </select>
                        <select id="type" name="genre" class="btn btn-secondary dropdown-toggle" style="border:1px solid grey;width:26%;" required>
                            <option value="">-GENRE-</option>
                            <option value="Horror">Horror</option>
                            <option value="Romance">Romance</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Historical">Historical</option>
                            <option value="High Quality Material">High Quality Material</option>
                        </select>
                        <button class="btn btn-primary" onclick="window.location.href='upload_form.php';" style="padding-top: 5px;background: #a31f37;float:right; margin-left:3px;">BACK</button>
                        <button class="btn btn-primary" type="submit" name="update" value="<?php echo $material_ID; ?>" style="padding-top: 5px;background: #1aff1a;float:right;">UPDATE</button>
                        
                    </div>
                </div>
            </form>
        </div>
        <hr>

        <!-- material list -->
        <div class="row" style="margin-top: 17px;background: #f1f7fc; margin:20px 0; padding:5px 5px;"">
            <div class="col">
                <div class="table-responsive">
                    <h3>Material List</h3>
                    <table id="material_list" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Material ID</th>
                                <th>Material Title</th>
                                <th>Author Name</th>
                                <th>Publish Year</th>
                                <th>Genre</th>
                                <th>Pages</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql_material = "SELECT * FROM material ORDER BY material_ID DESC";

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
                                        <td><a style='cursor:pointer;'>".$material['material_ID'].".pdf</a></td>
                                        <td>
                                        <form action='../controller/manage_material.php' method='post'>
                                            <a class='btn btn-default fas fa-edit' href='update_form.php?material_ID='".$material['material_ID']."'></a>
                                            <button type='submit' onclick='delete_material()' class='btn btn-default fas fa-trash-alt' name='delete' value=''".$material['material_ID']."></button>
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
            for (var i = currentYear; i >= 1600 ; i--) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;
                ddlYears.appendChild(option);
            }
        };

        //prompt confirmation box to delete material
        function delete_material(){
            var delete_material = confirm('Are you sure you want to delete this material?');
            if(delete_material == false){
            event.preventDefault();
            }
        }
    </script>
    <!-- Cover Image Preview JS -->
    <script src="../src/js/cover_preview.js"></script>
</body>
</html>