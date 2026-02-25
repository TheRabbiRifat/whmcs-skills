<?php

$command = 'ValidateLogin';
$postData = array(
    'email' => 'user@example.com',
    'password2' => 'abc123',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);