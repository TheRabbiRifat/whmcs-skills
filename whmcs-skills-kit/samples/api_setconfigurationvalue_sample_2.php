<?php

$command = 'SetConfigurationValue';
$postData = array(
    'setting' => 'PremiumDomains',
    'value' => '',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);