<?php
if (isset($_GET['orderid']) && isset($_GET['artikelid'])) {
    $orderid = $_GET['orderid'];
    echo "<h1 id='blabla'>Order id: $orderid</h1>";
    $allSuppliers = getSupplierList($artikelid);
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Supplier name</th>
                <th>Price</th>
                <th>Minimum amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php foreach ($allSuppliers as $oneSupplier) { ?>
            <tr>
                <td><?php $oneSupplier->getName() ?></td>
                <td><?php $oneSupplier->getPrice ?></td>
                <td>$<?php $oneSupplier->getMinimumAmount() ?> </td>
                <td><a href='index.php?id=4&orderid='&artikelid=$zeile->artikelid><input class='btn btn-primary' type='submit' value='Order'</a></td>
            </tr>";
            <?php
        }
    } else
        header("location: homepage.php");