<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.example.com/includes/api.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query(
        array(
            'action' => 'CreateOrUpdateTLD',
            // See https://developers.whmcs.com/api/authentication
            'username' => 'IDENTIFIER_OR_ADMIN_USERNAME',
            'password' => 'SECRET_OR_HASHED_PASSWORD',
            'extension' => '.com',
            'id_protection' => true,
            'dns_management' => true,
            'email_forwarding' => true,
            'epp_required' => true,
            'auto_registrar' => 'enom',
            'currency_code' => 'USD',
            'grace_period_days' => '0',
            'grace_period_fee' => '-1',
            'redemption_period_fee' => '75.00',
            'register' => array(1 => '10.00', 2 => '20.00', 3 => '30.00', 4 => '40.00', 5 => '50.00', 6 => '60.00', 7 => '70.00', 8 => '80.00', 9 => '90.00', 10 => '100.00'),
            'renew' => array(1 => '10.00', 2 => '20.00', 3 => '30.00', 4 => '40.00', 5 => '50.00', 6 => '60.00', 7 => '70.00', 8 => '80.00', 9 => '90.00'),
            'transfer' => array(1 => '10.00'),
            'responsetype' => 'json',
        )
    )
);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);