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

    throw new \Exception('The system was unable to authenticate with the supplied API username and password.');
}