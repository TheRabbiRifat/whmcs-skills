<?php

use WHMCS\User\Alert;

add_hook('ClientAlert', 1, function($client) {
    $firstName = $client->firstName;
    $lastName = $client->lastName;
    return new Alert(
        "This is a test notification for {$firstName} {$lastName}",
        'info' //see http://getbootstrap.com/components/#alerts
    );
});