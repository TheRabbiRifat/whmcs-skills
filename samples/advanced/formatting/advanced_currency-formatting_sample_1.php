<?php

/**
 * Get clients currency
 *
 * Required before making a call to formatCurrency
 *
 * @param int $clientId The database ID number of the client to retrieve the currency information from
 *
 * @return array
 */
$currencyData = getCurrency($clientId);