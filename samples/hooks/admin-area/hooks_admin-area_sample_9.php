<?php

//Obtain the values defined in the AdminClientProfileTabFields hook point and save them as required
add_hook('AdminClientProfileTabFieldsSave', 1, function($vars) {
    $userId = $vars['userid'];
    $additionalFieldOne = $_REQUEST['additionalFieldOne'];
    $additionalFieldTwo = $_REQUEST['additionalFieldTwo'];

    //Save the data here
});