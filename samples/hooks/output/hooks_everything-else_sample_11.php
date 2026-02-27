<?php

add_hook('EmailPreSend', 1, function($vars) {
    $merge_fields = [];
    if (!array_key_exists('my_custom_var', $vars['mergefields'])) {
        $merge_fields['my_custom_var'] = "My Custom Var";
        $merge_fields['my_custom_var2'] = "My Custom Var2";
    }
    if ($vars['messagename'] == 'My Message Name' && $vars['relid'] == 2) {
        //Stop the email from sending a specific message and related id.
        $merge_fields['abortsend'] = true;
    }
    $merge_fields['attachments'] = [
        [
            'filename' => 'invoice.pdf',
            'data' => file_get_contents('path/to/file.pdf'),
        ],
    ];

    return $merge_fields;
});