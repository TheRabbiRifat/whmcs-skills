<?php

add_hook('AdminAreaHeadOutput', 1, function($vars) {
    return <<<HTML
    <link href="path/to/custom/css/custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
//custom javascript here
</script>
HTML;

});