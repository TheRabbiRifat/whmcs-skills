<?php

$command = 'DomainUpdateLockingStatus';
$postData = array(
    'domainid' => '1',
    'lockstatus' => true,
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);