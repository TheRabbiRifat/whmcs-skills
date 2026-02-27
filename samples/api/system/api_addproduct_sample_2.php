<?php

$command = 'AddProduct';
$postData = array(
    'type' => 'other',
    'gid' => '1',
    'name' => 'Sample Product',
    'welcomeemail' => '5',
    'paytype' => 'recurring',
    'pricing' => array(1 => array('monthly' => 1.00, 'msetupfee' => 1.99, 'quarterly' => 2.00, 'qsetupfee' => 1.99, 'semiannually' => 3.00, 'ssetupfee' => 1.99, 'annually' => 4.00, 'asetupfee' => 1.99, 'biennially' => 5.00, 'bsetupfee' => 1.99, 'triennially' => 6.00, 'tsetupfee' => 1.99)),
    'recommendations' => array(array('id' => 1, 'order' => 0), array('id' => 2, 'order' => 1)),
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);