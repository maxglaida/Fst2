<?php

class DB
{
    // in this dB class we have all our function that have an interaction with the DB
    private $host = "wi-projectdb.technikum-wien.at:3306";
    private $user = "s17-bvz2-fst-31";
    private $pwd = "DbPass4v831";
    private $dbname = "s17-bvz2-fst-30";
    private $dbobjekt = null;

    //setting a connection to the db
    function connectToDB()
    {
        $this->dbobjekt = new mysqli($this->host, $this->user, $this->pwd, $this->dbname);
    }

    function checkkUser($user, $pw)
    {
        $this->connectToDB();
        $query = "select * 
                  from person 
                    join personal on person.personID = personal.persID
                  where userName = '$user' and passwort = '$pw'";

        $ergebnis = $this->dbobjekt->query($query);
        if (mysqli_num_rows($ergebnis) == 1) {
            while ($zeile = $ergebnis->fetch_object()) {
                $username = $zeile->userName;
                $cat = $zeile->rolleID;
                $id = $zeile->personalID;
            }
            $_SESSION['username'] = $username;
            $_SESSION['priviliges'] = $cat;
            $_SESSION['userid'] = $id;

            $hello = $_SESSION['priviliges'];

            echo("<script language='JavaScript'>
                   window.alert('Welcome $username! thats your priv $hello')
                   window.location.href='index.php';
                   </script>");
        } else {
            echo("<script language='JavaScript'>
                   window.alert('Incorrect username or password!')
                   window.location.href='login.php';
                   </script>");
        }
    }

    function getInventorys() {

        $this->connectToDB();

        $query = "SELECT * FROM inventurschein ORDER BY -inventurScheinID";

        $ergebnis = $this->dbobjekt->query($query);
        if ($ergebnis) {
            # code...
            while ($zeile = $ergebnis->fetch_object()) {

                echo "<option value='$zeile->inventurScheinID'>$zeile->inventurScheinID - $zeile->datErstellt</option>";
                # code...
            }
        }else
            echo "Es gibt ein fehlar bei zugriff!";
    }

    function getOpenOrdersList()
    {

        $conn = $this->connectToDB();

        $query = "select * 
                  from ekbestellung 
                    join (select personid, vorname, nachname, personalid 
	                      from person 
	                        join personal on personal.persID = person.personID
	                      ) Q1
                    on Q1.personalid = ekbestellung.persID
                    join artikel on ekbestellung.artID = artikel.artikelID
                    where status = 'open'";

        $ergebnis = $this->dbobjekt->query($query);
        if ($ergebnis) {

            while ($zeile = $ergebnis->fetch_object()) {
                echo "<tr>";
                echo "<td>$zeile->bestellungID</td>";
                echo "<td>$zeile->artikelBezeichnung</td>";
                echo "<td>$zeile->vorname $zeile->nachname </td>";
                echo "<td>$zeile->menge</td>";
                echo "<td>$zeile->status</td>";
                echo "<td>
                        <a href='index.php?id=2&$zeile->bestellungID&id=$zeile->bestellungID'>
                            <input class='btn btn-default' type='submit' value='Order' href='index.php?id=22$zeile->bestellungID'>
                        </a>
                      </td>";

                echo "</tr>";

            }
        }
    }


    function insertNewOrder($pID, $amount, $invID)
    {
        var_dump($_SESSION['userid']);
        $person = $_SESSION['userid'];

        $this->connectToDB();

        $query = "INSERT INTO ekbestellung (`artID`, `persID`, `menge`, `status`) 
                  VALUES ('$pID', '$person', '$amount', 'open');";

        $ergebnis = $this->dbobjekt->query($query);

        $query = "UPDATE inventur SET ekstatus='order created' WHERE inventurID='$invID'";
        $ergebnis = $this->dbobjekt->query($query);



    }

    function inventoryProductList($invID)
    {
        $this->connectToDB();
        $productsArrayWithAmount = array();

        $query = "select * from inventur join artikel on artikel.artikelID = inventur.artId
                  where invID = $invID;";
        $ergebnis = $this->dbobjekt->query($query);

        while ($zeile = $ergebnis->fetch_object()) {


            //jedes User-Objekt wird in das Array $userArray abgelegt
            array_push($productsArrayWithAmount, $zeile);
        }
        return $productsArrayWithAmount;
    }


    function getOrdersToBeApproved()
    {

        $conn = $this->connectToDB();

        $query = "select * 
                  from ekbestellung 
                    join artikel on artikel.artikelID = ekbestellung.artID 
                    join person on person.personID = ekbestellung.persID 
                  where status = 'pending approval'";

        $ergebnis = $this->dbobjekt->query($query);
        if ($ergebnis) {

            while ($zeile = $ergebnis->fetch_object()) {
                echo "<tr>";
                echo "<td>$zeile->bestellungID</td>";
                echo "<td>$zeile->artikelBezeichnung</td>";
                echo "<td>$zeile->vorname $zeile->nachname </td>";
                echo "<td>$zeile->menge</td>";
                echo "<td>$zeile->status</td>";
                echo "<td>
                        <a href='#'>
                            <input class='btn btn-default' type='submit' value='approve'>
                        </a>
                        
                        <a href='#'>
                            <input class='btn btn-default' type='submit' value='refuse'>
                        </a>
                      </td>";

                echo "</tr>";

            }
        }

    }

    function getOrderHistory()
    {

        $conn = $this->connectToDB();

        $query = "select * 
                  from ekbestellung 
                    join artikel on artikel.artikelID = ekbestellung.artID 
                    join person on person.personID = ekbestellung.persID 
                  where status <> 'pending approval' AND status <> 'open';";

        $ergebnis = $this->dbobjekt->query($query);
        if ($ergebnis) {

            while ($zeile = $ergebnis->fetch_object()) {
                echo "<tr>";
                echo "<td>$zeile->bestellungID</td>";
                echo "<td>$zeile->artikelBezeichnung</td>";
                echo "<td>$zeile->vorname $zeile->nachname </td>";
                echo "<td>$zeile->menge</td>";
                echo "<td>$zeile->status</td>";
                echo "<td>
                        <a href='#'>
                            <input class='btn btn-default' type='submit' value='details'>
                        </a>
                      </td>";

                echo "</tr>";

            }
        }

    }
}