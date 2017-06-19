<?php

class navigation
{
// creating a navigation class.

// the load xml function is triggered and based on the parameter that was passed from the session it is decided which menu to display
    function loadXML($who)
    {
        $xml = simplexml_load_file('../config/navigation.xml');
        if ($who == "employee") {
            foreach ($xml->staff->menu as $element) {
                echo '<li><a href="' . $element->link . '">' . $element->title . '</a></li>';
            }
        } elseif ($who == "admin") {
            foreach ($xml->admin->menu as $element) {
                echo '<li><a href="' . $element->link . '">' . $element->title . '</a></li>';
            }
        }
    }
}


?>


<nav id="navbar" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img id="img" alt="Brand" src="../ress/img/Logo.PNG">
            </a>
        </div>
        <ul class="nav navbar-nav">

            <?php

            if (isset($_SESSION['priviliges'])) {
                if ($_SESSION['priviliges'] == 1) {
                    $who = 'admin';
                } else
                    $who = 'employee';
            }

            // creating a new navigation object and loading the xml.
            $nav = new Navigation();
            $nav->loadXML($who);
            ?>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php?id=10">Logout</a></li>
        </ul>
    </div>
</nav>
