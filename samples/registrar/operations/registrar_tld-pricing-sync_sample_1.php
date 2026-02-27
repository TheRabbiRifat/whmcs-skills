<?php

use WHMCS\Domain\TopLevel\ImportItem;
use WHMCS\Results\ResultsList;

function modulename_GetTldPricing(array $params)
{
    // Perform API call to retrieve extension information
    // A connection error should return a simple array with error key and message
    // return ['error' => 'This error occurred',];

    $results = new ResultsList;

    foreach ($extensionData as $extension) {
        // All the set methods can be chained and utilised together.
        $item = (new ImportItem)
            ->setExtension($extension['tld'])
            ->setMinYears($extension['minPeriod'])
            ->setMaxYears($extension['maxPeriod'])
            ->setRegisterPrice($extension['registrationPrice'])
            ->setRenewPrice($extension['renewalPrice'])
            ->setTransferPrice($extension['transferPrice'])
            ->setRedemptionFeeDays($extension['redemptionDays'])
            ->setRedemptionFeePrice($extension['redemptionFee'])
            ->setCurrency($extension['currencyCode'])
            ->setEppRequired($extension['transferSecretRequired']);

        $results[] = $item;
    }
    return $results;
}