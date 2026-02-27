<?php

use WHMCS\Authentication\CurrentUser;
use WHMCS\ClientArea;
use WHMCS\Database\Capsule;

define('CLIENTAREA', true);

require __DIR__ . '/init.php';

$ca = new ClientArea();

$ca->setPageTitle('Your Page Title Goes Here');

$ca->addToBreadCrumb('index.php', Lang::trans('globalsystemname'));
$ca->addToBreadCrumb('mypage.php', 'Your Custom Page Name');

$ca->initPage();

//$ca->requireLogin(); // Uncomment this line to require a login to access this page

// To assign variables to the template system use the following syntax.
// These can then be referenced using {$variablename} in the template.

//$ca->assign('variablename', $value);

$currentUser = new CurrentUser();
$authUser = $currentUser->user();

// Check login status
if ($authUser) {

    /**
     * User is logged in - put any code you like here
     *
     * Use the User model to access information about the authenticated User
     */

    $ca->assign('userFullname', $authUser->fullName);


    $selectedClient = $currentUser->client();
    if ($selectedClient) {

        /**
         * If the authenticated User has selected a Client Account to manage,
         * the model will be available - put any code you like here
         */

        $ca->assign(
            'clientInvoiceCount',
            $selectedClient->invoices()->count()
        );
    }

} else {

    // User is not logged in
    $ca->assign('userFullname', 'Guest');

}

/**
 * Set a context for sidebars
 *
 * @link http://docs.whmcs.com/Editing_Client_Area_Menus#Context
 */
//Menu::addContext();

/**
 * Setup the primary and secondary sidebars
 *
 * @link http://docs.whmcs.com/Editing_Client_Area_Menus#Context
 */
Menu::primarySidebar('announcementList');
Menu::secondarySidebar('announcementList');

# Define the template filename to be used without the .tpl extension

$ca->setTemplate('mypage');

$ca->output();