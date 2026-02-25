<?php

$command = 'AddClient';
$postData = array(
    'firstname' => 'John',
    'lastname' => 'Doe',
    'email' => 'john.doe@example.com',
    'address1' => '123 Main Street',
    'city' => 'Anytown',
    'state' => 'State',
    'postcode' => '12345',
    'country' => 'US',
    'phonenumber' => '800-555-1234',
    'password2' => 'password',
    'clientip' => '1.2.3.4',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);