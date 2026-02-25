<?php

add_hook('ClientAreaProductDetailsOutput', 1, function($service) {
    if (!is_null($service)) {
        $orderID = $service['service']->orderId;
        return 'OrderID: ' . $orderID;
    }
    return '';
});