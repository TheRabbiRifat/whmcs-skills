<?php

/**
 * Client Area Output.
 *
 * This function renders output to the domain details interface within
 * the client area. The return should be the HTML to be output.
 *
 * @param array $params common module parameters
 *
 * @see https://developers.whmcs.com/domain-registrars/module-parameters/
 *
 * @return string HTML Output
 */
function registrarmodule_ClientArea($params)
{
    $output = <<<HTML
<div class="alert alert-info">
    Your custom HTML output goes here...
</div>
HTML;
    return $output;
}