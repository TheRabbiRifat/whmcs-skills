<?php

$command = 'MergeTicket';
$postData = array(
    'ticketid' => '1',
    'mergeticketids' => '2,3,4,5,6,7',
    'subject' => 'This is a sample updated ticket subject',
    'clientid' => '1',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);