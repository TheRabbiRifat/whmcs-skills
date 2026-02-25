<?php

$command = 'CreateClientInvite';
$postData = array(
    'client_id' => '1',
    'email' => 'john.doe@example.net',
    'permissions' => 'products,manageproducts,managedomains,tickets',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);