<?php

$currentUser = new \WHMCS\Authentication\CurrentUser;
if ($currentUser->isAuthenticatedAdmin()) {
    echo "Current user is authenticated as Admin.";
} else {
    echo "Current user is not authenticated as Admin.";
}