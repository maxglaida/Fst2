<?php

class navigation{
// creating a navigation class.

// the load xml function is triggered and based on the parameter that was passed from the session it is decided which menu to display
    function loadXML($who){
        $xml = simplexml_load_file('../config/navigation.xml');
        if($who=="employee"){
            foreach($xml->staff->menu as $element){
                echo '<li><a href="'.$element->link.'">'.$element->title.'</a></li>';
            }
        }
        elseif($who=="admin"){
            foreach($xml->admin->menu as $element){
                echo '<li><a href="'.$element->link.'">'.$element->title.'</a></li>';
            }
        }
    }
}


?>



<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <a href="sites/homepage.php" class="navbar-brand">CTS</a>
        <ul class="nav navbar-nav">

            <?php


            // creating a new navigation object and loading the xml.
            $who = 'employee';
            $nav = new Navigation();
            $nav->loadXML($who);
            //  generating the shopping cart icon with the amount of items that currently exist in the session.
            ?>
        </ul>
    </div>
</nav>
