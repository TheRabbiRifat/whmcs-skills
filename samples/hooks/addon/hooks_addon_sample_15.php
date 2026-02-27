<?php

add_hook('LicensingAddonVerify', 1, function($vars) {
    return [
        'myExtraVariable' => 'Yes',
        'myOtherVariable' => 'Sure',
    ];
});