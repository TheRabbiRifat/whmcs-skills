<?php
/**
 * Hook sample for defining additional template variables
 *
 * @param array $vars Existing defined template variables
 *
 * @return array
 */
function hook_template_variables_example($vars)
{
    $extraTemplateVariables = array();

    // set a fixed value
    $extraTemplateVariables['fixedValue'] = 'abc';

    // fetch clients data if available
    $clientsData = isset($vars['clientsdetails']) ? $vars['clientsdetails'] : null;

    // determine if client is logged in
    if (is_array($clientsData) && isset($clientsData['id'])) {
        $userId = $clientsData['id'];
        // perform calculation here
        $extraTemplateVariables['userSpecificValue'] = '123';
        $extraTemplateVariables['anotherUserOnlyValue'] = '456';
    }

    // return array of template variables to define
    return $extraTemplateVariables;
}

add_hook('ClientAreaPageViewTicket', 1, 'hook_template_variables_example');