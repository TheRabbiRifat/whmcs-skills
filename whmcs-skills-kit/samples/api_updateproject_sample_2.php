<?php

$command = 'UpdateProject';
$postData = array(
    'title' => 'This is a Test Project',
    'adminid' => '2',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);