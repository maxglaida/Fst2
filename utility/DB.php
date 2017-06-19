<?php

class DB
{
    // in this dB class we have all our function that have an interaction with the DB
    private $host = "localhost";
    private $user = "root";
    private $pwd = "MtWBUGZKZL1Np8bk";
    private $dbname = "cst-lager";
    private $dbobjekt = null;

    //setting a connection to the db
    function connectToDB()
    {
        $this->dbobjekt = new mysqli($this->host, $this->user, $this->pwd, $this->dbname);
    }

    function checkUser($user, $pw)
    {
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

}