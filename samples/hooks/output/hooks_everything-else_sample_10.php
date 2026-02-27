<?php

//Do not log emails for userid 2
add_hook('EmailPreLog', 1, function($vars) {
    $return = [];

    if ($vars['userid'] == 2) {
        $return['abortLogging'] = true;
    }

    return $return;
});

//Override the saved subject of the email for userid 3
add_hook('EmailPreLog', 1, function($vars) {
    $return = [];

    if ($vars['userid'] == 3) {
        $return['subject'] = 'This subject is overridden';
    }

    return $return;
});