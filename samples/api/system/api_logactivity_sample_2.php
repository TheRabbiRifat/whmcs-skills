<?php

$command = 'LogActivity';
$postData = array(
    'description' => 'Activity log entry text goes here',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);