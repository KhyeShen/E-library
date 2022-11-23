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
            if($subscription['status'] == "last")
            {
                $update = "UPDATE subscription SET status='expired' WHERE stripe_subscription_ID='".$subscription_ID."'";
                $update_student = "UPDATE student set subscription=0, updated_datetime='$currentDT' WHERE student_ID = '".$_SESSION['studentID']."'";
                mysqli_query($conn,$update);
                mysqli_query($conn,$update_student);
            }
            else if($subscription['status'] == "active")
            {
                $newexpiry = date('Y-m-d', strtotime( $subscription['plan_end'] . " +1 month"));
                $subscription_ID = $subscription['stripe_subscription_ID'];
                $amount = $subscription['monthly_price'];
                $new = "INSERT INTO payment(student_ID,stripe_subscription_ID,amount,payment_datetime,status) VALUES
                        ('".$_SESSION['studentID']."','".$subscription_ID."','".$amount."','".$currentDT."','Suceed')";
                $insert = $conn->query($new); 
                $update = "UPDATE subscription SET status='active',plan_end='".$newexpiry."' WHERE stripe_subscription_ID='".$subscription_ID."'";
                $update_student = "UPDATE student set subscription=1, updated_datetime='$currentDT' WHERE student_ID = '".$_SESSION['studentID']."'";
                mysqli_query($conn,$update);
                mysqli_query($conn,$update_student);
            }
        }
    }
?>
