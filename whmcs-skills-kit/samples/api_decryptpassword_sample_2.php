<?php

$command = 'DecryptPassword';
$postData = array(
    'password2' => 'vNRQzRPKQA6obJpHMHCBivS0D9/Pf532oArYvewP',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);