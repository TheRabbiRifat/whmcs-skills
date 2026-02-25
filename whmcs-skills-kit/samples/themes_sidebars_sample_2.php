<?php

use WHMCS\View\Menu\Item as MenuItem;

add_hook('ClientAreaPrimarySidebar', 1, function(MenuItem $primarySidebar)
{
    $primarySidebar->getChild('My Account')
        ->getChild('Billing Information')
        ->setUri('https://www.example.com/billingInfo');
});