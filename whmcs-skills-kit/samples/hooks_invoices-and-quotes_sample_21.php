<?php

use WHMCS\Service\Service;

/**
 * Prevent invoicing of any new services added to clientID 5
 */

add_hook('PreInvoicingGenerateInvoiceItems', 1, function() {
    $services = Service::where('userid', 5)
        ->where('billingcycle', '!=', 'Free Account')
        ->get();

    foreach ($services as $service) {
        $service->billingcycle = 'Free Account';
        $service->save();
    }
});