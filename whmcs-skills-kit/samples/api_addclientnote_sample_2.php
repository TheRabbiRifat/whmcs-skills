<?php

$command = 'AddClientNote';
$postData = array(
    'userid' => '1',
    'notes' => 'Note to add',
    'sticky' => true,
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);