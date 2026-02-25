<?php

$command = 'AddProjectMessage';
$postData = array(
    'projectid' => '1',
    'message' => 'This is a sample message',
    'adminid' => '2',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);