<?php

add_hook('AdminAreaClientSummaryActionLinks', 1, function($vars) {
    $return = [];

    if ($vars['userid'] == 1) {
        $return[] = '<a href="https://www.whmcs.com/">WHMCS</a>';
        $return[] = '<a href="https://www.enom.com/">eNom</a>';
    }

    return $return;
});