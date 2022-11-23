<?php  
session_start();

//DB connection
include('conn.php');

//Get the material details that wanted to view
if(!empty($_GET['materialID']))
{
	$material_ID = basename($_GET['materialID']);
    $file = $material_ID.'.pdf';
	$filepath = '../material/file/' . $file;
    $filename = $_GET['title'].'.pdf';

    //Check if student subscribed
    $student_sql = mysqli_query($conn,"SELECT * from `student` WHERE student_ID = '".$_SESSION['studentID']."'");
    $subscribed = mysqli_fetch_assoc($genre_sql); 
    $student_subscribed = $subscribed['subscription'];

    //Check if High Quality Material
    $genre_sql = mysqli_query($conn,"SELECT * from `material` WHERE material_ID = '".$material_ID."'");
    if (mysqli_num_rows($genre_sql) > 0) {
        $genre = mysqli_fetch_assoc($genre_sql); 
        if($genre['material_genre'] == "High Quality Material" && $_SESSION['student_subscribed'] == 0)
        {
            echo '<script type="text/javascript">'; 
            echo 'alert("Please subscribe premium plan to access High Quality Material.");'; 
            echo 'history.back();';
            echo '</script>';
        }
        else
        {
            if(!empty($file) && file_exists($filepath)){
                header('location:../material/file/'.$material_ID.'.pdf');
            }
            else{
                $_SESSION['message'] = "Sorry, the file is corrupted.";
                header('location:../student/material_details.php?material_ID='.$material_ID);
            }
        }
    }
    else
    {
        echo '<script type="text/javascript">'; 
        echo 'alert("Material not exist.");'; 
        echo 'history.back();';
        echo '</script>';
    }
}