<?php

//Do not open a ticket for affiliate 2
add_hook('AffiliateWithdrawalRequest', 1, function($vars) {
    $return = [];
    if ($vars['affiliateId'] == 2) {
        $return['skipTicket'] = true;
    }

    return $return;
});