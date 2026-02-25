<?php

//Obtain the values defined in the AddonConfig hook point and save them as required
add_hook('AddonConfigSave', 1, function($vars) {
    $addonId = $vars['id'];
    $additionalFieldOne = $_REQUEST['additionalFieldOne'];
    $additionalFieldTwo = $_REQUEST['additionalFieldTwo'];

    //Save the data here
});