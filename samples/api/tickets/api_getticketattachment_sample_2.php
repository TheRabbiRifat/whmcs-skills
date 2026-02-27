<?php

$command = 'GetTicketAttachment';
$postData = array(
    'relatedid' => '1',
    'type' => 'ticket',
    'index' => '0',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);