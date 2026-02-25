<?php

$command = 'ApplyCredit';
$postData = array(
    'invoiceid' => '1',
    'amount' => '10.00',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);