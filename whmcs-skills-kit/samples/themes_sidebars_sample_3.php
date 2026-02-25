<?php

use WHMCS\View\Menu\Item as MenuItem;

add_hook('ClientAreaPrimarySidebar', 1, function(MenuItem $primarySidebar)
{
    $primarySidebar->getChild('My Account')
        ->getChild('Billing Information')
        ->setOrder(25); // default menu items have orders 10, 20, 30, etc...
});