<?php

function modulename_Sync($params) {

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

    // Perform code to fetch domain status here

    // Return your result.
    // If 'error' is returned, all other values will be ignored. It is important to ensure 'error' is not returned in this array
    // unless the sync should not be completed. The error message will be provided in the "Domain Synchronization Report" email.

    return array(
        'active' => true, // Return true if the domain is active
        'cancelled' => false, // Return true if the domain has been cancelled
        'transferredAway' => false, // Return true if the domain has been transferred away from this registrar
        'expirydate' => '2018-09-28', // Return the current expiry date for the domain
        'error' => 'Error message goes here.' // The error message returned here will be returned within the Domain Synchronization Report Email
    );
}