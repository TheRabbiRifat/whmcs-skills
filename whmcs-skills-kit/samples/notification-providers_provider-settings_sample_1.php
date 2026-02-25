<?php

/**
 * Provider settings.
 *
 * @return array
 */
public function settings()
{
    return [
        'api_username' => [
            'FriendlyName' => 'API Username',
            'Type' => 'text',
            'Description' => 'Required username to authenticate with messaging service',
        ],
        'api_password' => [
            'FriendlyName' => 'API Password',
            'Type' => 'password',
            'Description' => 'Required password to authenticate with messaging service',
        ],
    ];
}