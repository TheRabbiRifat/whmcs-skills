<?php

//Return an exchange rate for the XBT currency
add_hook('FetchCurrencyExchangeRates', 1, function($vars) {
    //Code here to fetch the the current exchange rate relative to EUR

    //Return exchange rate relative to 1 EUR
    return ['XBT' => 927.121,];
});