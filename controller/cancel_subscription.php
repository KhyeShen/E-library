<?php
// Include Stripe PHP library 
require_once '../vendor/stripe/stripe-php/init.php'; 
require_once '../vendor/stripe/config.php'; 

//DB connection
include('conn.php');

//extract user's subscription details
$subscription = mysqli_query($conn,"SELECT * from `subscription` WHERE student_ID = '".$_SESSION['studentID']."'");
if (mysqli_num_rows($subscription) > 0) {
    $row = mysqli_fetch_assoc($subscription); 
    $subscription_ID = $row['stripe_subscription_ID'];
} else {
    $subscription_ID = "";
}

//Variables
date_default_timezone_set("Asia/Kuala_Lumpur");
$currentDT = date("Y-m-d h:i:s");
$api_error = ''; 

// // Set API key 
\Stripe\Stripe::setApiKey(STRIPE_API_KEY); 

//Cancel subscription
try {
    $customer = \Stripe\Subscription::update(
    $subscription_ID,
  [
    'cancel_at_period_end' => true,
  ]
);
}catch(Exception $e) { 
    $api_error = $e->getMessage(); 
} 

//update subscription status in DB
if(empty($api_error) && $subscription){ 
    $update = "UPDATE subscription set status='last', updated_datetime='$currentDT' WHERE student_ID = '".$_SESSION['studentID']."'";
    mysqli_query($conn,$update_student);
}
header('location:../student/subscription_details.php');
//}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
</head>
<body>
<p><?php echo $subscription_ID; ?></p>

<script>
    // Get payment form element
var form = document.getElementById('paymentFrm');

// Create a token when the form is submitted.
form.addEventListener('submit', function(e) {
    e.preventDefault();
   createToken();
});

// Create single-use token to charge the payer
function createToken() {
    stripe.createToken(cardElement).then(function(result) {
        if (result.error) {
            // Inform the payer if there was an error
            resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
        } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
        }
    });
}

// Callback to handle the response from stripe
function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
	
    // Submit the form
    form.submit();
}
</script>
</body>
</html>