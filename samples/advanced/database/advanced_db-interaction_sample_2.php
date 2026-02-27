<?php

use WHMCS\Database\Capsule;

// Print all client first names using a simple select.

/** @var stdClass $client */
foreach (Capsule::table('tblclients')->get() as $client) {
    echo $client->firstname . PHP_EOL;
}

// Rename all clients named "John Deo" to "John Doe" using an update statement.
try {
    $updatedUserCount = Capsule::table('tblclients')
        ->where('firstname', 'John')
        ->where('lastname', 'Deo')
        ->update(
            [
                'lastname' => 'Doe',
            ]
        );

    echo "Fixed {$updatedUserCount} misspelled last names.";
} catch (\Exception $e) {
    echo "I couldn't update client names. {$e->getMessage()}";
}