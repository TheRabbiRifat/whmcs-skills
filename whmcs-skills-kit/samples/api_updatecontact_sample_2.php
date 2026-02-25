<?php

$command = 'UpdateContact';
$postData = array(
    'contactid' => '1',
    'firstname' => 'John',
    'lastname' => 'Doe',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);