<?php

$command = 'UpdateTicket';
$postData = array(
    'ticketid' => '1',
    'subject' => 'This is a sample updated ticket subject',
    'clientid' => '1',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);