<?php

$command = 'GetToDoItems';
$postData = array(
    'status' => 'Incomplete',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);