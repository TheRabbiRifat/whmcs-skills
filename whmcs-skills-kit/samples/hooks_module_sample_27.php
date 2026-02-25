<?php
add_hook('PreModuleCreate', 1, function($vars)
    {
        return array(
            'abortcmd' => true,
        );
    }
);