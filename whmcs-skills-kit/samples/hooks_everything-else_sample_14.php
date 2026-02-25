<?php

add_hook('IntelligentSearch', 1, function ($vars) {
    /**
     * This is an example of array return for an Intelligent Search.
     * This format is supported in the blend WHMCS Admin Template.
     * Any template based on blend and updated to WHMCS 7.7+ is also supported.
     */
    $searchResults = array();

    // look for exact matches in client notes field
    $result = \WHMCS\Database\Capsule::table('tblclients')
        ->where('notes', $vars['searchTerm'])
        ->get();

    foreach ($result as $client) {
        $searchResults[] = [
            'title' => $client->firstname . ' ' . $client->lastname, // The title of the search result. This is required.
            'href' => 'clientssummary.php?userid=' . $client->id, // The destination url of the search result. This is required.
            'subTitle' => $client->email, // An optional subtitle for the search result.
            'icon' => 'fal fa-user', // A font-awesome icon for the search result. Defaults to 'fal fa-star' if not defined.
        ];
    }
    return $searchResults;
});