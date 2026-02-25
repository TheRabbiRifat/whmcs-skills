<?php

function yourmodulename_link($params) {
    return '<form method="post" action="https://www.example.com/checkout">
        <input type="invoice_number" value="' . $params['invoiceid'] . '" />
        <input type="description" value="' . $params['description'] . '" />
        <input type="amount" value="' . $params['amount'] . '" />
        <input type="currency" value="' . $params['currency'] . '" />
        <input type="submit" value="' . $params['langpaynow'] . '" />
        </form>';
}