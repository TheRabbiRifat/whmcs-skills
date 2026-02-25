<?php

add_hook('ShoppingCartCheckoutCompletePage', 1, function($vars) {
    /**
     * Redirect all orders to a different page after the order complete page is loaded.
     */
    return '<META http-equiv="refresh" content="5;URL=http://www.mydomain.com/ownpage.html" />';
});