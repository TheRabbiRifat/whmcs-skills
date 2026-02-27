<?php

add_hook('ClientAreaHeadOutput', 1, function($vars) {
    $template = $vars['template'];
    return <<<HTML
    <link href="path/to/custom/css/custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
//custom javascript here
</script>
HTML;

});