<?php

// starting the needed session for the pages
session_start();
// including the head and the navigation bar aswell as the database class
include_once '../inc/head.php';
include_once '../inc/navigationclass.php';
include_once '../utility/DB.php';
$db = new DB;


// navigating between the web pages of the shop.
// Each page gets an id sent using xml on a get url method and based on that the page is chosen out of the follopwing list
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    if ($_GET['id'] == 1) {
        include_once 'homepage.php';
    } elseif ($_GET['id'] == 2) {
        include_once 'orderHistory.php';
    } elseif ($_GET['id'] == 3) {
        include_once 'ensuringMinimumInventory.php';
    } elseif ($_GET['id'] == 4) {
        include_once 'orderItems.php';
    } elseif ($_GET['id'] == 5) {
        
    }
} else
    include_once 'homepage.php';

// including our footer
include_once '../inc/footer.php'
?>