<?php

//Skip applying the commission for affiliate 2
add_hook('AffiliateCommission', 1, function($vars) {
    $return = [];

    if ($vars['affiliateId'] == 2) {
        $return['skipCommission'] = true;
    }
    return $return;
});


//Ensure commission is applied for affiliate 3
add_hook('AffiliateCommission', 1, function($vars) {
    $return = [];

    if ($vars['affiliateId'] == 3) {
        $return['payout'] = true;
    }
    return $return;
});