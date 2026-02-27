<?php

$currentUser = new \WHMCS\Authentication\CurrentUser;
$user = $currentUser->user();
if ($user) {
    echo "There is an authenticated User, and their name is {$user->fullName}.";
} else {
    echo "There is not an authenticated User.";
}