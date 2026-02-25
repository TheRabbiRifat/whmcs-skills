<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.example.com/includes/api.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query(
        array(
            'action' => 'DomainUpdateWhoisInfo',
            // See https://developers.whmcs.com/api/authentication
            'username' => 'IDENTIFIER_OR_ADMIN_USERNAME',
            'password' => 'SECRET_OR_HASHED_PASSWORD',
            'domainid' => '1',
            'xml' => '<contactdetails><Registrant><Name>Test Client</Name><Email>test@testemail.com</Email><Company>WHMCS</Company><Address1>123 Test Street</Address1><Address2></Address2><Address3></Address3><City>Test</City><State>Test</State><Zip>TE5 5ST</Zip><Country>GB</Country><Tel_Country_Code>44</Tel_Country_Code><Telephone>1234567890</Telephone></Registrant></contactdetails>',
            'responsetype' => 'json',
        )
    )
);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);