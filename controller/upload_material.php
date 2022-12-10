<?php 
    session_start();

    //DB connection
    include('conn.php');
    //Upload file PHP
    include('../vendor/az.multi.upload.class.php');
    
    //Upload button
    if(isset($_POST['btn']))
    {
        //Validate material file
        if(!empty(array_filter($_FILES['files']['name'])))
        {
            $flag   =   0;
            $title = str_replace("'", "\'",$_POST['material_title']);
            $author = str_replace("'", "\'",$_POST['author']);
            $publish_year = $_POST['publish_year'];
            $genre = $_POST['genre'];
            $page_num = $_POST['pages'];
            $description = str_replace("'", "\'",$_POST['description']);
            $covername = implode($_FILES['cover']['name']);
            $extension = pathinfo($covername, PATHINFO_EXTENSION);
            $cover_name = "";
            $material_ID = 1;
            $flag   =   1;

            //Current Date Time
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $currentDT = date("Y-m-d h:i:s");

            
            $sql = "INSERT INTO material (librarian_ID, material_title,author_name,publish_year,material_genre,page_num,description,created_datetime,updated_datetime) 
            VALUES (".$_SESSION['librarian_ID'].", '".$title."', '".$author."', '".$publish_year."', '".$genre."', '".$page_num."', '".$description."', '".$currentDT."', '".$currentDT."')";

            //Check if upload successfull
            if ($conn->query($sql) === TRUE) {
                //Determine the material ID for the material
                $result = mysqli_query($conn,"select * from `material` order by material_ID desc LIMIT 1");
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $material_ID = $row['material_ID'];
                }

                
                //Validate the cover page
                if(!empty(array_filter($_FILES['cover']['name'])))
                {
                    //Upload cover page
                    $cover_name = $material_ID.'.'.$extension;
                    
                    $uploadcover =   new ImageUploadAndResize();
                    $uploadcover->uploadMultiFiles('cover', '../material/cover', $material_ID, 0755);
                }
                else{
                    $cover_name = "N/A";
                }
                    
                $cover_name_sql = "UPDATE material SET cover_name='".$cover_name."' WHERE material_ID='".$material_ID."'";
                if (mysqli_query($conn, $cover_name_sql)) {
                    echo "Record updated successfully";
                    }

                //Upload material file
                $uploadfile =   new ImageUploadAndResize();
                $uploadfile->uploadMultiFiles('files', '../material/file', $material_ID, 0756);
                header('Location: ../librarian/upload_form.php');
            }
            else{
                echo '<script>alert("Upload Failure")</script>';
            }
        }
        else{
            echo '<script>alert("File Corrupted")</script>';
        }
    }
?>