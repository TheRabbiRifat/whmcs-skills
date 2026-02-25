<?php

$currentUser = new \WHMCS\Authentication\CurrentUser;
if ($currentUser->isMasqueradingAdmin()) {
    echo "Current user is a masquerading Admin.";
} else {
    echo "Current user is not a masquerading Admin.";
}