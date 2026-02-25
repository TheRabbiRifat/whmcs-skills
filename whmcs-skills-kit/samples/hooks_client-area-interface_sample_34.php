<?php

add_hook('ClientAreaPageLogin', 1, function($vars) {
    $extraVariables = [
        'newVariable1' => 'thisValue',
        'newVariable2' => 'thatValue',
    ];
    return $extraVariables;
});