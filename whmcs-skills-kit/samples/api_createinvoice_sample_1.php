<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.example.com/includes/api.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query(
        array(
            'action' => 'CreateInvoice',
            // See https://developers.whmcs.com/api/authentication
            'username' => 'IDENTIFIER_OR_ADMIN_USERNAME',
            'password' => 'SECRET_OR_HASHED_PASSWORD',
            'userid' => '1',
            'status' => 'Unpaid',
            'sendinvoice' => '1',
            'paymentmethod' => 'mailin',
            'taxrate' => '10.00',
            'date' => '2016-01-01',
            'duedate' => '2016-01-08',
            'itemdescription1' => 'Sample Invoice Item',
            'itemamount1' => '15.95',
            'itemtaxed1' => '0',
            'itemdescription2' => 'Sample Second Invoice Item',
            'itemamount2' => '1.00',
            'itemtaxed2' => '1',
            'autoapplycredit' => '0',
            'responsetype' => 'json',
        )
    )
);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);