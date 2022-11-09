<?php 
session_start();
// if (!isset($_SESSION['clientid']) ||(trim ($_SESSION['clientid']) == '')) {
// 	$_SESSION['message'] = 'Please Login!!';
// 	header('location:index.php');
// 	exit();
// 	}
include('../controller/conn.php');
// Include configuration file  
require_once 'config.php'; 
 
$payment_id = $statusMsg = $api_error = ''; 
$ordStatus = 'error'; 
 
// Check whether stripe token is not empty 
if(!empty($_POST['stripeToken'])){ 

	//$product = $_SESSION['product'];
    // Retrieve stripe token and payer info from the submitted form data 
    $token  = $_POST['stripeToken']; 
    $name 	= $_POST['name']; 
    $email 	= $_POST['email']; 
	
    // Plan info 
    $planInfo = 1; 
    $planName = 'Premium'; 
    $planPrice = 10; 
    $planInterval = 'month'; 
     
    // Include Stripe PHP library 
    require_once '../vendor/stripe/stripe-php/init.php'; 
     
    // Set API key 
    \Stripe\Stripe::setApiKey(STRIPE_API_KEY); 
     
    // Add customer to stripe 
    try {  
        $customer = \Stripe\Customer::create(array( 
            'name' => $name,
            'email' => $email, 
            'source'  => $token 
        )); 
    }catch(Exception $e) {  
        $api_error = $e->getMessage();  
    } 
     
    if(empty($api_error) && $customer){  
     
        // Convert price to cents 
        $priceCents = round($planPrice*100); 
     
        // Create a plan 
        try { 
            $plan = \Stripe\Plan::create(array( 
                "product" => [ 
                    "name" => $planName 
                ], 
                "amount" => $priceCents, 
                "currency" => $currency, 
                "interval" => $planInterval, 
                "interval_count" => 1 
            )); 
        }catch(Exception $e) { 
            $api_error = $e->getMessage(); 
        } 
         
        if(empty($api_error) && $plan){ 
            // Creates a new subscription 
            try { 
                $subscription = \Stripe\Subscription::create(array( 
                    "customer" => $customer->id, 
                    "items" => array( 
                        array( 
                            "plan" => $plan->id, 
                        ), 
                    ), 
                )); 
            }catch(Exception $e) { 
                $api_error = $e->getMessage(); 
            } 
             
            if(empty($api_error) && $subscription){ 
                // Retrieve subscription data 
                $subsData = $subscription->jsonSerialize(); 
         
                // Check whether the subscription activation is successful 
                if($subsData['status'] == 'active'){ 
                    $timezone = date_default_timezone_get();
                    date_default_timezone_set("$timezone");
                    // Subscription info 
                    $subscrID = $subsData['id']; 
                    $custID   = $subsData['customer']; 
                    $planID   = $subsData['plan']['id']; 
                    $planAmount   = ($subsData['plan']['amount']/100); 
                    $planCurrency = $subsData['plan']['currency']; 
                    $planinterval = 1; 
                    //$planIntervalCount = $subsData['plan']['interval_count']; 
                    $created = date("Y-m-d H:i:s", $subsData['created']); 
                    $current_period_start = date("Y-m-d", $subsData['current_period_start']); 
                    $current_period_end   = date("Y-m-d", $subsData['current_period_end']); 
                    $status = $subsData['status']; 
                    
                    date_default_timezone_set("Asia/Kuala_Lumpur");
                    $currentDT = date("Y-m-d h:i:s");
					
					$current = date("Y-m-d h:i:s");
					$date 	 = date("Y-m-d");
					$month   = date("m");
					
					if($planinterval == "month")
					{
						$newexpiry = date('Y-m-d', strtotime( $_SESSION['expiry'] . " +1 month"));
					}
					else if($planinterval == "year")
					{
						$newexpiry = date('Y-m-d', strtotime( $_SESSION['expiry'] . " +1 year"));
					}
					
                    // Insert transaction data into the database 
                    $sql = "INSERT INTO subscription(stripe_subscription_ID,student_ID,monthly_price,billing_email,plan_start,plan_end,status,created_datetime, updated_datetime) VALUES
					('".$subscrID."','SCPG1800369',".$planAmount.",'khye143914@gmail.com','".$current_period_start."','".$current_period_end."','".$status."','".$current."','".$current."')";
                    
                    $insert_subsription = $conn->query($sql); 
                    
                    $sql2 = "INSERT INTO payment(student_ID,stripe_subscription_ID,amount,payment_datetime,status) VALUES
					('SCPG1800369','sub_1LvY5UEYRt4577ibifZxWEHt',".$planAmount.",'".$currentDT."','Suceed')";
                    
                    $insert_payment = $conn->query($sql2); 

                    // Insert transaction data into the database 
                    // $sql = "INSERT INTO user_subscriptions(client_id,stripe_subscription_id,stripe_customer_id,stripe_plan_id,plan_amount,plan_amount_currency,plan_interval,plan_interval_count,payer_email,created,plan_period_start,plan_period_end,status) VALUES
					// ('".$_SESSION['clientid']."','".$subscrID."','".$custID."','".$planID."','".$planAmount."','".$planCurrency."','".$planinterval."','".$planIntervalCount."','".$email."','".$created."','".$current_period_start."','".$current_period_end."','".$status."')"; 
                    // $insert = $conn->query($sql);  
                     
					// Update previous payment record
					// $check = mysqli_query($conn,"select * from payment where productid='".$_SESSION['productid']."' and clientid='".$_SESSION['clientid']."'");
					// if (mysqli_num_rows($check) >= 1)
					// {
					// 	$update = "update payment set status='renewed',updatedBy='$current' WHERE clientid='".$_SESSION['clientid']."' and productid='".$_SESSION['productid']."'";
					// 	mysqli_query($conn,$update);
					// }
							
					// Insert into payment table
					// $sql2 = "INSERT INTO payment(stripe_subscription_id,clientid,agentid,productid,productname,insurance_type,plan_interval,price,month,date,expiry_date,createdBy,updatedBy,status) VALUES
					// ('".$subscrID."','".$_SESSION['clientid']."','".$_SESSION['agentid']."','".$_SESSION['productid']."','".$_SESSION['product']."','".$_SESSION['insurance_type']."','$planinterval','$planAmount','$month','$date','$newexpiry','$current','$current','$status')"; 
                    // $insert2 = $conn->query($sql2);
					
                    $ordStatus = 'success'; 
                    $statusMsg = 'Payment Successful!'; 
                }else{ 
                    $statusMsg = "Subscription activation failed!"; 
                } 
            }else{ 
                $statusMsg = "Subscription creation failed! ".$api_error; 
            } 
        }else{ 
            $statusMsg = "Plan creation failed! ".$api_error; 
        } 
    }else{  
        $statusMsg = "Invalid card details! $api_error";  
    } 
}else{ 
    $statusMsg = "Error on form submission, please try again."; 
} 
?>
<!DOCTYPE html>
<html>
<head>
<!-- <style>
.container{
	width: 100%;
}
.status{
	width: 400px;
	height: 440px;
	margin-left:auto;
	margin-right:auto;
	font-size: 20px;border: 2px solid black;
	padding: 10px;
}
button{
	padding: 10px 20px;
	margin-right: 20px;
}
</style> -->
<!-- Font Awesome -->
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="../src/css/mdb.min.css"/>
</head>
<body>
<div style="background:#1aff1a;"><h1 class="<?php echo $ordStatus; ?>" style="text-align:center;"><?php echo $statusMsg; ?></h1></div>
    <div class="modal-content" style="width:400px; margin: 5% auto; padding:10px; text-align:center; border: 1px solid;">
        <?php if(!empty($subscrID)){ ?>
            <div class="row" style="margin:0 2px;"><h3 style="text-align:center;"><b>Payment Information</b></h3></div>
            <div class="content" margin:30px 0; style="float:left;">
                <p><b>Transaction ID:</b> <?php echo $subscrID; ?></p>
                <p><b>Subscription Plan:</b> Premium</p>
                <p><b>Amount:</b> <?php echo $planPrice.' '.$currency; ?></p>
                <p><b>Period Start:</b> <?php echo $current_period_start; ?></p>
                <p><b>Period End:</b> <?php echo $current_period_end; ?></p>
                <p><b>Status:</b> <?php echo $status; ?></p>
            </div>
        <?php } ?>
        <button onclick="location.href='subscription_details.php'" class="btn btn-primary" style="float: right;">Done</button>
    </div>
</div>
</body>
</html>