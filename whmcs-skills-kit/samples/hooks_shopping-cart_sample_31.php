<?php

use WHMCS\Service\Service;
use WHMCS\Product\Product;

Hook::add('ShoppingCartValidateUpgrade', 1, function($vars) {
    try {
        $actualHosting = Service::findOrFail($vars['id']);
        $requestedUpgrade = Product::findOrFail($vars['pid']);

        if ($requestedUpgrade->overageDiskLimit == 0 && $requestedUpgrade->overageBandwidthLimit == 0) {
            return [];
        }

        if (
            $actualHosting->diskUsage > $requestedUpgrade->overageDiskLimit
            || $actualHosting->bandwidthUsage > $requestedUpgrade->overageBandwidthLimit
        ) {
            return [
                'Your current disk or bandwidth usage exceeds the limits of the chosen product. <br /><br />Please reduce usage or select a higher plan.',
            ];
        }
        return [];
    } catch (\Exception $e) {
        return [
            'Error message feedback error 1',
            'Error message feedback error 2',
        ];
    }
});