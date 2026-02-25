<?php

$command = 'FraudOrder';
$postData = array(
    'orderid' => '1',
    'cancelsub' => '1',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);