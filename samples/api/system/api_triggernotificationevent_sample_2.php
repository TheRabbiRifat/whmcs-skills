<?php

$command = 'TriggerNotificationEvent';
$postData = array(
    'notification_identifier' => 'custom.server.add',
    'title' => 'New Server Added',
    'message' => 'new-server.examplehost.com added as a cPanel server and is available for provisioning.',
    'url' => 'https://whmcs.example.test/admin/configservers.php?action=manage&id=3',
    'status' => 'Success',
    'statusStyle' => 'info',
    'attributes[0][label]' => 'example',
    'attributes[0][value]' => 'example',
    'attributes[0][url]' => 'https://whmcs.example.test/admin/configservers.php?action=manage&id=3',
    'attributes[0][style]' => 'success',
    'attributes[0][icon]' => 'example',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);