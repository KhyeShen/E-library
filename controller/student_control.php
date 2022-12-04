<?php 
    session_start();

    //DB connection
    include('conn.php');

    //Activate button
    if(isset($_POST['activate']))
    {
        $student_ID = $_POST['activate'];

        //Current Date Time
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $currentDT = date("Y-m-d h:i:s");

        //Update student details
        $sql = "UPDATE student SET 
                student_ID = '".$student_ID."', 
                status = 'Active',
                updated_datetime = '".$currentDT."'
                WHERE student_ID = '".$student_ID."'
                ";

        if (mysqli_query($conn, $sql))
        {
            header('Location: ../administrator/manage_student.php');
        }
        else if (!mysqli_query($conn, $sql)){
            echo '<script type="text/javascript">'; 
            echo 'alert("Activate Fail!");'; 
            echo 'window.location.href = "../administrator/manage_student.php";';
            echo '</script>';
        }
    }

    //Freeze button
    if(isset($_POST['freeze']))
    {
        $student_ID = $_POST['freeze'];

        //Current Date Time
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $currentDT = date("Y-m-d h:i:s");

        //Update student details
        $sql = "UPDATE student SET 
                student_ID = '".$student_ID."', 
                status = 'Frozen',
                updated_datetime = '".$currentDT."'
                WHERE student_ID = '".$student_ID."'
                ";

        if (mysqli_query($conn, $sql))
        {
            header('Location: ../administrator/manage_student.php');
        }
        else if (!mysqli_query($conn, $sql)){
            echo '<script type="text/javascript">'; 
            echo 'alert("Freeze Fail!");'; 
            echo 'window.location.href = "../administrator/manage_student.php";';
            echo '</script>';
        }
    }
?>