<?php  
session_start();

//DB connection
include('conn.php');

//Get the material file details that wanted to download
if(!empty($_GET['materialID']) && !$_GET['librarian'])
{
    $currentDT = date("Y-m-d h:i:s");
	$material_ID = basename($_GET['materialID']);
    $file = $material_ID.'.pdf';
	$filepath = '../material/file/' . $file;
    $filename = $_GET['title'].'.pdf';

    //Check if High Quality Material
    $genre_sql = mysqli_query($conn,"SELECT * from `material` WHERE material_ID = '".$material_ID."'");
    if (mysqli_num_rows($genre_sql) > 0) {
        $genre = mysqli_fetch_assoc($genre_sql); 
        if($genre['material_genre'] == "High Quality Material" && $_SESSION['student_subscribed'] == 0)
        {
            echo '<script type="text/javascript">'; 
            echo 'alert("Please subscribe premium plan to download High Quality Material.");'; 
            echo 'window.location.href = "../student/index.php";';
            echo '</script>';
        }
    }

	if(!empty($file) && file_exists($filepath)){

        //Define Headers
		header("Cache-Control: public");
		header("Content-Description: FIle Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/zip");
		header("Content-Transfer-Emcoding: binary");

        //Download material file
		$download = readfile($filepath);
        if($download == true)
        {
            $query = "INSERT INTO download (student_ID, material_ID, datetime) 
		    VALUES ('".$_SESSION['studentID']."', ".$material_ID.", '".$currentDT."')";
            if (mysqli_query($conn, $query)) {
                echo "Download Complete!";
              } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
              }
        }
	}
    else{
        $_SESSION['message'] = "Sorry, the file is corrupted.";
        header('location:../student/material_details.php?material_ID='.$material_ID);
    }
}

//Get the material file details that wanted to download
if(!empty($_GET['materialID']) && $_GET['librarian'])
{
    $currentDT = date("Y-m-d h:i:s");
	$material_ID = basename($_GET['materialID']);
    $file = $material_ID.'.pdf';
	$filepath = '../material/file/' . $file;
    $filename = $_GET['title'].'.pdf';
	if(!empty($file) && file_exists($filepath)){

        //Define Headers
		header("Cache-Control: public");
		header("Content-Description: FIle Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/zip");
		header("Content-Transfer-Emcoding: binary");

        //Download material file
		$download = readfile($filepath);
        if($download != true)
        {
            echo '<script type="text/javascript">'; 
			echo 'alert("Sorry, the file is corrupted.!");'; 
			echo 'history.back();';
			echo '</script>';
        }
	}
    else{
        echo '<script type="text/javascript">'; 
        echo 'alert("Sorry, the file is corrupted.!");'; 
        echo 'history.back();';
        echo '</script>';
    }
}