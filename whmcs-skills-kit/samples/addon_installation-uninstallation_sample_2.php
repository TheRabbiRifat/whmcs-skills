<?php

function addonmodule_deactivate()
{
    // Undo any database and schema modifications made by your module here
    try {
        Capsule::schema()
            ->dropIfExists('mod_addonexample');
        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'This is a demo module only. '
                . 'In a real module you might report a success here.',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            "status" => "error",
            "description" => "Unable to drop mod_addonexample: {$e->getMessage()}",
        ];
    }
}