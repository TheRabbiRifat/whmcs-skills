<?php
add_hook('AfterModuleCreateFailed', 1, function($vars)
    {
        // Fetch failure response message & module parameters
        $failureResponseMessage = $vars['failureResponseMessage'];
        $moduleParameters = $vars['params'];

        // Execute your post failure code here
    }
);