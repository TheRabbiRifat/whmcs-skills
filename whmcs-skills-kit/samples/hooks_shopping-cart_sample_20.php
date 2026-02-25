<?php

add_hook('OverrideOrderNumberGeneration', 1, function($vars) {
    // Generate and return a custom order number value (must be a valid integer).
    // We also recommend ensuring the custom number is unique.
    return time();
});