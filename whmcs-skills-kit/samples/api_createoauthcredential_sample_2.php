<?php

$command = 'CreateOAuthCredential';
$postData = array(
    'grantType' => 'single_sign_on',
    'scope' => 'clientarea:sso clientarea:billing_info clientarea:announcements',
    'serviceId' => '1',
    'description' => 'Billing and Announcements SSO',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);