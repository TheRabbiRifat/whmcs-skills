<?php

$command = 'AddInvoicePayment';
$postData = array(
    'invoiceid' => '1',
    'transid' => 'D28DJIDJW393JDWQKQI332',
    'gateway' => 'mailin',
    'date' => '2016-01-01 12:33:12',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);