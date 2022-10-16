<?php session_start();
    $conn = mysqli_connect("localhost", "root", "","elibrary");
    include_once __DIR__.'/../../vendor/az.multi.upload.class.php';
    
    if(isset($_POST['btn']))
    {
        if(!empty(array_filter($_FILES['files']['name'])))
        {
            $flag   =   0;
            $title = $_POST['material_title'];
            $author = $_POST['author'];
            $publish_year = $_POST['publish_year'];
            $genre = $_POST['genre'];
            $page_num = $_POST['pages'];
            $description = $_POST['description'];
            $covername = implode($_FILES['cover']['name']);
            $extension = pathinfo($covername, PATHINFO_EXTENSION);
            $cover_name = "";
            $material_ID = 1;
            
            $flag   =   1;

            $result = mysqli_query($conn,"select * from `material` order by material_ID desc LIMIT 1");
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $material_ID = $row['material_ID'];
                $material_ID++;
            }

            if(!empty(array_filter($_FILES['cover']['name'])))
            {
                $cover_name = $material_ID.'.'.$extension;
                $uploadcover =   new ImageUploadAndResize();
                $uploadcover->uploadMultiFiles('cover', '../../material/cover', $material_ID, 0755);
            }else{
                $cover_name = "N/A";
            }
                
            $uploadfile =   new ImageUploadAndResize();
            $uploadfile->uploadMultiFiles('files', '../../material/file', $material_ID, 0756);
            $sql = "INSERT INTO material (librarian_ID, material_title,author_name,publish_year,material_genre,page_num,cover_name,description,created_datetime,updated_datetime) 
            VALUES (4, '".$title."', '".$author."', '".$publish_year."', '".$genre."', '".$page_num."', '".$cover_name."', '".$description."', now(), now())";

            if ($conn->query($sql) === TRUE) {
                header('Location: ../upload_form.php');
            }else{
                echo '<script>alert("Update Failure")</script>';
            }
        }
        else{
            echo '<script>alert("File Corrupted")</script>';
        }
    }
?>