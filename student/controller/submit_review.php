<?php

//submit_rating.php
session_start();
$connect = new PDO("mysql:host=my;dbname=bscfypwb_E-library", "bscfypwb_khyeshen", "G^MPB##NaAf7");

if(isset($_POST["rating_data"]))
{
	$currentDT = date("Y-m-d h:i:s");
	$data = array(
		':student_ID'		=>	$_SESSION['studentID'],
		':material_ID'		=>	$_POST["material_ID"],
		':score'			=>	$_POST["rating_data"],
		':comment'			=>	$_POST["user_reviews"],
		':datetime'			=>	$currentDT
	);

	$query = "
	INSERT INTO review
	(student_ID, material_ID, score, comment, created_datetime, updated_datetime) 
	VALUES (:student_ID, :material_ID, :score, :comment, :datetime, :datetime)
	";

	$statement = $connect->prepare($query);

	$statement->execute($data);

	echo "Your Review & Rating Successfully Submitted";

}

if(isset($_POST["action"]))
{
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	$query = "
	SELECT * FROM review 
	WHERE material_ID = '".$_POST['material_ID']."' ORDER BY review_id DESC
	";

	$result = $connect->query($query, PDO::FETCH_ASSOC);

	foreach($result as $row)
	{
		$review_content[] = array(
			'student_ID'	=>	$row["student_ID"],
			'material_ID'	=>	$row["material_ID"],
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

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}

?>