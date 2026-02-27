<?php

function modulename_ResendIRTPVerificationEmail(array $params) {
	// Perform API call to initiate resending of the IRTP Verification Email
	$success = true;
	$errorMessage = '';

	if ($success) {
		return ['success' => true];
	} else {
		return ['error' => $errorMessage];
	}
}