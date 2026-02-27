<?php

$command = 'DomainUpdateWhoisInfo';
$postData = array(
    'domainid' => '1',
    'xml' => '<contactdetails><Registrant><Name>Test Client</Name><Email>test@testemail.com</Email><Company>WHMCS</Company><Address1>123 Test Street</Address1><Address2></Address2><Address3></Address3><City>Test</City><State>Test</State><Zip>TE5 5ST</Zip><Country>GB</Country><Tel_Country_Code>44</Tel_Country_Code><Telephone>1234567890</Telephone></Registrant></contactdetails>',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);