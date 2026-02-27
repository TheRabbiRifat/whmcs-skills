<?php

use WHMCS\Authentication\CurrentUser;

add_hook('OrderProductPricingOverride', 1, function($vars) {
    $return = [];

    /**
     * Get the logged in client. Returns null if no client logged in.
     *
     * @see https://developers.whmcs.com/advanced/authentication/
     */
    $client = CurrentUser::client();

    /**
     * Run the following rules if a Client is logged in.
     */
    if ($client) {
        /**
         * Override the product price when ordering product 1 and the user has the ID 10.
         */
        if ($vars['pid'] == 1 && $client->id == 10) {
            $return = ['setup' => '0.00', 'recurring' => '0.00',];
        }

        /**
         * Override the product price when user has the ID 72.
         */
        if ($client->id == 72) {
            $return = ['setup' => '0.00', 'recurring' => '0.00',];
        }
    }
    return $return;
});