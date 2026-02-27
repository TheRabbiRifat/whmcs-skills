<?php

$command = 'AddPayMethod';
$postData = array(
    'clientid' => '1',
    'type' => 'CreditCard',
    'description' => 'New Card',
    'card_number' => '4242424242424242',
    'card_expiry' => '0423',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);