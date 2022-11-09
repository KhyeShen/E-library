<?php
    require_once '../../vendor/stripe/stripe-php/init.php';
    \Stripe\Stripe::setApiKey('sk_test_51HmWyTEYRt4577ibGiP7HcuM6niqmvZLTsgGkGGo6B1Jawtvm3nViYm6ZR0jIQ781wGOzsPj3DLxdwB5aNaI0rlu00P8wUny5e');

    \Stripe\PaymentIntent::create([
    'amount' => 1000,
    'currency' => 'MYR',
    'payment_method_types' => ['card'],
    'receipt_email' => 'khye143914@gmail.com',
    ]);
?>