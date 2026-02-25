<?php

$command = 'ActivateModule';
$postData = array(
    'moduleType' => 'gateway',
    'moduleName' => 'paypal',
    'parameters' => array('email' => 'billing@example.com', 'forcesubscriptions' => true),
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);