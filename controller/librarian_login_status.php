<?php
    //check if admin login
    if (!isset($_SESSION['librarian_ID']) ||(trim ($_SESSION['librarian_ID']) == '') || $_SESSION['loginstatus'] != 'active') {
        echo '<script type="text/javascript">'; 
        echo 'alert("Please Login Your Account");'; 
        echo 'window.location.href = "../librarian/index.php";';
        echo '</script>';
        exit();
    }
?>