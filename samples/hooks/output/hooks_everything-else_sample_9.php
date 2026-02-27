<?php

add_hook('CustomFieldSave', 1, function($vars) {
    return array('value' => 'overridden value',);
});