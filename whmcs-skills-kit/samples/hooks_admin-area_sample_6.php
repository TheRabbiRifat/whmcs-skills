<?php

//Obtain the values defined in the AdminClientProfileTabFields hook point and save them as required
add_hook('AdminClientDomainsTabFieldsSave', 1, function($vars) {
    $domainId = $vars['id'];
    $additionalFieldOne = $_REQUEST['additionalFieldOne'];
    $additionalFieldTwo = $_REQUEST['additionalFieldTwo'];

    //Save the data here
});