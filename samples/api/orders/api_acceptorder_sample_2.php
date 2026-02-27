<?php

$command = 'AcceptOrder';
$postData = array(
    'orderid' => '1',
    'registrar' => 'enom',
    'autosetup' => true,
    'sendemail' => true,
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);