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
        $subscription_ID = $subscription['stripe_subscription_ID'];
        $student_ID = $subscription['student_ID'];

        //Check if the subscription need to updated
        if($subscription['plan_end'] <= $currentDT)
        {
            if($subscription['status'] == "last")
            {
                $update = "UPDATE subscription SET status='expired', updated_datetime='".$currentDT."' WHERE stripe_subscription_ID='".$subscription_ID."'";
                $update_student = "UPDATE student SET subscription='None', updated_datetime='".$currentDT."' WHERE student_ID = '".$student_ID."'";
                mysqli_query($conn,$update);
                mysqli_query($conn,$update_student);
            }
            else if($subscription['status'] == "active")
            {
                $newexpiry = date('Y-m-d', strtotime( $subscription['plan_end'] . " +1 month"));
                $amount = $subscription['monthly_price'];
                $new = "INSERT INTO payment(student_ID,stripe_subscription_ID,amount,payment_datetime,status) VALUES
                        ('".$student_ID."','".$subscription_ID."','".$amount."','".$currentDT."','Suceed')";
                mysqli_query($conn,$new);
                $update = "UPDATE subscription SET status='active',plan_end='".$newexpiry."', updated_datetime='$currentDT' WHERE stripe_subscription_ID='".$subscription_ID."'";
                $update_student = "UPDATE student set subscription='Premium', updated_datetime='$currentDT' WHERE student_ID = '".$student_ID."'";
                mysqli_query($conn,$update);
                mysqli_query($conn,$update_student);
            }
        }
    }
?>
