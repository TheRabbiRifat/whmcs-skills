<?php

$command = 'AddContact';
$postData = array(
    'clientid' => '1',
    'firstname' => 'Jane',
    'lastname' => 'Doe',
    'email' => 'jane.doe@example.com',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);