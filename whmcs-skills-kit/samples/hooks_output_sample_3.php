<?php

add_hook('AdminAreaHeaderOutput', 1, function($vars) {
    $return = '';
    if (array_key_exists('project_management', $vars['addon_modules'])) {
        $return = '<b>This is a custom output on the header when Project Management is enabled</b>';
    }
    return $return;
});