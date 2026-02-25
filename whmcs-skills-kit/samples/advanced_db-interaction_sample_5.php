<?php

use WHMCS\Database\Capsule;

// Perform potentially risky queries in a transaction for easy rollback.
$pdo = Capsule::connection()->getPdo();
$pdo->beginTransaction();

try {
    $statement = $pdo->prepare(
        'insert into my_table (name, serial_number, is_required) values (:name, :serialNumber, :isRequired)'
    );

    $statement->execute(
        [
            ':name' => $_POST['name'],
            ':serialNumber' => $_POST['serialNumber'],
            ':isRequired' => (bool) $_POST['isRequired'],
        ]
    );
    if ($pdo->inTransaction()) {
        $pdo->commit();
    }
} catch (\Exception $e) {
    echo "Uh oh! {$e->getMessage()}";
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
}