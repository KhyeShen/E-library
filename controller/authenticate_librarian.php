<?php
    session_start();
    
    //DB connection
    include('../controller/conn.php');

    if(isset($_POST['password']))
    {
        //Variables
        $password 	= $_POST['password'];
        
        //Select admin's data
        $query = mysqli_query($conn,"select * from `librarian` where librarian_ID=".$_SESSION['librarian_ID']);
        
        //Verify if student exist
        if (mysqli_num_rows($query) != 0)
        {
            //Verify password
            $row = mysqli_fetch_array($query);
            $hashed_pass = $row['password'];
            
            if(password_verify($password, $hashed_pass)) 
            {
                $_SESSION['task'] = "librarian resetpwd";

                header("Location: ../librarian/resetpwd.php");
            }
            else 
            {
                echo '<script type="text/javascript">'; 
                echo 'alert("Incorrect Password!");'; 
                echo 'history.back();';
                echo '</script>';
            }	
        }
        else{
            echo '<script type="text/javascript">'; 
            echo 'alert("Admin does not exist!");'; 
            echo 'history.back();';
            echo '</script>';
        }
    }
?>