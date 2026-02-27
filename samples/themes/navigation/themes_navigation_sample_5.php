<?php

use WHMCS\View\Menu\Item as MenuItem;

add_hook('ClientAreaPrimaryNavbar', 1, function (MenuItem $primaryNavbar)
{
    $primaryNavbar->addChild('Menu Name')
        ->setUri('https://www.example.com/')
        ->setOrder(70);
});