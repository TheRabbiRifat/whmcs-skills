<?php
/**
 * Disable the send welcome email checkbox by default when creating a new client.
 */

if (!defined('WHMCS')) {
    die('This hook should not be run directly');
}

add_hook('AdminAreaFooterOutput', 1, function ($vars) {
    if (strpos($_SERVER['REQUEST_URI'], 'clientsadd.php') !== false) {
        return '<script>
        $(document).ready(function() {
            $("input[name=sendemail]").attr("checked", false);
        });
    </script>';
    }
});