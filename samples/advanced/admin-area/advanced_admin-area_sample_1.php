<?php
/**
 * Provide a link to an addon module from the client summary page.
 */

if (!defined('WHMCS')) {
    die('This hook should not be run directly');
}

add_hook('AdminAreaClientSummaryActionLinks', 1, function ($vars) {
    $userid = $vars['userid'];

    $url = 'addonmodules.php?module=addon_module&userid=' . $userid;

    return [
        '<a href="' . $url . '">My custom addon link</a>',
    ];
});