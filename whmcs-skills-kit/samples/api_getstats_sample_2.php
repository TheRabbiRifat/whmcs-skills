<?php

$command = 'GetStats';
$postData = array(
    'timeline_days' => '7',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);