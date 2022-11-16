<?php 
session_start();
//check if student login
if (!isset($_SESSION['studentID']) ||(trim ($_SESSION['studentID']) == '') || $_SESSION['loginstatus'] != 'active') {
	$_SESSION['message'] = 'Please Login!!';
	header('location:index.php');
	exit();
}

//DB connection
include('../controller/conn.php');

// Include configuration file  
require_once '../vendor/stripe/config.php'; 
 
//Variables
$payment_id = $statusMsg = $api_error = ''; 
$ordStatus = 'error'; 
 
// Check whether stripe token is not empty 
if(!empty($_POST['stripeToken'])){ 

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
            //Create New Subscription 
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
                    $created = date("Y-m-d H:i:s", $subsData['created']); 
                    $current_period_start = date("Y-m-d", $subsData['current_period_start']); 
                    $current_period_end   = date("Y-m-d", $subsData['current_period_end']); 
                    $status = $subsData['status']; 
                    
                    //Current Date Time
                    date_default_timezone_set("Asia/Kuala_Lumpur");
					$current = date("Y-m-d h:i:s");
					
                    // Insert transaction data into subscription table 
                    $sql = "INSERT INTO subscription(stripe_subscription_ID,student_ID,monthly_price,billing_email,plan_start,plan_end,status,created_datetime, updated_datetime) VALUES
					('".$subscrID."','".$_SESSION['studentID']."',".$planAmount.",'".$email."','".$current_period_start."','".$current_period_end."','".$status."','".$current."','".$current."')";
                    
                    $insert_subsription = $conn->query($sql); 
                    
                    // Insert transaction data into payment table 
                    $sql2 = "INSERT INTO payment(student_ID,stripe_subscription_ID,amount,payment_datetime,status) VALUES
					('".$_SESSION['studentID']."','sub_1LvY5UEYRt4577ibifZxWEHt',".$planAmount.",'".$current."','Suceed')";
                    
                    $insert_payment = $conn->query($sql2); 
					
                    //Payment Status
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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <!-- MDB -->
    <link rel="stylesheet" href="../src/css/mdb.min.css"/>
</head>
<body>
    <!-- Transaction Receipt -->
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