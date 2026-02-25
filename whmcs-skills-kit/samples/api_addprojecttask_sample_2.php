<?php

$command = 'AddProjectTask';
$postData = array(
    'projectid' => '1',
    'duedate' => '2016-01-01',
    'task' => 'This is a sample message',
    'adminid' => '2',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);