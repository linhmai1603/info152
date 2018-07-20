<?php
// Start session management
session_start();

// Create a cart array if needed
if (empty($_SESSION['cart13'])) { $_SESSION['cart13'] = array(); }

// Create a table of products
$products = array();
$products['MMS-1754'] = 
    array('name' => 'Flute', 'cost' => '149.50');
$products['MMS-6289'] = 
    array('name' => 'Trumpet', 'cost' => '199.50');
$products['MMS-3408'] = 
    array('name' => 'Clarinet', 'cost' => '299.50');

// Include cart functions

echo $products['MMS-6289']['cost'];
?>
