<?php

add_hook('AddonConfig', 1, function($vars) {
    return [
        'Additional Field 1' => '<input type="text" name="additionalFieldOne" class="form-control input-150" />',
        'Additional Field 2' => '<input type="text" name="additionalFieldTwo" class="form-control input-150" />',
    ];
});