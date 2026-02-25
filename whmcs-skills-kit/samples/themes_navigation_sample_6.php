<?php

use WHMCS\View\Menu\Item as MenuItem;

add_hook('ClientAreaPrimaryNavbar', 1, function (MenuItem $primaryNavbar)
{
    if (!is_null($primaryNavbar->getChild('Support'))) {
        $primaryNavbar->getChild('Support')
            ->addChild('Emergency Contacts', array(
                'label' => Lang::trans('emergencyContacts'),
                'uri' => 'emergency.php',
                'order' => '100',
            ));
    }
});