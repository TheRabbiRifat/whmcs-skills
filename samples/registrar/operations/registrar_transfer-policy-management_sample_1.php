<?php

use WHMCS\Carbon;
use WHMCS\Domain\Registrar\Domain;

function modulename_GetDomainInformation(array $params) {
	// Perform API call to retrieve domain information

	return (new Domain)
        ->setIsIrtpEnabled(true)
        ->setIrtpOptOutStatus(false)
        ->setIrtpTransferLock(true)
        ->setIrtpTransferLockExpiryDate(Carbon::createFromFormat('Y-m-d', '2019-06-15'))
        ->setDomainContactChangePending(true)
        ->setPendingSuspension(true)
        ->setDomainContactChangeExpiryDate(Carbon::createFromFormat('Y-m-d', '2018-08-20'))
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