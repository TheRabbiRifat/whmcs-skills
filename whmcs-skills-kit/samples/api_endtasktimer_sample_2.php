<?php

$command = 'EndTaskTimer';
$postData = array(
    'projectid' => '1',
    'timerid' => '1',
    'adminid' => '2',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);