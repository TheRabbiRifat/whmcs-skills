<?php

$command = 'UpdateClientProduct';
$postData = array(
    'serviceid' => '1',
    'status' => 'Terminated',
    'customfields' => base64_encode(serialize(array("1"=>"Yahoo"))),
    'configoptions' => base64_encode(serialize(array(configoptionid => dropdownoptionid, XXX => array('optionid' => YYY, 'qty' => ZZZ)))),
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);