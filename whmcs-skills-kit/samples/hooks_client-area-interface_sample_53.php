<?php

add_hook('ClientAreaPrimarySidebar', 1, function($primarySidebar) {
    /** @var \WHMCS\View\Menu\Item $primarySidebar */
    $newMenu = $primarySidebar->addChild(
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