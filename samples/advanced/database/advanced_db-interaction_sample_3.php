<?php

use WHMCS\Database\Capsule;

// Create a new table.
try {
    Capsule::schema()->create(
        'my_table',
        function ($table) {
            /** @var \Illuminate\Database\Schema\Blueprint $table */
            $table->increments('id');
            $table->string('name');
            $table->integer('serial_number');
            $table->boolean('is_required');
            $table->timestamps();
        }
    );
} catch (\Exception $e) {
    echo "Unable to create my_table: {$e->getMessage()}";
}