<?php

add_hook('ClientAreaFooterOutput', 1, function($vars) {
    $language = $vars['language'];
    $sslPage = $vars['servedOverSsl'];
    return '<b>This is a custom output on the footer</b>';
});