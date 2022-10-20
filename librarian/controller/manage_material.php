<?php 
    session_start();
    include('../controller/conn.php');
    include_once __DIR__.'/../../vendor/az.multi.upload.class.php';
    
    if(isset($_POST['edit']))
    {
        $_SESSION["material_ID"] = $_POST['edit'];
        header('location: ../update_form.php');
    }

    if(isset($_POST['update']))
    {
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
            $sql = "UPDATE material SET 
                    material_title = '".$title."', 
                    author_name = '".$author."',
                    publish_year = '".$publish_year."',
                    material_genre = '".$genre."',
                    page_num = '".$page_num."',
                    cover_name = '".$cover_name."',
                    description = '".$description."'
                    WHERE material_ID = '".$material_ID."'
                    ";
                    echo '<script>alert("'.$material_ID.'")</script>'; 
                if (mysqli_query($conn, $sql))
                {
                    header('Location: ../upload_form.php');
                }
        }
    }

    if(isset($_POST['delete']))
    {
        $material_ID = $_POST['delete'];
        //echo '<script>alert("'.$material_ID.'")</script>';
        $sql = "DELETE FROM material WHERE material_ID=".$material_ID;

            if ($conn->query($sql) === TRUE)
            {
                header('Location: ../upload_form.php');
            }
    }
?>