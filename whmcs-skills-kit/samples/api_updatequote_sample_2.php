<?php

$command = 'UpdateQuote';
$postData = array(
    'subject' => 'Test Quote Subject',
    'stage' => 'Draft',
    'lineitems' => base64_encode(serialize(array(array("id"=>1,"desc"=>"Test Description 1","qty"=>1,"up"=>"10.00","discount"=>"10.00",
"taxable"=>true),array("desc"=>"Test Description 2","qty"=>4,"up"=>"15.00","discount"=>"0.00",
"taxable"=>false)))),
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);