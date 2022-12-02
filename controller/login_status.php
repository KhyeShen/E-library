<?php
    //check if user login
    if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
        echo '<script type="text/javascript">'; 
        echo 'alert("Please Login Your Account");'; 
        echo 'window.location.href = "../student/index.php";';
        echo '</script>';
        exit();
    }
?>