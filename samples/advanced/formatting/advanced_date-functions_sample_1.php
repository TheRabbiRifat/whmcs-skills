<?php

/**
 * Returns todays date
 *
 * By default returns the format defined in General Settings > Localisation > Date Format
 *
 * @param bool $applyClientDateFormat Set true to apply Localisation > Client Date Format
 *
 * @return string
 */
$todaysdate = getTodaysDate($applyClientDateFormat);