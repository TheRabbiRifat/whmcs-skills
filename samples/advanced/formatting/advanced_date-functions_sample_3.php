<?php

/**
 * Converts a date entered in the system setting format to a MySQL Date/Timestamp
 *
 * @param string $userInputDate
 *
 * @return string Format: 2016-12-30 23:59:59
 */
$date = toMySQLDate($date);