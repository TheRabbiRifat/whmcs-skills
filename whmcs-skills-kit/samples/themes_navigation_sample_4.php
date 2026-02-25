<?php

// Moves a menu item up one position
$primaryNavbar->getChild('Support')->getChild('Announcements')->moveUp();
// Moves a menu item down one position
$primaryNavbar->getChild('Support')->getChild('Announcements')->moveDown();
// Moves a menu item to the first position
$primaryNavbar->getChild('Support')->getChild('Announcements')->moveToFront();
// Moves a menu item to the last position
$primaryNavbar->getChild('Support')->getChild('Announcements')->moveToBack();