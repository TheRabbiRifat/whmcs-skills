<?php

$command = 'AddTicketReply';
$postData = array(
    'ticketid' => '1',
    'message' => 'This is a sample ticket reply',
    'clientid' => '1',
    'customfields' => base64_encode(serialize(array("1"=>"Google"))),
    'markdown' => true,
    'attachments' => base64_encode(json_encode([['name' => 'sample_text_file.txt', 'data' => base64_encode('This is a sample text file contents')]])),
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);