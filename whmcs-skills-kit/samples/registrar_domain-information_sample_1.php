<?php

use WHMCS\Carbon;
use WHMCS\Domain\Registrar\Domain;

function modulename_GetDomainInformation($params) {
	/**
     * Perform API call to retrieve domain information. This example assumes
     * $response is populated with an array of data returned by the Registrar's API.
     */
	$response = [];

	return (new Domain)
        ->setDomain($response['domain'])
        ->setNameservers($response['nameservers'])
        ->setRegistrationStatus($response['status'])
        ->setTransferLock($response['transferlock'])
        ->setTransferLockExpiryDate(null)
        ->setExpiryDate(Carbon::createFromFormat('Y-m-d', $response['expirydate'])) // $response['expirydate'] = YYYY-MM-DD
        ->setRestorable(false)
        ->setIdProtectionStatus($response['addons']['hasidprotect'])
        ->setDnsManagementStatus($response['addons']['hasdnsmanagement'])
        ->setEmailForwardingStatus($response['addons']['hasemailforwarding'])
        ->setIsIrtpEnabled(in_array($response['tld'], ['.com']))
        ->setIrtpOptOutStatus($response['irtp']['optoutstatus'])
        ->setIrtpTransferLock($response['irtp']['lockstatus'])
        ->IrtpTransferLockExpiryDate($irtpTransferLockExpiryDate)
        ->setDomainContactChangePending($response['status']['contactpending'])
        ->setPendingSuspension($response['status']['pendingsuspend'])
        ->setDomainContactChangeExpiryDate($response['status']['expires'])
        ->setRegistrantEmailAddress($response['registrant']['email'])
        ->setIrtpVerificationTriggerFields(
            [
                'Registrant' => [
                    'First Name',
                    'Last Name',
                    'Organization Name',
                    'Email',
                ],
            ]
        );
}