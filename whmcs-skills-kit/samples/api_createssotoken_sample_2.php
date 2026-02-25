<?php

$command = 'CreateSsoToken';
$postData = array(
    'client_id' => '1',
    'destination' => 'clientarea:product_details',
    'service_id' => '1',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);