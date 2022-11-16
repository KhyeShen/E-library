<?php
    session_start();

    //DB connection
    include('conn.php');

    //Variables
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $currentDT = date("Y-m-d h:i:s");
    $subscription_ID = "";
    $amount = 0;

    //renew subscription 
    $sql_subscription = "SELECT * FROM subscription";
    $query_subscription = mysqli_query($conn, $sql_subscription);
    while ($subscription = mysqli_fetch_array($query_subscription)) {
        if($subscription['plan_end'] <= $currentDT)
        {
            $newexpiry = date('Y-m-d', strtotime( $subscription['plan_end'] . " +1 month"));
            $subscription_ID = $subscription['stripe_subscription_ID'];
            $amount = $subscription['monthly_price'];
            $new = "INSERT INTO payment(student_ID,stripe_subscription_ID,amount,payment_datetime,status) VALUES
	 				('".$_SESSION['studentID']."','".$subscription_ID."','".$amount."','".$currentDT."','Suceed')";
            $insert = $conn->query($new); 
            $update = "UPDATE subscription SET status='active',plan_end='".$newexpiry."' WHERE stripe_subscription_ID='".$subscription_ID."'";
            $insert = $conn->query($update); 
        }
    }
?>
