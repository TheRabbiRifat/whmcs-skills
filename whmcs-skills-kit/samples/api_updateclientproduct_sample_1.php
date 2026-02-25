<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.example.com/includes/api.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query(
        array(
            'action' => 'UpdateClientProduct',
            // See https://developers.whmcs.com/api/authentication
            'username' => 'IDENTIFIER_OR_ADMIN_USERNAME',
            'password' => 'SECRET_OR_HASHED_PASSWORD',
            'serviceid' => '1',
            'status' => 'Terminated',
            'customfields' => base64_encode(serialize(array("1"=>"Yahoo"))),
            'configoptions' => base64_encode(serialize(array(configoptionid => dropdownoptionid, XXX => array('optionid' => YYY, 'qty' => ZZZ)))),
            'responsetype' => 'json',
        )
    )
);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);