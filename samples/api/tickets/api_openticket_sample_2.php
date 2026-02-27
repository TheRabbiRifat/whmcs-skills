<?php

$command = 'OpenTicket';
$postData = array(
    'deptid' => '1',
    'subject' => 'This is a sample ticket',
    'message' => 'This is a **sample** ticket message',
    'clientid' => '1',
    'priority' => 'Medium',
    'markdown' => true,
    'attachments' => base64_encode(json_encode([['name' => 'sample_text_file.txt', 'data' => base64_encode('This is a sample text file contents')]])),
    'preventClientClosure' => true,
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);