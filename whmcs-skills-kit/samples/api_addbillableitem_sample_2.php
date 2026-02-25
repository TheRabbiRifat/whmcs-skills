<?php

$command = 'AddBillableItem';
$postData = array(
    'clientid' => '1',
    'description' => 'This is a billable item',
    'amount' => '10.00',
    'invoiceaction' => 'recur',
    'recur' => '1',
    'recurcycle' => 'Months',
    'recurfor' => '12',
    'duedate' => '2021-01-01',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);