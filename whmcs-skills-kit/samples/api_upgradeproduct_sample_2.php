<?php

$command = 'UpgradeProduct';
$postData = array(
    'serviceid' => '1',
    'paymentmethod' => 'paypal',
    'newproductbillingcycle' => 'monthly',
    'type' => 'product',
    'newproductid' => '11',
    'configoptions' => [1 => 4, 2 => 5],
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);