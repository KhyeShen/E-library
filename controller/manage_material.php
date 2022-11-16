<?php 
    session_start();

    //DB connection
    include('conn.php');
    //Upload file PHP
    include('../vendor/az.multi.upload.class.php');
    
    //Direct to update form
    if(isset($_POST['edit']))
    {
        $_SESSION["material_ID"] = $_POST['edit'];
        header('location: ../librarian/update_form.php');
    }

    //Update material
    if(isset($_POST['update']))
    {
        //Validate material file
        if(!empty(array_filter($_FILES['files']['name'])))
        {
            $title = $_POST['material_title'];
            $author = $_POST['author'];
            $publish_year = $_POST['publish_year'];
            $genre = $_POST['genre'];
            $page_num = $_POST['pages'];
            $description = $_POST['description'];
            $covername = implode($_FILES['cover']['name']);
            $extension = pathinfo($covername, PATHINFO_EXTENSION);
            $cover_name = "";
            $material_ID = $_POST['update'];

            //Current Date Time
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $currentDT = date("Y-m-d h:i:s");
            
            //Validate cover page
            if(!empty(array_filter($_FILES['cover']['name'])))
            {
                $cover_name = $material_ID.'.'.$extension;
                $uploadcover =   new ImageUploadAndResize();
                $uploadcover->uploadMultiFiles('cover', '../material/cover', $material_ID, 0755);
            }else{
                $cover_name = "N/A";
            }
                
            //Update material file
            $uploadfile =   new ImageUploadAndResize();
            $uploadfile->uploadMultiFiles('files', '../material/file', $material_ID, 0756);

            //Update material details
            $sql = "UPDATE material SET 
                    material_title = '".$title."', 
                    author_name = '".$author."',
                    publish_year = '".$publish_year."',
                    material_genre = '".$genre."',
                    page_num = '".$page_num."',
                    cover_name = '".$cover_name."',
                    description = '".$description."',
                    updated_datetime = '".$currentDT."'
                    WHERE material_ID = '".$material_ID."'
                    ";

            if (!mysqli_query($conn, $sql))
            {
                echo '<script>alert("not update")</script>'; 
                header('Location: ../librarian/upload_form.php');
            }
            else if (mysqli_query($conn, $sql))
            {
                echo '<script>alert("update")</script>'; 
                header('Location: ../librarian/upload_form.php');
            }
        }
    }

    //Delete material
    if(isset($_POST['delete']))
    {
        //Delete Cover Image & Material File
        $material_ID = $_POST['delete'];
        $sql = "SELECT * FROM material WHERE material_ID=".$material_ID;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $filepath = "../material/file/".$row['material_ID'].".pdf";
        $coverpath = "../material/cover/".$row['cover_name'];
        if(!unlink($filepath) || !unlink($coverpath))
        {
            echo "Delete Fail!";
        }
        else
        {
            echo "Deleted";
        }

        $sql = "DELETE FROM material WHERE material_ID=".$material_ID;

        if ($conn->query($sql) === TRUE)
        {
            header('Location: ../librarian/upload_form.php');
        }
    }
?>