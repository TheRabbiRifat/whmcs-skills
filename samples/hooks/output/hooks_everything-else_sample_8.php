<?php

add_hook('CustomFieldLoad', 1, function($vars) {
    return array('value' => 'overridden value',);
});