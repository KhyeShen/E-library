<?php 
    session_start();

    //DB connection
    include('conn.php');
    
    //Direct to update form
    if(isset($_POST['edit']))
    {
        $_SESSION["material_ID"] = $_POST['edit'];
        header('location: ../librarian/update_form.php');
    }

    //Upload button
    if(isset($_POST['add']))
    {
        $librarian_name = $_POST['librarian_name'];
        $librarian_email = $_POST['librarian_email'];
        $password = $_POST['password'];

        //Current Date Time
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $currentDT = date("Y-m-d h:i:s");

        //Determine the material ID for the material
        $result = mysqli_query($conn,"select * from `librarian` where email = '$librarian_email'");
        if (mysqli_num_rows($result) > 0) {
            echo '<script type="text/javascript">'; 
			echo 'alert("The Email Address Has Been Used!");'; 
			echo 'window.location.href = "../administrator/manage_librarian.php";';
			echo '</script>';
        }
        else 
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            //Upload material file
            $sql = "INSERT INTO librarian (librarian_name,admin_ID,email,password,created_datetime,updated_datetime) 
            VALUES ('".$librarian_name."', 1, '".$librarian_email."', '".$hash."', '".$currentDT."', '".$currentDT."')";

            //Check if upload successfull
            if (mysqli_query($conn, $sql)) {
                header('Location: ../administrator/manage_librarian.php');
            }
            else if (!mysqli_query($conn, $sql)){
                echo '<script type="text/javascript">'; 
                echo 'alert("Fail to Add Librarian!");'; 
                echo 'window.location.href = "../administrator/manage_librarian.php";';
                echo '</script>';
            }
        }
    }

    //Update material
    if(isset($_POST['update']))
    {
        $librarian_ID = $_POST['update'];
        $librarian_name = $_POST['librarian_name'];
        $librarian_email = $_POST['librarian_email'];
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);

        //Current Date Time
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $currentDT = date("Y-m-d h:i:s");

        //Update material details
        $sql = "UPDATE librarian SET 
                librarian_name = '".$librarian_name."', 
                email = '".$librarian_email."',
                password = '".$hash."',
                updated_datetime = '".$currentDT."'
                WHERE librarian_ID = '".$librarian_ID."'
                ";

        if (mysqli_query($conn, $sql))
        {
            header('Location: ../administrator/manage_librarian.php');
        }
        else if (!mysqli_query($conn, $sql)){
            echo '<script type="text/javascript">'; 
            echo 'alert("Update Fail!");'; 
            echo 'window.location.href = "../administrator/manage_librarian.php";';
            echo '</script>';
        }
    }

    //Delete material
    if(isset($_POST['delete']))
    {
        //Delete Cover Image & Material File
        $librarian_ID = $_POST['delete'];
        $sql = "SELECT * FROM librarian WHERE librarian_ID=".$librarian_ID;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql = "DELETE FROM librarian WHERE librarian_ID=".$librarian_ID;

        if (mysqli_query($conn, $sql))
        {
            header('Location: ../administrator/manage_librarian.php');
        }
        else if (!mysqli_query($conn, $sql)){
            echo '<script type="text/javascript">'; 
            echo 'alert("Delete Fail!");'; 
            echo 'window.location.href = "../administrator/manage_librarian.php";';
            echo '</script>';
        }
    }
?>