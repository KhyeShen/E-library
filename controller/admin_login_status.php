<?php
    //check if admin login
    if (!isset($_SESSION['admin_ID']) ||(trim ($_SESSION['admin_ID']) == '') || $_SESSION['loginstatus'] != 'active') {
        echo '<script type="text/javascript">'; 
        echo 'alert("Please Login Your Account");'; 
        echo 'window.location.href = "../administrator/index.php";';
        echo '</script>';
        exit();
    }
?>