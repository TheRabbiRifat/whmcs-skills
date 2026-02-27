<?php

$command = 'AddBannedIp';
$postData = array(
    'ip' => '1.2.3.4',
    'reason' => 'Abuse',
    'days' => '30',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);