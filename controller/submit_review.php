<?php

//submit_rating.php
// session_start();
//$connect = new PDO("mysql:host=my;dbname=bscfypwb_E-library", "bscfypwb_khyeshen", "G^MPB##NaAf7");
// $connect = new PDO("mysql:host=localhost;dbname=elibrary", "root", "");
include('conn.php');
if(isset($_POST["rating_data"]))
{
	$currentDT = date("Y-m-d h:i:s");
	$data = array(
		':student_ID'		=>	$_POST['student_ID'],
		':material_ID'		=>	$_POST["material_ID"],
		':score'			=>	$_POST["rating_data"],
		':comment'			=>	$_POST["user_reviews"],
		':datetime'			=>	$currentDT
	);
	
	$review = mysqli_query($conn,"select * from review WHERE material_ID=".$_POST['material_ID']." AND student_ID='".$_POST['student_ID']."'");
	if (mysqli_num_rows($review) != 0)
	{
		$row = mysqli_fetch_array($review);
		$review_ID = $row['review_ID'];

		$sql = "UPDATE review SET score=".$_POST["rating_data"].", comment='".$_POST["user_reviews"]."' WHERE review_ID=".$review_ID;
		if ($conn->query($sql) === TRUE) {
			echo "Review updated successfully!";
		}
	}
	else{
		$query = "INSERT INTO review (student_ID, material_ID, score, comment, created_datetime, updated_datetime) 
		VALUES ('".$_POST['student_ID']."', ".$_POST['material_ID'].", ".$_POST['rating_data'].", '".$_POST['user_reviews']."', '".$currentDT."', '".$currentDT."')";

	// $statement = $connect->prepare($query);

	// $statement->execute($data);
	if (mysqli_query($conn, $query)) {
		echo "Thanks for your review!";
	  } else {
		echo "Error: " . $query . "<br>" . mysqli_error($conn);
	  }
	}
	

}

if(isset($_POST["action"]))
{
	$user_rating = 0;
	$average_rating = 0;
	$download_times = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	
	$query1 = "
	SELECT * FROM review 
 	WHERE material_ID = ".$_POST['material_ID']." AND student_ID = '".$_POST['student_ID']."'";
	$result = mysqli_query($conn, $query1);

	if (mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);

		$review_content[] = array(
			'student_ID'	=>	$row["student_ID"],
			'rating'			=>	$row["score"],
			'user_review'		=>	$row["comment"],
			'datetime'		=>	$row["updated_datetime"]
		);
		$user_rating = $row["score"];
		if($row["score"] == '5')
			{
				$five_star_review++;
			}

			if($row["score"] == '4')
			{
				$four_star_review++;
			}

			if($row["score"] == '3')
			{
				$three_star_review++;
			}

			if($row["score"] == '2')
			{
				$two_star_review++;
			}

			if($row["score"] == '1')
			{
				$one_star_review++;
			}

			$total_review++;

			$total_user_rating = $total_user_rating + $row["score"];
	}

	$query = "SELECT * FROM review 	WHERE material_ID = '".$_POST['material_ID']."' AND student_ID != '".$_POST['student_ID']."' ORDER BY review_id DESC";
	
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$review_content[] = array(
				'student_ID'	=>	$row["student_ID"],
				'rating'			=>	$row["score"],
				'user_review'		=>	$row["comment"],
				'datetime'		=>	$row["updated_datetime"]
			);

			if($row["score"] == '5')
			{
				$five_star_review++;
			}

			if($row["score"] == '4')
			{
				$four_star_review++;
			}

			if($row["score"] == '3')
			{
				$three_star_review++;
			}

			if($row["score"] == '2')
			{
				$two_star_review++;
			}

			if($row["score"] == '1')
			{
				$one_star_review++;
			}

			$total_review++;

			$total_user_rating = $total_user_rating + $row["score"];
		}
	}

	if($total_user_rating > 0)
	{
		$average_rating = $total_user_rating / $total_review;
	}
	

	$query_download = "SELECT * FROM download WHERE material_ID = '".$_POST['material_ID']."'";
	$download = mysqli_query($conn, $query_download);
	$download_times = mysqli_num_rows($download);

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'download_times'	=>	$download_times,
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content,
		'user_rating'		=>	$user_rating
	);

	echo json_encode($output);

}
?>