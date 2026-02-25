<?php

add_hook('AdminInvoicesControlsOutput', 1, function($vars) {
    $return = '';

    if ($vars['paymentmethod'] == 'mypaymentmethod') {
        $return = "<br />Field 1 Value <input type=\"text\" name=\"myPaymentMethodName\" value=\"xyz\" class=\"form-control input-150\" />";
    }
    return $return;
});