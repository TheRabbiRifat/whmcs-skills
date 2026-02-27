<?php

$command = 'AddUser';
$postData = array(
    'firstname' => 'John',
    'lastname' => 'Doe',
    'email' => 'john.doe@example.com',
    'password2' => 'password',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);