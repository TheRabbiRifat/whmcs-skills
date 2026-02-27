<?php

use WHMCS\View\Menu\Item as MenuItem;

add_hook('ClientAreaPrimarySidebar', 1, function (MenuItem $primarySidebar)

{
    if (!is_null($primarySidebar->getChild('My Account'))) {
        $primarySidebar->getChild('My Account')
            ->addChild('Mailing List Subscription Prefs')
                ->setLabel('Subscription Preferences')
                ->setUri('subscriptionprefs.php')
                ->setOrder(100);
    }
});