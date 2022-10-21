<?php 
session_start();
// if (!isset($_SESSION['clientid']) ||(trim ($_SESSION['clientid']) == '')) {
// 	$_SESSION['message'] = 'Please Login!!';
// 	header('location:loginpage.php');
// 	exit();
// }
include('../controller/conn.php');
	
if(isset($_POST['usersbm'])){
	$_SESSION['subscr_plan'] = $_POST['subscr_plan'];
}

// Include configuration file  
require_once 'config.php'; 
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">

<script src="https://js.stripe.com/v3/"></script>
<link rel="stylesheet" href="css/style.css">
<style>
.container{
	height: 470px;
	width: 100%;
	padding-top: 150px;
}
.panel{
	text-align: center;
	width: 500px;
	height: 420px;
	margin-left:auto;
	margin-right:auto;
	font-size: 20px;
	border: 2px solid black;
	padding: 20px;
}
button{
  padding: 10px 20px;
}
</style>
</head>
<body>
<div class="container">
<!-- Display errors returned by createToken -->
<div id="paymentResponse" style="text-align:center; color:red;"></div>
<div class="panel">
    <form action="pay.php" method="POST" id="paymentFrm">
	
        <div class="panel-body">
            
			<b style="font-size: 27px;">Bank Card Details</b><br/><br/>
			
            <!-- Payment form -->
            <div class="form-group">
                <label>NAME</label>
                <input type="text" name="name" id="name" class="field" placeholder="Enter name" required="" autofocus="">
            </div><br/>
            <div class="form-group">
                <label>EMAIL</label>
                <input type="email" name="email" id="email" class="field" placeholder="Enter email" required="">
            </div><br/>
            <div class="form-group">
                <label>CARD NUMBER</label>
                <div id="card_number" class="field" style="width: 150px; margin-left: auto; margin-right: auto;"></div>
            </div><br/>
            <div class="row">
                <div class="left">
                    <div class="form-group">
                        <label>EXPIRY DATE</label>
                        <div id="card_expiry" class="field" style="width: 60px; margin-left: auto; margin-right: auto;"></div>
                    </div>
                </div>
                <div class="right">
                    <div class="form-group">
                        <label>CVC CODE</label>
                        <div id="card_cvc" class="field" style="width: 30px; margin-left: auto; margin-right: auto;"></div>
                    </div>
                </div>
            </div><br/>
			<input type="checkbox" id="agree" name="vehicle1" value="agree" required>
			<label for="agree">Agree to make payment</label><br/><br/>
            <button type="submit" class="btn btn-success" id="payBtn" style="float: right; padding: 10px 20px;">Submit Payment</button>
        </div>
    </form>
	<button type="button" onclick="location.href='home.php'" class="btn-link" style="float: left;">Cancel</button>
</div>
</div>
<script>
// Create an instance of the Stripe object
// Set your publishable API key
var stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

// Create an instance of elements
var elements = stripe.elements();

var style = {
    base: {
        fontWeight: 400,
        fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
        fontSize: '16px',
        lineHeight: '1.4',
        color: '#555',
        backgroundColor: '#fff',
        '::placeholder': {
            color: '#888',
        },
    },
    invalid: {
        color: '#eb1c26',
    }
};

var cardElement = elements.create('cardNumber', {
    style: style
});
cardElement.mount('#card_number');

var exp = elements.create('cardExpiry', {
    'style': style
});
exp.mount('#card_expiry');

var cvc = elements.create('cardCvc', {
    'style': style
});
cvc.mount('#card_cvc');

// Validate input of the card elements
var resultContainer = document.getElementById('paymentResponse');
cardElement.addEventListener('change', function(event) {
    if (event.error) {
        resultContainer.innerHTML = '<p>'+event.error.message+'</p>';
    } else {
        resultContainer.innerHTML = '';
    }
});

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