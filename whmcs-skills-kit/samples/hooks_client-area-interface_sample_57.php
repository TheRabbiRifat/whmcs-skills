<?php

add_hook('ClientAreaSecondaryNavbar', 1, function($secondaryNavbar) {
    /** @var \WHMCS\View\Menu\Item $secondaryNavbar */
    $newMenu = $secondaryNavbar->addChild(
        'uniqueMenuItemName',
        array(
            'name' => 'Home',
            'label' => Lang::trans('languageStringVariable'),
            'uri' => 'clientarea.php',
            'order' => 99,
            'icon' => 'fas fa-calendar-alt',
        )
    );
    $newMenu->addChild(
        'uniqueSubMenuItemName',
        array(
            'name' => 'Item Name 1',
            'label' => Lang::trans('languageStringVariable'),
            'uri' => 'cart.php',
            'order' => 10,
            'icon' => 'fa-cart-plus',
        )
    );
});