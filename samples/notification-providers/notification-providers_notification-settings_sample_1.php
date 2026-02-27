<?php

public function notificationSettings()
{
    return [
        'priority' => [
            'FriendlyName' => 'Notification Priority',
            'Type' => 'dropdown',
            'Options' => [
                'Low',
                'Medium',
                'High',
            ],
            'Description' => 'Choose the notification priority for the alert.',
        ],
    ];
}