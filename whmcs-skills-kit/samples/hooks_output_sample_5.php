<?php

add_hook('ClientAreaDomainDetailsOutput', 1, function($domain) {
    $domainName = $domain->domain;
    $clientModel = $domain->client;
    $domainStatus = $domain->status;
    $clientName = $clientModel->firstName . ' ' . $clientModel->lastName;
    return 'You can place any HTML here that will be output in the $hookOutput smarty variable array';
});