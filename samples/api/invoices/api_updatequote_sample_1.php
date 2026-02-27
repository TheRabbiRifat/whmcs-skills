<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.example.com/includes/api.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query(
        array(
            'action' => 'UpdateQuote',
            // See https://developers.whmcs.com/api/authentication
            'username' => 'IDENTIFIER_OR_ADMIN_USERNAME',
            'password' => 'SECRET_OR_HASHED_PASSWORD',
            'subject' => 'Test Quote Subject',
            'stage' => 'Draft',
            'lineitems' => base64_encode(serialize(array(array("id"=>1,"desc"=>"Test Description 1","qty"=>1,"up"=>"10.00","discount"=>"10.00",
"taxable"=>true),array("desc"=>"Test Description 2","qty"=>4,"up"=>"15.00","discount"=>"0.00",
"taxable"=>false)))),
            'responsetype' => 'json',
        )
    )
);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);