<?php

$command = 'SendEmail';
$postData = array(
    '//example1' => 'example',
    'messagename' => 'Client Signup Email',
    'id' => '1',
    '//example2' => 'example',
    'customtype' => 'product',
    'customsubject' => 'Product Welcome Email',
    'custommessage' => '<p>Thank you for choosing us</p><p>Your custom is appreciated</p><p>{$custommerge}<br />{$custommerge2}</p>',
    'customvars' => base64_encode(serialize(array("custommerge"=>$populatedvar1, "custommerge2"=>$populatedvar2))),
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);