<?php




	$fluglinieid = $_POST['auswahl'];
	if ($fluglinieid != 0) {
		echo "<h1>Flugzeuge der Linie #$fluglinieid</h1>";

		$conn = new mysqli($host, $user, $password, $dbname);
		$conn->set_charset("utf8");

		$sql = "SELECT flugzeugid, fluglinienid, flugzeuge.bezeichnung as b1, sitzplaetze, flugstunden_gesamt, fluglinien.bezeichnung as b2, adresse, kbz FROM fluglinien join flugzeuge ON fluglinien.fluglinienid = flugzeuge.fk_fluglinienid ";

		$results = $conn -> query($sql);
		?>

<table class="table table-striped">
    <tr>
        <th>OrderID/th>
        <th>Product</th>
        <th>Person</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php

    if ($results) {

        while ($zeile = $results -> fetch_object()) {
            echo "<tr>";
            echo "<td>$zeile->b1</td>";
            echo "<td>$zeile->sitzplaetze</td>";
            echo "<td>$zeile->flugstunden_gesamt</td>";
            echo "<td>$zeile->b2</td>";
            echo "<td>$zeile->adresse</td>";
            echo "<td>$zeile->kbz</td>";
            echo "<td><a class='glyphicon glyphicon-remove' href='index.php?id=$zeile->flugzeugid'></a> <a class='glyphicon glyphicon-pencil' href='index.php?id=$zeile->fluglinienid id2=$zeile->flugzeugid'></a></td>";


            echo "</tr>";
            # code...
        }
    }else
        echo "es gab probleme mit connection";



    # code...
    }else
        echo "<h3>bitte wählen sie eine fluglinie!</h3>"




    ?>
