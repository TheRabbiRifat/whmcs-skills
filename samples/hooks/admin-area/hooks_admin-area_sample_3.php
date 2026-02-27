<?php
add_hook('AdminAreaPage', 1, function($vars) {
    $extraVariables = [];
    if ($vars['filename'] == 'index.php') {
        $extraVariables['newVariable1'] = 'thisValue';
        $extraVariables['newVariable2'] = 'thatValue';
    }
    return $extraVariables;
});