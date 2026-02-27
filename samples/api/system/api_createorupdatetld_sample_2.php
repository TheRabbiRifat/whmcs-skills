<?php

$command = 'CreateOrUpdateTLD';
$postData = array(
    'extension' => '.com',
    'id_protection' => true,
    'dns_management' => true,
    'email_forwarding' => true,
    'epp_required' => true,
    'auto_registrar' => 'enom',
    'currency_code' => 'USD',
    'grace_period_days' => '0',
    'grace_period_fee' => '-1',
    'redemption_period_fee' => '75.00',
    'register' => array(1 => '10.00', 2 => '20.00', 3 => '30.00', 4 => '40.00', 5 => '50.00', 6 => '60.00', 7 => '70.00', 8 => '80.00', 9 => '90.00', 10 => '100.00'),
    'renew' => array(1 => '10.00', 2 => '20.00', 3 => '30.00', 4 => '40.00', 5 => '50.00', 6 => '60.00', 7 => '70.00', 8 => '80.00', 9 => '90.00'),
    'transfer' => array(1 => '10.00'),
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);