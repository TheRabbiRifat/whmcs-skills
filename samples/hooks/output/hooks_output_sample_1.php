<?php

add_hook('AdminAreaFooterOutput', 1, function($vars) {
    return <<<HTML
<b>This is a custom output on the footer</b>
<script type="text/javascript">
    //custom javascript here
</script>
HTML;
});