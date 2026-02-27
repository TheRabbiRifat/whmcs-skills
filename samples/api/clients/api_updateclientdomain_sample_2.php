<?php

$command = 'UpdateClientDomain';
$postData = array(
    'domainid' => '1',
    'status' => 'Terminated',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);