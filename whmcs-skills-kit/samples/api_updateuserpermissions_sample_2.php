<?php

$command = 'UpdateUserPermissions';
$postData = array(
    'user_id' => '1',
    'client_id' => '1',
    'permissions' => 'profile,contacts,products,manageproducts,productsso,domains,managedomains,invoices,quotes,tickets,affiliates,emails,orders',
);
$adminUsername = 'ADMIN_USERNAME'; // Optional for WHMCS 7.2 and later

$results = localAPI($command, $postData, $adminUsername);
print_r($results);