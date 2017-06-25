<div class="container-fluid">
    <h1 id="blabla">Insure Minimum Inventory</h1>

    <form method="POST">
        <select name="auswahl" class="form-control">

            <?php

            $db->getInventorys();

            ?>
        </select>
        <button class="btn btn-default" name="submit" value="submit" type="submit">Inventory Selection</button>
    </form>

    <table class="table">
        <tr>
            <th>ProductID</th>
            <th>Product</th>
            <th>Category</th>
            <th>Minimum Inventory</th>
            <th>Actual Inventory</th>
            <th>Difference</th>
            <th>Action</th>
        </tr>
        <?php

        if (isset($_POST['submit'])) {
            if (!empty($_POST['auswahl']) && is_numeric($_POST['auswahl'])) {
                $_SESSION['category'] = $_POST['auswahl'];
                $productListWithAmount = $db->inventoryProductList($_SESSION['category']);
            }
            # code...
        }else $productListWithAmount = $db->inventoryProductList($_SESSION['category']);

                foreach ($productListWithAmount as $product) {


                    $amountDifference = $product->mindestbestand - $product->stkIst;
                    if ($amountDifference > 0 && $product->ekstatus==null) {
                        echo "<tr class='danger'>";
                    } else
                        echo "<tr class='success'>";
                    echo "<td>$product->artikelID</td>";
                    echo "<td>$product->artikelBezeichnung</td>";
                    echo "<td>$product->artikelGruppe</td>";
                    echo "<td>$product->mindestbestand</td>";
                    echo "<td>$product->stkIst</td>";
                    if ($amountDifference > 0 && $product->ekstatus==null) {
                        echo "<td>$amountDifference</td>";
                        echo "<form method='post'><td>
                           <input class='btn btn-default' name='submit2' type='submit' value='Order'>
                           <input type='hidden' name='amount' value='$amountDifference'>
                           <input type='hidden' name='productid' value='$product->artikelID'>
                           <input type='hidden' name='inventurID' value='$product->inventurID'>
                      </td></form>";
                    } else {
                        echo '<td></td>';
                        echo '<td></td>';
                    }
                    echo "</tr>";

                }


        if(isset($_POST['submit2']))
        $db->insertNewOrder($_POST['productid'], $_POST['amount'], $_POST['inventurID']);


        ?>
    </table>

</div>