<?php

$command = 'UpdatePayMethod';
$postData = array(
    'paymethodid' => '1',
    'clientid' => '1',
    'card_expiry' => '1025',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);