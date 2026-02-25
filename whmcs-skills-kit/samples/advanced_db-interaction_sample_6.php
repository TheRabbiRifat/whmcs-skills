<?php

use WHMCS\Database\Capsule;

// Loop through each Capsule query made during the page request.
foreach (Capsule::connection()->getQueryLog() as $query) {
    echo "Query: {$query['query']}" . PHP_EOL;
    echo "Execution Time: {$query['time']}ms" . PHP_EOL;
    echo "Parameters: " . PHP_EOL;

    foreach ($query['bindings'] as $key => $value) {
        echo "{$key} => {$value}" . PHP_EOL;
    }
}