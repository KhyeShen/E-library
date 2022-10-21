<?php 
// Subscription plans 
// Minimum amount is $0.50 US 
// Interval day, week, month or year 
$plans = array( 
    '1' => array( 
        'name' => 'Pay For A Month', 
        'price' => 100, 
        'interval' => 'month' 
    ), 
    '2' => array( 
        'name' => 'Pay For A Year ', 
        'price' => 1200, 
        'interval' => 'year' 
    ) 
); 
// $smartplans = array( 
//     '1' => array( 
//         'name' => 'Pay For A Month', 
//         'price' => 150, 
//         'interval' => 'month' 
//     ), 
//     '2' => array( 
//         'name' => 'Pay For A Year ', 
//         'price' => 1800, 
//         'interval' => 'year' 
//     ) 
// );
$currency = "MYR";  
 
/* Stripe API configuration 
 * Remember to switch to your live publishable and secret key in production! 
 * See your keys here: https://dashboard.stripe.com/account/apikeys 
 */ 
// define('STRIPE_API_KEY', 'sk_test_51FRFQ6BLGR4ytWqFpbbtlNyP9LMufaLqGB7h0aocowTG0cEWOJz0ScIqtZv9ka79fusGFanHvhECXGwwqNt5AUfP00aHrlozUC'); 
// define('STRIPE_PUBLISHABLE_KEY', 'pk_test_05HfyWzTXXmu9vGK3VLyZKzc00sAb7fTLl'); 
define('STRIPE_API_KEY', 'sk_test_51HmWyTEYRt4577ibGiP7HcuM6niqmvZLTsgGkGGo6B1Jawtvm3nViYm6ZR0jIQ781wGOzsPj3DLxdwB5aNaI0rlu00P8wUny5e'); 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51HmWyTEYRt4577ib9CYthVwDdcU1N66PC2UYOBnHxwFxlFNhSerUGXIQ8uEoIwZT9bQHoNFr3wNjCl1DEw5YVoWC00pXPIqH8p'); 
  
// Database configuration  
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', 'root'); 
define('DB_NAME', 'insurance');