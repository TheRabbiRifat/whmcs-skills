<?php

add_hook('CartTotalAdjustment', 1, function($vars) {
    $cart_adjustments = array();

    $products = $tlds = [];

    foreach ($vars['products'] as $product) {
        $products[] = $product['pid'];
    }

    foreach ($vars['domains'] as $domain) {
        if ($domain['type'] == 'register') {
            $domainParts = explode('.', $domain['domain'], 2);
            $tlds[] = $domainParts[1];
        }
    }

    if (in_array(1, $products) && in_array('co.uk', $tlds)) {
        $cart_adjustments = [
            "description" => "Custom discount for buying product 1 and a co.uk domain",
            "amount" => "-18.00",
            "taxed" => false,
        ];
    }
    return $cart_adjustments;
});