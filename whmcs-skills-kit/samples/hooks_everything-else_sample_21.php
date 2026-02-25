<?php

//Stop the Domain Purchase for this Premium Domain
add_hook('PremiumPriceOverride', 1, function($vars) {
    return ['noSale' => true,];
});

//Force the Client to Contact Support to Purchase Domain
add_hook('PremiumPriceOverride', 1, function($vars) {
    return ['contactUs' => true,];
});

//Override the Register and Renew Pricing & Skip Markup Application
add_hook('PremiumPriceOverride', 1, function($vars) {
    return [
        'register' => 150.00,
        'renew' => 200.00,
        'skipMarkup' => true,
    ];
});