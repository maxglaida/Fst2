
<div class="container-fluid">
<h1 id="blabla">Insure Minimum Inventory</h1>
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

                $db->MinimumInventoryProductList()
                ?>
</table>

</div>