<?php

add_hook('ContactDetailsValidation', 1, function($vars) {
    return [
        'Error message feedback error 1',
        'Error message feedback error 2',
    ];
});