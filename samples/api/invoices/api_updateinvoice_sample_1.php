<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.example.com/includes/api.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query(
        array(
            'action' => 'UpdateInvoice',
            // See https://developers.whmcs.com/api/authentication
            'username' => 'IDENTIFIER_OR_ADMIN_USERNAME',
            'password' => 'SECRET_OR_HASHED_PASSWORD',
            'invoiceid' => '1',
            'status' => 'Unpaid',
            'itemdescription' => array(13 => 'Sample Updated Invoice Item'),
            'itemamount' => array(13 => 16.95),
            'itemtaxed' => array(13 => false),
            'newitemdescription' => array(0 => 'New Line Item 1', 1 => 'New Line Item 2'),
            'newitemamount' => array(0 => 10.00, 1 => 2.95),
            'newitemtaxed' => array(0 => true, 1 => false),
            'deletelineids' => array(11, 12),
            'responsetype' => 'json',
        )
    )
);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);