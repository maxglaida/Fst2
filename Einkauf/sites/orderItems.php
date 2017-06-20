<?php

if (isset($_GET['orderid'])&& isset($_GET['artikelid'])) {
    $orderid=$_GET['orderid'];
    echo "<h1 id='blabla'>Order id: $orderid</h1>";
    
    
    
    
} else
    header("location: homepage.php");