<?php

/**
 * Format currency
 *
 * @param float $amount
 * @param int   $currencyId
 *
 * @return \WHMCS\View\Formatter\Price
 */
$price = formatCurrency($amount, $currencyData['id']);