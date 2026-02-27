<?php

use WHMCS\Database\Capsule;

// Perform potentially risky queries in a transaction for easy rollback.
try {
    Capsule::connection()->transaction(
        function ($connectionManager)
        {
            /** @var \Illuminate\Database\Connection $connectionManager */
            $connectionManager->table('my_table')->insert(
                [
                    'name' => $_POST['name'],
                    'serial_number' => $_POST['serialNumber'],
                    'is_required' => (int)(bool) $_POST['isRequired'],
                ]
            );
        }
    );
} catch (\Exception $e) {
    echo "Uh oh! Inserting didn't work, but I was able to rollback. {$e->getMessage()}";
}