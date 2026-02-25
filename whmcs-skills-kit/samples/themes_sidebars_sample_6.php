<?php

use WHMCS\View\Menu\Item as MenuItem;

add_hook('ClientAreaPrimarySidebar', 1, function(MenuItem $primarySidebar)
{
    $primarySidebar->getChild('My Account')
        ->removeChild('Billing Information');
});