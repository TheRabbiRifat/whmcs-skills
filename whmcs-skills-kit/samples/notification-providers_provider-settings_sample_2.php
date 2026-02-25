<?php

/**
 * Test connection.
 *
 * @param array $settings
 *
 * @return array
 */
public function testConnection($settings)
{
    $api_username = $settings['api_username'];
    $api_password = $settings['api_password'];

    // Attempt to connect to API service to verify input credentials
    // and upon error, throw an exception.

    throw new \Exception('Unable to authenticate with supplied API username and password');
}