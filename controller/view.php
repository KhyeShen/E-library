<?php  
session_start();
include('conn.php');

if(!empty($_GET['materialID']))
{
	$material_ID = basename($_GET['materialID']);
    $file = $material_ID.'.pdf';
	$filepath = '../material/file/' . $file;
    $filename = $_GET['title'].'.pdf';
	if(!empty($file) && file_exists($filepath)){
        header('location:../material/file/'.$material_ID.'.pdf');
	}
    else{
        $_SESSION['message'] = "Sorry, the file is corrupted.";
        header('location:../student/material_details.php?material_ID='.$material_ID);
    }
}