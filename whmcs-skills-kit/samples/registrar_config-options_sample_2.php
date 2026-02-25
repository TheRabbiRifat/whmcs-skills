<?php

use WHMCS\Exception\Module\InvalidConfiguration;

function yourmodulename_config_validate($params) {
    $apiKey = $params['api_key'];

    $valid = false;
    // $response = yourmodulename_apicall('validate_credentials', [
    //     'apikey' => $apiKey,
    // ]);
    // $valid = $response['valid'];

    if (!$valid) {
        throw new InvalidConfiguration('API Key is invalid.');
    }
}