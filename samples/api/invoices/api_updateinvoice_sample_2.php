<?php

$command = 'UpdateInvoice';
$postData = array(
    'invoiceid' => '1',
    'status' => 'Unpaid',
    'itemdescription' => array(13 => 'Sample Updated Invoice Item'),
    'itemamount' => array(13 => 16.95),
    'itemtaxed' => array(13 => false),
    'newitemdescription' => array(0 => 'New Line Item 1', 1 => 'New Line Item 2'),
    'newitemamount' => array(0 => 10.00, 1 => 2.95),
    'newitemtaxed' => array(0 => true, 1 => false),
    'deletelineids' => array(11, 12),
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);