<?php

$command = 'SendAdminEmail';
$postData = array(
    'messagename' => 'Service Unsuspension Successful',
    'mergefields' => array('client_id' => 1, 'service_id' => 1, 'service_product' => 'This is a product', 'service_domain' => 'sampledomain.com'),
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);