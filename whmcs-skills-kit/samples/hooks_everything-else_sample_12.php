<?php

//Output additional merge fields in the list when editing an email template
add_hook('EmailTplMergeFields', 1, function($vars) {
    $merge_fields = [];
    $merge_fields['my_custom_var'] = "My Custom Var";
    $merge_fields['my_custom_var2'] = "My Custom Var2";
    return $merge_fields;
});