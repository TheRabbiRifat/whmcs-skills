<?php
/**
 * Hook for VatNumberVerification must return a verification constant from
 * \WHMCS\Billing\VAT\Verification\VerificationInterface:
 * * STATE_VERIFIED - if the VAT number is registered
 * * STATE_UNVERIFIED - if the VAT number is not registered
 * * STATE_UNKNOWN - if the hook cannot determine the registration state of the
 *   VAT number
 *
 * Multiple hooks may be registered. When a hook responds with STATE_VERIFIED or
 * STATE_UNVERIFIED, the response is treated as authoritative and final.
 * By final:
 *  * when there are multiple hooks are registered, the first authoritative answer
 *    will be yielded to the application, and remaining registered hooks will not
 *    be consulted, and no additional integrated services will be consulted.
 *
 * If neither STATE_VERIFIED nor STATE_UNVERIFIED is yielded after process all
 * registered hooks, STATE_UNKNOWN will be used by the system. When the system
 * uses STATE_UNKNOWN, other integrated services of the system will be polled in
 * an attempt to get an authoritative, final response of STATE_VERIFIED or
 * STATE_UNVERIFIED.
 *
 * Two examples:
 * 1) a hook that uses custom logic for Ireland and Germany and all other EU regions
 * 2) a hook that allows some hypothetical test mode to give results for test numbers
 *
 * While these two could be in one hook, registering both illustrates the pipeline
 * for the verification request.
 */

add_hook('VatNumberVerification', 1, function($vars) {
    /** @var \WHMCS\Billing\VAT\VatNumber $vatNumber */
    $vatNumber = $vars['vatNumber'];
    $isValid = null;

    if ($vatNumber->getPrefix() == 'IE') {
        // Handle Ireland VAT numbers with custom logic
        $number = $vatNumber->getNumber(); // Example: '091234567'

        // custom logic here
        $isValid = customIrelandVatCheck($number);
    } elseif ($vatNumber->getPrefix() == 'DE') {
        // Handle Germany VAT numbers with custom logic
        $isValid = customGermanyVatCheck($vatNumber->getNumber());
    } elseif ($vatNumber->isEU()) {
        // Handle Germany VAT numbers with custom logic
        $isValid = customEuVatCheck($vatNumber->getNumber());
    }

    if ($isValid === false) {
        return \WHMCS\Billing\VAT\Verification\VerificationInterface::STATE_UNVERIFIED;
    } elseif ($isValid === true) {
        return \WHMCS\Billing\VAT\Verification\VerificationInterface::STATE_VERIFIED;
    } else {
        // let any other hook or the system give a final answer
        return \WHMCS\Billing\VAT\Verification\VerificationInterface::STATE_UNKNOWN;
    }
});

add_hook('VatNumberVerification', 1, function($vars) {
    /** @var \WHMCS\Billing\VAT\VatNumber $vatNumber */
    $vatNumber = $vars['vatNumber'];

    if ($someTestModeFlag) {
        if ($vatNumber->getIdentifier() == 'GB123456789') {
            return \WHMCS\Billing\VAT\Verification\VerificationInterface::STATE_VERIFIED;
        } elseif ($vatNumber->getIdentifier() == 'GB987654321') {
            return \WHMCS\Billing\VAT\Verification\VerificationInterface::STATE_UNVERIFIED;
        }
    }

    // let any other hook or the system give a final answer
    return \WHMCS\Billing\VAT\Verification\VerificationInterface::STATE_UNKNOWN;
});