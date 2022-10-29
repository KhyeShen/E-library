<?php
    include('../controller/conn.php');

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $currentDT = date("Y-m-d h:i:s");
    // $sql = "INSERT INTO payment(student_ID,stripe_subscription_ID,amount,payment_datetime,status) VALUES
	// 				('SCPG1800369','sub_1LvY5UEYRt4577ibifZxWEHt',10,'".$currentDT."','Suceed')";
                    
    //                 $insert = $conn->query($sql); 
    $sql = "UPDATE subscription SET status='expired' WHERE student_ID='SCPG1800369'";
    $insert = $conn->query($sql); 
?>
