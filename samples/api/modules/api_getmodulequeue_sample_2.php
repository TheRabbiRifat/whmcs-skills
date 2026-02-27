<?php

$command = 'GetModuleQueue';
$postData = array(
    'serviceType' => 'service',
    'moduleName' => 'cpanel',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);