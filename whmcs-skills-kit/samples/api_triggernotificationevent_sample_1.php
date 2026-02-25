<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.example.com/includes/api.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query(
        array(
            'action' => 'TriggerNotificationEvent',
            // See https://developers.whmcs.com/api/authentication
            'username' => 'IDENTIFIER_OR_ADMIN_USERNAME',
            'password' => 'SECRET_OR_HASHED_PASSWORD',
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
            'responsetype' => 'json',
        )
    )
);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);