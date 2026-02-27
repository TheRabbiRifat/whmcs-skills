<?php

$command = 'UpdateUser';
$postData = array(
    'user_id' => '1',
    'firstname' => 'John',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);