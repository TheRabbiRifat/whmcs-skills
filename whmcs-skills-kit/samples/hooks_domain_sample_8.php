<?php
add_hook('PreRegistrarRegisterDomain', 1, function($vars)
    {
        $domainName = $vars['params']['sld'] . '.' . $vars['params']['tld'];

        return array(
            'abortWithError' => 'Error message to display goes here',
        );

        //return array(
        //    'abortWithSuccess' => true,
        //);
    }
);