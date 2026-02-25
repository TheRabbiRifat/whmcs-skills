<?php

$command = 'UpdateTicketReply';
$postData = array(
    'replyid' => '1',
    'message' => 'This is a sample updated ticket reply',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);