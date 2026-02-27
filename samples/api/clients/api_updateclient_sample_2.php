<?php

$command = 'UpdateClient';
$postData = array(
    'clientid' => '1',
    'firstname' => 'John',
    'lastname' => 'Doe',
    'email' => 'john.doe@example.com',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);