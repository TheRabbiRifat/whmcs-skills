<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.example.com/includes/api.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
    http_build_query(
        array(
            'action' => 'OpenTicket',
            // See https://developers.whmcs.com/api/authentication
            'username' => 'IDENTIFIER_OR_ADMIN_USERNAME',
            'password' => 'SECRET_OR_HASHED_PASSWORD',
            'deptid' => '1',
            'subject' => 'This is a sample ticket',
            'message' => 'This is a **sample** ticket message',
            'clientid' => '1',
            'priority' => 'Medium',
            'markdown' => true,
            'attachments' => base64_encode(json_encode([['name' => 'sample_text_file.txt', 'data' => base64_encode('This is a sample text file contents')]])),
            'preventClientClosure' => true,
            'responsetype' => 'json',
        )
    )
);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);