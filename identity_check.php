<?php
    //Check if student login
    if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
        $_SESSION['message'] = 'Please Login!!';
        $_SESSION['page'] = 'home.php';
        header('location:index.php');
        exit();
    }
?>