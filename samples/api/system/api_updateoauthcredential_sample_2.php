<?php

$command = 'UpdateOAuthCredential';
$postData = array(
    'credentialId' => '1',
    'name' => 'Credential name',
    'resetSecret' => true,
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);