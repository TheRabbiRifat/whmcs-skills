<?php

$command = 'GetEmails';
$postData = array(
    'clientid' => '1',
    'subject' => 'elcom',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);