<?php

function yourmodulename_capture($params) {

    $postfields = [
        'invoiceid' => $params['invoiceid'],
        'amount' => $params['amount'],
        'currency' => $params['currency'],
        'cardnumber' => $params['cardnum'],
        'cardexpiry' => $params['cardexp'],
        'cardcvv' => $params['cccvv'],
        'card_holder_name' => $params['clientdetails']['firstname']
            . ' - ' . $params['clientdetails']['lastname'],
        'card_address' => [
            'address_line_1' => $params['clientdetails']['address1'],
            'city' => $params['clientdetails']['city'],
            'state' => $params['clientdetails']['state'],
            'postcode' => $params['clientdetails']['postcode'],
            'country' => $params['clientdetails']['country'],
        ],
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.example.com/api/capture');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response);

    if ($data->success == 1) {
        $return = [
            'status' => 'success',
            'transid' => $data->transaction_id,
            'fee' => $data->fee,
            'rawdata' => $data,
        ];
    } else {
        $return = [
            'status' => 'declined',
            'declinereason' => $data->decline_reason,
            'rawdata' => $data,
        ];
    }
    return $return;
}