<?php

$command = 'AddCredit';
$postData = array(
    'clientid' => '1',
    'description' => 'Adding funds via api',
    'amount' => '12.34',
    'adminid' => '1',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);