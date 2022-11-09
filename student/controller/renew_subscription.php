<?php
// Include Stripe PHP library 
require_once '../../vendor/stripe/stripe-php/init.php'; 
require_once '../config.php'; 

include('../../controller/conn.php');
$subscription = mysqli_query($conn,"SELECT * from `subscription` WHERE student_ID = 'SCPG1800369'");
if (mysqli_num_rows($subscription) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($subscription); 
    $subscription_ID = $row['stripe_subscription_ID'];
} else {
    $subscription_ID = "";
}

date_default_timezone_set("Asia/Kuala_Lumpur");
$currentDT = date("Y-m-d h:i:s");
$api_error = ''; 

// // Set API key 
\Stripe\Stripe::setApiKey(STRIPE_API_KEY); 
// \Stripe\Stripe::setApiKey('sk_test_51HmWyTEYRt4577ibGiP7HcuM6niqmvZLTsgGkGGo6B1Jawtvm3nViYm6ZR0jIQ781wGOzsPj3DLxdwB5aNaI0rlu00P8wUny5e');

try {
    $customer = \Stripe\Subscription::update(
    $subscription_ID,
  [
    'cancel_at_period_end' => false,
  ]
);
}catch(Exception $e) { 
    $api_error = $e->getMessage(); 
} 
if(empty($api_error) && $subscription){ 
    $update = "UPDATE subscription set status='active', updated_datetime='$currentDT' WHERE student_ID = 'SCPG1800369'";
    mysqli_query($conn,$update);
}
header('location:../subscription_details.php');
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