<?php

$command = 'DomainToggleIdProtect';
$postData = array(
    'domainid' => '1',
    'idprotect' => true,
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);