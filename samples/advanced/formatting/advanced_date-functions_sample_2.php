<?php

/**
 * Formats a MySQL Date/Timestamp value to system settings
 *
 * @param string $datetimestamp The MySQL Date/Timestamp value
 * @param bool $includeTime Pass true to include the time in the result
 * @param bool $applyClientDateFormat Set true to apply Localisation > Client Date Format
 *
 * @return string
 */
$date = fromMySQLDate($date, $includeTime, $applyClientDateFormat);