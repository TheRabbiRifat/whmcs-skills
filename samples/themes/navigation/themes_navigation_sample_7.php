<?php

use WHMCS\View\Menu\Item as MenuItem;

add_hook('ClientAreaPrimaryNavbar', 1, function (MenuItem $primaryNavbar)
{
    $client = Menu::context('client');

    // only add menu item when no client logged in
    if (is_null($client)) {
        $primaryNavbar->addChild('Example')
            ->setUri('https://www.example.com/')
            ->setOrder(100);
    }
});