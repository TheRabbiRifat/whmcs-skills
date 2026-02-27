<?php

add_hook('OrderDomainPricingOverride', 1, function($vars) {
    // Perform operations to determine price.
    // To override the first payment amount only simply return a float
    return '64.95';
    // To override the first payment and recurring amount, return an array as follows
    return ['firstPaymentAmount' => 64.95, 'recurringAmount' => 14.45];
});