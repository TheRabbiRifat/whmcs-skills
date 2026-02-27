<?php

$command = 'GetAutomationLog';
$postData = array(
    'startdate' => '2016-11-01',
    'enddate' => '2016-11-07',
    'namespace' => 'createinvoices',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);