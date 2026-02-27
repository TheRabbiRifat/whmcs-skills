<?php

use WHMCS\View\Menu\Item as MenuItem;

add_hook('ClientAreaPrimaryNavbar', 1, function (MenuItem $primaryNavbar)
{
    $navItem = $primaryNavbar->getChild('Support');
    if (is_null($navItem)) {
        return;
    }

    $navItem = $navItem->getChild('Announcements');
    if (is_null($navItem)) {
        return;
    }

    $navItem->setOrder(1);

});