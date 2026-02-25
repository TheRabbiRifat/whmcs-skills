<?php

$currentUser = new \WHMCS\Authentication\CurrentUser;
$client = $currentUser->client();
if ($client) {
    echo "There is an authenticated Client, and their name is {$client->fullName}.";
} else {
    echo "There is not an authenticated Client.";
}