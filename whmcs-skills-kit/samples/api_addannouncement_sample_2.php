<?php

$command = 'AddAnnouncement';
$postData = array(
    'date' => '2016-01-01 15:30:00',
    'title' => 'Sample announcement',
    'announcement' => 'Text goes here...',
    'published' => '1',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);