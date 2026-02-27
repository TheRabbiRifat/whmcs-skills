<?php

$command = 'AddTransaction';
$postData = array(
    'paymentmethod' => 'paypal',
    'userid' => '1',
    'transid' => 'FJWEK32DWO329JFW',
    'date' => '01/01/2016',
    'description' => 'A sample API payment',
    'amountin' => '10.00',
    'fees' => '0.89',
    'rate' => '1.00000',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);