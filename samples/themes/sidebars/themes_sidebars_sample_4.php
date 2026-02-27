<?php

// Moves a menu item up one position
$primaryNavbar->getChild('My Account')->getChild('Billing Information')->moveUp();
// Moves a menu item down one position
$primaryNavbar->getChild('My Account')->getChild('Billing Information')->moveDown();
// Moves a menu item to the first position
$primaryNavbar->getChild('My Account')->getChild('Billing Information')->moveToFront();
// Moves a menu item to the last position
$primaryNavbar->getChild('My Account')->getChild('Billing Information')->moveToBack();