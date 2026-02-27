<?php

$command = 'GetInvoices';
$postData = array(
    'userid' => '1',
    'orderby' => 'invoicenumber',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);