<?php

add_hook('AdminAreaClientSummaryPage', 1, function($vars) {
    return 'This message will be output on the Client Summary page. I can add HTML here';
});