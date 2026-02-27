<?php
/**
 * Display a banner on the admin area view ticket page.
 */

use WHMCS\Config\Setting;

if (!defined('WHMCS')) {
    die('This hook should not be run directly');
}

add_hook('AdminAreaViewTicketPage', 1, function ($vars) {
    $systemUrl = Setting::getValue('SystemURL');

    $ticketData = localAPI('GetTicket', array(
        'ticketid' => $vars['ticketid']
    ));

    $clientTicketUrl = $systemUrl . '/viewticket.php?tid='
        . $ticketData['tid'] . '&c=' . $ticketData['c'];

    return <<<EOT
<script>
$(document).ready(function() {
    $('<div class="alert alert-info text-center"><a href="' . $clientTicketUrl . '" target="_blank">' . $clientTicketUrl . '</a></div>').prependTo('#contentarea');
});
</script>
EOT;
});