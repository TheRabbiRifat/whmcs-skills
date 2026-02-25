<?php

/**
 * Setting the 'icontype' value to 'fa' allows for the use of Font Awesome icons.
 */
add_hook('AdminPredefinedAddons', 1, function () {
    return [
        [
            'module' => 'yourmodule',
            'icontype' => 'fa',
            'iconvalue' => 'fad fa-cube',
            'labeltype' => 'success',
            'labelvalue' => 'Sample Label',
            'paneltitle' => 'Sample Title',
            'paneldescription' => 'Description to be displayed in the Predefined Addon panel.',
            'addonname' => 'On addon creation, this value will be used as the addon name.',
            'addondescription' => 'On addon creation, this value will be used as the addon description.',
            'welcomeemail' => 'Hosting Account Welcome Email',
            'featureaddon' => 'Name of feature addon as stored in the database.',
        ],
    ];
});

/**
 * Alternatively the 'icontype' value can be set to 'url' to allow for the use of URLs and file paths.
 */
add_hook('AdminPredefinedAddons', 1, function () {
    return [
        [
            'module' => 'yourmodule',
            'icontype' => 'url',
            'iconvalue' => 'https://www.whmcs.com/images/logo.png',
            'paneltitle' => 'Sample Title',
            'paneldescription' => 'Description to be displayed in the Predefined Addon panel.',
            'addonname' => 'On addon creation, this value will be used as the addon name.',
            'addondescription' => 'On addon creation, this value will be used as the addon description.',
            'featureaddon' => 'Name of feature addon as stored in the database.',
        ],
    ];
});