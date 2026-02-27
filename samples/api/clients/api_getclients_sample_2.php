<?php

$command = 'GetClients';
$postData = array(
    'search' => 'example.com',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);