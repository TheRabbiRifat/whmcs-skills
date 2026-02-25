<?php

function modulename_TransferSync($params) {

    /**
     * Available parameters include the following.
     * Any settings defined in your Config Options method will also be available.
     */

    $params['domainid'];
    $params['domain'];
    $params['sld'];
    $params['tld'];
    $params['registrar'];
    $params['regperiod'];
    $params['status'];
    $params['dnsmanagement'];
    $params['emailforwarding'];
    $params['idprotection'];

    // Perform code to fetch transfer status here

    return array(
        'completed' => true, // Return as true upon successful completion of the transfer
        'expirydate' => '2017-10-15', // The expiry date of the domain
        'failed' => false, // Return as true when transfer fails permanently
        'reason' => 'Reason message can go here', // Reason for the transfer failure if available
        'error' => 'Error message goes here', // If the check fails, an error message string can be provided here
    );
}