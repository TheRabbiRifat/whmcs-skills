<?php

use WHMCS\Service\Service;

add_hook('OrderAddonPricingOverride', 1, function($vars) {
    $return = [];
    if (array_key_exists('proddata', $vars)) {
        /**
         * This is a product and addon purchase
         */
        if ($vars['addonid'] == 1 && $vars['proddata']['pid'] == 1) {
            $return = ['setup' => '1.00', 'recurring' => '5.00',];
        }
    } else {
        /**
         * This is an addon only purchase for existing service
         */
        $serviceData = Service::find($vars['serviceid']);
        if ($serviceData && $vars['addonid'] == 1 && $serviceData->packageId == 1) {
            $return = ['setup' => '1.00', 'recurring' => '5.00',];
        }
    }
    return $return;
});