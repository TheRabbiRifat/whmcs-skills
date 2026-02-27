<?php

$command = 'CreateInvoice';
$postData = array(
    'userid' => '1',
    'status' => 'Unpaid',
    'sendinvoice' => '1',
    'paymentmethod' => 'mailin',
    'taxrate' => '10.00',
    'date' => '2016-01-01',
    'duedate' => '2016-01-08',
    'itemdescription1' => 'Sample Invoice Item',
    'itemamount1' => '15.95',
    'itemtaxed1' => '0',
    'itemdescription2' => 'Sample Second Invoice Item',
    'itemamount2' => '1.00',
    'itemtaxed2' => '1',
    'autoapplycredit' => '0',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);