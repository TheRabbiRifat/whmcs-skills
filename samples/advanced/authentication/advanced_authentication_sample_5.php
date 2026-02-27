<?php

$currentUser = new \WHMCS\Authentication\CurrentUser;
$admin = $currentUser->admin();
if ($admin) {
    echo "There is an authenticated Admin, and their name is {$admin->fullName}.";
} else {
    echo "There is not an authenticated Admin.";
}