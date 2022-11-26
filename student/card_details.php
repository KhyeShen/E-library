<?php 
session_start();

//Check login status
require('../controller/login_status.php');
//DB connection
require('../controller/conn.php');
// Include configuration file  
require_once '../vendor/stripe/config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <script src="https://js.stripe.com/v3/"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <!-- MDB -->
    <link rel="stylesheet" href="../src/css/mdb.min.css"/>
    
  </head>
  <body>
    <div class="" style="text-align: center;"><img src="../src/image/stripe.png"></div>
        <form action="pay.php" method="POST" id="paymentFrm">
            <div class="modal-content" style="width:400px; margin: 2% auto; padding:10px; text-align:center; border: 1px solid;">
                
                <!-- Payment form -->
                <b style="font-size: 27px;">Bank Card Details</b><br/>
                
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
                </div>
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
                <div class="form-check mx-auto">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" required/>
                    <label class="form-check-label" for="flexCheckChecked">Agree T&C</label>
                </div>
                <div class="">    
                    <button type="submit" class="btn btn-success" id="payBtn" style="float: left;">Pay</button>
                    <button type="button" onclick="history.back()" class="btn btn-secondary" style="float: right;">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <script>
    // Create an instance of the Stripe object
    // Set your publishable API key
    var stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

    // Create an instance of elements
    var elements = stripe.elements();

    //Styling CSS
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