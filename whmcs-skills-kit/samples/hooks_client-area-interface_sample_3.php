<?php

add_hook('ClientAreaHomepagePanels', 1, function($homePagePanels) {
    $newPanel = $homePagePanels->addChild(
        'unique-css-name',
        array(
            'name' => 'Friendly Name',
            'label' => 'Translated Language String',
            'icon' => 'fas fa-calendar-alt', //see http://fortawesome.github.io/Font-Awesome/icons/
            'order' => '99',
            'extras' => array(
                'color' => 'pomegranate', //see Panel Accents in template styles.css
                'btn-link' => 'https://www.whmcs.com',
                'btn-text' => Lang::trans('go'),
                'btn-icon' => 'fas fa-arrow-right',
            ),
        )
    );
// Repeat as needed to add enough children
    $newPanel->addChild(
        'unique-css-name-id1',
        array(
            'label' => 'Panel Row Text Goes Here',
            'uri' => 'index.php?m=yourmodule',
            'order' => 10,
        )
    );
});