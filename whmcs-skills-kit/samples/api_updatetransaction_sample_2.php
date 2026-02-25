<?php

$command = 'UpdateTransaction';
$postData = array(
    'transactionid' => '1',
    'transid' => 'FJWEK32DWO329JFWUPDATE',
    'rate' => '1.00000',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);