<?php

$command = 'UpdateToDoItem';
$postData = array(
    'itemid' => '1',
    'adminid' => '1',
    'status' => 'Completed',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);