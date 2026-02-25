<?php

$command = 'ModuleCustom';
$postData = array(
    'serviceid' => '1',
    'func_name' => 'reboot',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);