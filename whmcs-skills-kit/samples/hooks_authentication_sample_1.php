<?php
add_hook('ClientLoginShare', 1, function($vars) {
    // Perform custom authentication logic here
    // There are 4 supported return values, each demonstrated below.

    // User not found
    return false;

    // Login as existing WHMCS Client ID
    return array(
        'id' => '123',
    );

    // Login as existing WHMCS Client by Email Address
    return array(
        'email' => 'demo@whmcs.com',
    );

    // Create a new client and login
    return array(
        'create' => true,
        'email' => 'demo@whmcs.com',
        'firstname' => 'Demo',
        'lastname' => 'User',
        'companyname' => 'Demo Company',
        'address1' => '123 Demo Street',
        'address2' => '',
        'city' => 'Demo',
        'state' => 'Demo',
        'postcode' => '12345',
        'country' => 'US',
        'phonenumber' => '11111111111',
        'password' => 'xxxxxxxx',
    );
});