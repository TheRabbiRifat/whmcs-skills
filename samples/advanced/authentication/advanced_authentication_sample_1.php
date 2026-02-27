<?php

$currentUser = new \WHMCS\Authentication\CurrentUser;
if ($currentUser->isAuthenticatedUser()) {
    echo "Current user authenticated as User.";
} else {
    echo "Current user not authenticated as User.";
}