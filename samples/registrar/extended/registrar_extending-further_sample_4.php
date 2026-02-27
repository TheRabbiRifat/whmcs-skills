<?php

$domainObj = $params['original']['domainObj'];
$fullDomainUnicode = $domainObj->toPunycode(); // The full domain name as stored in the database.
$isIdn = $domainObj->isIdn(); // Returns true if domain is an IDN domain.
$fullDomainPunycode = $domainObj->toUnicode(); // The full domain name in Unicode.
$secondLevelUnicode = $domainObj->getUnicodeSecondLevel(); // The domain name (excluding TLD) in Unicode.
$secondLevelPunycode = $domainObj->getPunycodeSecondLevel(); // The domain name (excluding TLD) converted to Punycode.
$tld = $domainObj->getTopLevel(); // The Top Level Domain for the given domain.