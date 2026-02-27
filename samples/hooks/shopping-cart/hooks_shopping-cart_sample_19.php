<?php

use WHMCS\Carbon;

add_hook('OrderProductUpgradeOverride', 1, function($vars) {
    $return = [];

    if ($vars['newproductid'] == 15) {
        /**
         * No promotion should be applied to product 15
         */
        $return['promoqualifies'] = false;
    }
    if (Carbon::now()->toDateString() == '2016-12-25') {
        /**
         * Offer half price upgrade on Christmas Day
         * This can also be done by halving the $vars['price'] and returning that.
         */
        $return['totaldays'] = round($vars['totaldays'] / 2);
    }
    return $return;
});