<?php

public function notificationSettings()
{
    return [
        'channel' => [
            'FriendlyName' => 'Notification Channel',
            'Type' => 'dynamic',
            'Description' => 'Choose the notification channel for the alert.',
        ],
    ];
}

public function getDynamicField($fieldName, $settings)
{
    $values = [];

    if ($fieldName == 'channel') {

        // Perform remote API call, query or database fetch and build an array:
        //
        // $values[] = [
        //     'id' => '123',
        //     'name' => 'Demo Room',
        //     'description' => 'Room ID',
        // ];

    } elseif ($fieldName == '...') {
        // ....
    }

    return [
        'values' => $values,
    ];
}