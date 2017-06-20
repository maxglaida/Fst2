<?php

class DB {

    // in this dB class we have all our function that have an interaction with the DB
    private $host = "wi-projectdb.technikum-wien.at:3306";
    private $user = "s17-bvz2-fst-31";
    private $pwd = "DbPass4v831";
    private $dbname = "s17-bvz2-fst-30";
    private $dbobjekt = null;

    //setting a connection to the db
    function connectToDB() {
        $this->dbobjekt = new mysqli($this->host, $this->user, $this->pwd, $this->dbname);
    }

    function checkUser($user, $pw) {
        $this->connectToDB();
        $query = "select * from person join personal on person.personID = personal.persID where userName = '$user' and passwort = $pw and rolleID = 1";
        $ergebnis = $this->dbobjekt->query($query);
        if (mysqli_num_rows($ergebnis) == 1) {
            while ($zeile = $ergebnis->fetch_object()) {
                $username = $zeile->userName;
                $cat = $zeile->rolleID;
                $id = $zeile->personID;
            }
            $_SESSION['username'] = $username;
            $_SESSION['priviliges'] = $cat;
            $_SESSION['userid'] = $id;

            echo("<script language='JavaScript'>
                   window.alert('Welcome $username!')
                   window.location.href='index.php';
                   </script>");
        } else {
            echo("<script language='JavaScript'>
                   window.alert('Incorrect username or password!')
                   window.location.href='login.php';
                   </script>");
        }
    }

    function getOpenOrdersList() {

        $conn = $this->connectToDB();

        $query = "select * from ekbestellung "
                . "join artikel on artikel.artikelID = ekbestellung.artID "
                . "join person on person.personID = ekbestellung.persID "
                . "where status = 'open'";
        $ergebnis = $this->dbobjekt->query($query);
        if ($ergebnis) {

            while ($zeile = $ergebnis->fetch_object()) {
                echo "<tr>";
                echo "<td>$zeile->bestellungID</td>";
                echo "<td>$zeile->artikelBezeichnung</td>";
                echo "<td>$zeile->vorname $zeile->nachname </td>";
                echo "<td>$zeile->menge</td>";
                echo "<td>$zeile->status</td>";
                echo "<td><a href='index.php?id=4&orderid=$zeile->bestellungID'&artikelid=$zeile->artikelid><input class='btn btn-primary' type='submit' value='Order'</a></td>";
                echo "</tr>";
            }
        }

        function getSupplierList($artikelid) {

            $conn = $this->connectToDB();

            $query = "select * from xxxxx "
                    . "where artikelid = '$artikelid'";
            $ergebnis = $this->dbobjekt->query($query);

            while ($zeile = $ergebnis->fetch_object()) {
                echo "<tr>";
                echo "<td>$zeile->bestellungID</td>";
                echo "<td>$zeile->artikelBezeichnung</td>";
                echo "<td>$zeile->vorname $zeile->nachname </td>";
                echo "<td>$zeile->menge</td>";
                echo "<td>$zeile->status</td>";
                echo "<td><a href='index.php?id=4&orderid=$zeile->bestellungID'&artikelid=$zeile->artikelid><input class='btn btn-primary' type='submit' value='Order'</a></td>";
                echo "</tr>";
                # code...
            }
        }

    }

}
