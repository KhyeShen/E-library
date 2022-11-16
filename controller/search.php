<?php 
//Direct to search result page
if (isset($_POST['search']) || $_POST['search'] != "") {
    header('location:../student/search_result.php?search_value='.$_POST['search']);
}else{
    header('location:../student/home.php');
}
?>