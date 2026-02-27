<?php

use WHMCS\Session;
use WHMCS\Ticket\Watchers;

add_hook('AdminAreaViewTicketPage', 1, function($vars) {
    $return = '';
    $adminId = Session::get('adminid');

    $adminWatchingTickets = Watchers::byAdmin($adminId)->pluck('ticket_id')->toArray();

    if (in_array($vars['ticketid'], $adminWatchingTickets)) {
        $return = '<div class="alert alert-info" role="alert">You are watching this ticket</div>';
    }
    return $return;
});