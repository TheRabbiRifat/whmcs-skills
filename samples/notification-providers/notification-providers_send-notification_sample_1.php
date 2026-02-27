<?php

public function sendNotification(NotificationInterface $notification, $moduleSettings, $notificationSettings)
{
    $api_username = $moduleSettings['api_username'];
    $api_password = $moduleSettings['api_password'];

    $priority = $notificationSettings['priority'];
    $channel = $notificationSettings['channel'];

    // Build API Request to remote service

    $postData = [
        'username' => $api_username,
        'password' => $api_password,
        'priority' => $priority,
        'channel' => $channel,
        'title' => $notification->getTitle(),
        'message' => $notification->getMessage(),
        'url' => $notification->getUrl(),
        'attributes' => [],
    ];

    // Attributes vary depending on the event trigger. Loop through as necessary.
    foreach ($notification->getAttributes() as $attribute) {
        $postData['attributes'][] = [
            'label' => $attribute->getLabel(),
            'value' => $attribute->getValue(),
            'url' => $attribute->getUrl(),
            'style' => $attribute->getStyle(),
            'icon' => $attribute->getIcon(),
        ];
    }

    // Call the remote API
    $response = file_get_contents('https://www.example.com/?' . http_build_query($postData));

    if (!$response) {
        // Throw a human friendly exception on error
        throw new Exception('No response received from API');
    }
}