<?php

$command = 'GetUsers';
$postData = array(
    'search' => 'john.smith@example.net',
    'responsetype' => 'json',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);